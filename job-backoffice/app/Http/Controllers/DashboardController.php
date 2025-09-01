<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobVacancy;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin'){
            $analytics = $this->adminDashboard();
        } else {
            $analytics = $this->companyOwnerDashboard();
        }

        return view('dashboard.index', compact('analytics'));
    }

    private function adminDashboard()
    {
        // Last 30 days active users (job-seeker role)
        $activeUsers = User::where('last_login_at', '>=', now()->subDays(30))
            ->where('role', 'job-seeker')->count();

        // Total jobs (not deleted)
        $totalJobs = JobVacancy::whereNull('deleted_at')->count();

        // Total applications (not deleted)
        $totalApplications = JobApplication::whereNull('deleted_at')->count();

        // Most applied jobs
        $mostAppliedJobs = JobVacancy::withCount('jobApplications as totalCount')
            ->whereNull('deleted_at')
            ->orderByDesc('totalCount')
            ->limit(5)
            ->get();

        // Conversion rate
        $conversionRates = JobVacancy::withCount('jobApplications as totalCount')
            ->having('totalCount', '>', 0)
            ->orderByDesc('totalCount')
            ->limit(5)
            ->get()
            ->map(function ($job) {
                if ($job->viewCount > 0){
                    $job->conversionRate = round($job->totalCount / $job->viewCount * 100, 2);
                } else {
                    $job->conversionRate = 0;
                }
                return $job;
            });

        $analytics = [
            'activeUsers' => $activeUsers,
            'totalJobs' => $totalJobs,
            'totalApplications' => $totalApplications,
            'mostAppliedJobs' => $mostAppliedJobs,
            'conversionRates' => $conversionRates,
        ];

        return $analytics;
    }

    private function companyOwnerDashboard()
    {
        $company = auth()->user()->company;

        // Filter active users by applying to jobs of the company
        $activeUsers = User::where('last_login_at', '>=', now()->subDays(30))
            ->where('role', 'job-seeker')
            ->whereHas('jobApplications', function ($query) use ($company) {
                $query->whereIn('jobVacancyId', $company->jobVacancies->pluck('id'));
            })
            ->count();

        // Total jobs of the company
        $totalJobs = $company->jobVacancies->count();

        // Total applications of the company
        $totalApplications = JobApplication::whereIn('jobVacancyId', $company->jobvacancies->pluck('id'))->count();

        // Most applied jobs of the company
        $mostAppliedJobs = JobVacancy::withCount('jobApplications as totalCount')
            ->whereIn('id', $company->jobVacancies->pluck('id'))
            ->limit(5)
            ->orderByDesc('totalCount')
            ->get();

        // conversion rates of the company
        $conversionRate = JobVacancy::withCount('jobApplications as totalCount')
            ->whereIn('id', $company->jobVacancies->pluck('id'))
            ->having('totalCount', '>', 0)
            ->limit(5)
            ->orderByDesc('totalCount')
            ->get()
            ->map(function ($job) {
                if ($job->viewCount > 0) {
                    $job->conversionRate = round($job->totalCount / $job->viewCount * 100, 2);
                } else {
                    $job->conversionRate = 0;
                }
                return $job;
            });

        $analytics = [
            'activeUsers' => $activeUsers,
            'totalJobs' => $totalJobs,
            'totalApplications' => $totalApplications,
            'mostAppliedJobs' => $mostAppliedJobs,
            'conversionRates' => $conversionRate,
        ];

        return $analytics;
    }
}
