<?php

namespace App\Http\Controllers;

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

        return view('dashboard.index');
    }
}
