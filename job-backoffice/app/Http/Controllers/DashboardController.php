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
        // Last 30 days active users (job-seeker role)
        $activeUsers = User::where('last_login_at', '>=', now()->subDays(30))
            ->where('role', 'job-seeker')->count();

        // Total jobs (not deleted)
        $totalJobs = JobVacancy::whereNull('deleted_at')->count();

        // Total applications (not deleted)
        $totalApplications = JobApplication::whereNull('deleted_at')->count();

        $analytics = [
            'activeUsers' => $activeUsers,
            'totalJobs' => $totalJobs,
            'totalApplications' => $totalApplications
        ];

        // Most applied jobs
        $mostAppliedJobs = JobVacancy::withCount('jobApplications as totalCount')
            ->orderByDesc('totalCount')
            ->paginate(5);

        return view('dashboard.index', compact(['analytics', 'mostAppliedJobs']));
    }
}
