<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyJobRequest;
use App\Models\JobVacancy;
use App\Models\Resume;
use Illuminate\Http\Request;

class JobVacancyController extends Controller
{
    public function show(string $id)
    {
        $jobVacancy = JobVacancy::findOrFail($id);
        return view('job-vacancies.show', compact('jobVacancy'));
    }

    public function apply(string $id)
    {
        $jobVacancy = JobVacancy::findOrFail($id);
        return view('job-vacancies.apply', compact('jobVacancy'));
    }

    public function processApplication(ApplyJobRequest $request, string $id)
    {
        $file = $request->file('resume_file');
        $extension = $file->getClientOriginalExtension();
        $originalFileName = $file->getClientOriginalName();
        $fileName = 'resume_' . time() . '.' . $extension;

        // Store in Laravel Cloud
        $path = $file->storeAs('resumes', $fileName, 'cloud');
        // $fileUrl = config('filesystems.disks.cloud.url') . '/' . $path;
        $resume = Resume::create([
            'fileName' => $originalFileName,
            'fileUri' => $path,
            'userId' => auth()->id(),
            'contactDetails' => json_encode([
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ]),
            'summary' => '',
            'skills' => '',
            'experience' => '',
            'education' => '',
        ]);
    }
}
