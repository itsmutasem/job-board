<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobCategoryCreateRequest;
use App\Http\Requests\JobCategoryUpdateRequset;
use App\Models\JobCategory;
use Illuminate\Http\Request;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = JobCategory::latest();
        $categories = $query->paginate(10)->onEachSide(1);
        return view('job-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('job-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobCategoryCreateRequest $request)
    {
        $validated = $request->validated();
        JobCategory::create($validated);
        return redirect()->route('job-categories.index')->with('create', 'Job category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = JobCategory::findOrFail($id);
        return view('job-category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobCategoryUpdateRequset $request, string $id)
    {
        $validate = $request->validated();
        $category = JobCategory::findOrFail($id);
        $category->update($validate);
        return redirect()->route('job-categories.index')->with('update', 'Job category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
