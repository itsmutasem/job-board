<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyJobRequest;
use App\Models\JobApplication;
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
        $resumes = auth()->user()->resumes;
        return view('job-vacancies.apply', compact('jobVacancy', 'resumes'));
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
            'filename' => $originalFileName,
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

        JobApplication::create([
            'status' => 'pending',
            'jobVacancyId' => $id,
            'resumeId' => $resume->id,
            'userId' => auth()->id(),
            'aiGeneratedScore' => 0,
            'aiGeneratedFeedBach' => '',
        ]);

        return redirect()->route('job-applications.index', $id)->with('success', 'Application submitted successfully');
    }
}
