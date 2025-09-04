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

        if ($request->search && $request->filter) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('location', 'like', '%' . $request->search . '%')
                    ->orWhereHas('company', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->search . '%');
                    });
                })
                ->where('type', $request->filter);
        }

        if ($request->has('search') && $request->filter === null) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('location', 'like', '%' . $request->search . '%')
                ->orWhereHas('company', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                });
        }

        if ($request->has('filter') && $request->search === null) {
            $query->where('type', $request->filter);
        }

        $jobs = $query->latest()->paginate(10)->withQueryString();
        return view('dashboard', compact('jobs'));
    }
}
