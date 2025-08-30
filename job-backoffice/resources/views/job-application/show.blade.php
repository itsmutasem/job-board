<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $jobApplication->user->name }} | Applied to {{ $jobApplication->jobVacancy->title }}
        </h2>
    </x-slot>

    <div class="overflow-x-auto p-6">
        <x-toast-notification />

        {{--        Back Button --}}
        <div class="mb-6">
            <a href="{{ route('job-applications.index') }}" class="bg-gray-200 text-gray-800 hover:bg-gray-300 px-4 py-2 rounded-md shadow">← Back</a>
        </div>

        <div class="w-full mx-auto p-6 bg-white rounded-lg shadow">
            {{-- Job Application Details --}}
            <div>
                <h3 class="text-lg font-bold">Application Details</h3>
                <p><strong>Applicant:</strong> {{ $jobApplication->user->name }}</p>
                <p><strong>Job Vacancy:</strong> {{ $jobApplication->jobVacancy->title }}</p>
                <p><strong>Job Company:</strong> {{ $jobApplication->jobVacancy->company->name }}</p>
                <p >
                    <strong>Status:</strong>
                    <span class="{{ match($jobApplication->status) { 'pending' => 'text-yellow-500', 'accepted' => 'text-green-500', 'rejected' => 'text-red-500', default => 'text-gray-500' } }}" >
                        {{ $jobApplication->status }}
                    </span>
                </p>
                <p>
                    <strong>Resume:</strong>
                    <a href="{{ $jobApplication->resume->fileUri }}" class="text-blue-500 hover:text-blue-700 underline">
                        {{ $jobApplication->resume->filename }}
                    </a>
                </p>
            </div>

            <div class="flex justify-end space-x-4 mb-6">
                {{-- Edit Button --}}
                <a href="{{ route('job-applications.edit', ['job_application' => $jobApplication->id, 'redirectToList' => 'false']) }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 mt-4 mr-4">Edit</a>
                {{-- Archive Button --}}
                <form action="{{ route('job-applications.destroy', $jobApplication->id) }}" method="POST"
                      class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 mt-4 mr-4">Archive</button>
                </form>
            </div>

            {{--            Tabs Navigation --}}
            <div class="mb-6">
                <ul class="flex space-x-4">
                    <li>
                        <a href="{{ route('job-applications.show', ['job_application' => $jobApplication->id ,'tab' => 'resume']) }}"
                           class="px-4 py-2 text-gray-800 font-semibold {{ request('tab') == 'resume' || request('tab') == '' ? 'border-b-2 border-blue-500' : '' }}">
                            Resume
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('job-applications.show', ['job_application' => $jobApplication->id ,'tab' => 'AIFeedback']) }}"
                           class="px-4 py-2 text-gray-800 font-semibold {{ request('tab') == 'AIFeedback' ? 'border-b-2 border-blue-500' : '' }}">
                            AI Feedback
                        </a>
                    </li>
                </ul>
            </div>

            {{--            Tap Content --}}
            <div>
                {{--                Resume Tab --}}
                <div id="resume" class="{{ request('tab') == 'resume' || request('tab') == '' ? 'block' : 'hidden' }}">
                    <table class="min-w-full bg-gray-50 rounded-lg shadow">
                        <thead>
                        <tr>
                            <th class="py-2 px-4 text-left bg-gray-100 rounded-tl-lg">Summary</th>
                            <th class="py-2 px-4 text-left bg-gray-100">Skills</th>
                            <th class="py-2 px-4 text-left bg-gray-100">Experience</th>
                            <th class="py-2 px-4 text-left bg-gray-100 rounded-tl-lg">Education</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4">{{ $jobApplication->resume->summary }}</td>
                                <td class="py-2 px-4">{{ $jobApplication->resume->skills }}</td>
                                <td class="py-2 px-4">{{ $jobApplication->resume->experience }}</td>
                                <td class="py-2 px-4">{{ $jobApplication->resume->education }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{--                AI Feedback Tab --}}
                <div id="AIFeedback" class="{{ request('tab') == 'AIFeedback' ? 'block' : 'hidden' }}">
                    <table class="min-w-full bg-gray-50 rounded-lg shadow">
                        <thead>
                        <tr>
                            <th class="py-2 px-4 text-left bg-gray-100 rounded-tl-lg">AI Score</th>
                            <th class="py-2 px-4 text-left bg-gray-100">Feedback</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4">{{ $jobApplication->aiGeneratedScore }}</td>
                                <td class="py-2 px-4">{{ $jobApplication->aiGeneratedFeedback }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

