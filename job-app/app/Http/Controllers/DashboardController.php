<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\Request;
use function Laravel\Prompts\search;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = JobVacancy::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('location', 'like', '%' . $request->search . '%')
                ->orWhereHas('company', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                });
        }

        if ($request->has('filter')) {
            $query->where('type', $request->filter);
        }

        $jobs = $query->latest()->paginate(10)->withQueryString();
        return view('dashboard', compact('jobs'));
    }
}
