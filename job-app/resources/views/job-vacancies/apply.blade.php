<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ $jobVacancy->title }} - Apply
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="bg-black shadow-lg rounded-lg p-6 max-w-7xl mx-auto">
            {{--            Back Button --}}
            <a href="{{ route('job-vacancies.show', $jobVacancy->id) }} " class="text-white hover:text-gray-300 hover:underline mb-6 inline-block">
                ← Back to Job Details
            </a>

            <div class="border-b border-white/10 pb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-white">{{ $jobVacancy->title }}</h1>
                        <p class="text-md text-gray-400">{{ $jobVacancy->company->name }}</p>
                        <div class="flex items-center gap-2">
                            <p class="text-sm text-gray-400">{{ $jobVacancy->location }}</p>
                            <span class="text-sm text-gray-400">•</span>
                            <p class="text-sm text-gray-400">${{ number_format($jobVacancy->salary) }}</p>
                            <p class="text-sm bg-indigo-500 text-white p-2 rounded-lg">{{ $jobVacancy->type }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('job-vacancies.process-application', $jobVacancy->id) }}" method="POST" class="space-y-6">
                @csrf

                @if($errors->any())
                    <div class="bg-red-500 text-white p-4 rounded-lg">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

{{--                Resume Selection --}}
                <div>
                    <h3 class="text-xl font-semibold text-white mb-4">Choose Your Resume</h3>
                    <div class="mb-6">
                        <x-input-label for="resumes" value="Select form your existing resumes:" />
{{--                       TODO: List of Resumes --}}
                    </div>
                </div>

{{--                Upload New Resume --}}
                <div x-data="{ fileName: '', hasError: {{ $errors->has('resume_file') ? 'true' : 'false' }} }">
                    <x-input-label for="resume" value="Or upload a new resumes:" />
                    <div class="flex items-center">
                        <div class="flex-1">
                            <label for="new_resume_file" class="block text-white cursor-pointer">
                                <div class="border-2 border-dashed border-gray-600 rounded-lg p-4 hover:border-blue-500 transition"
                                    :class="{'border-blue-500': fileName, 'border-red-500': hasError }">
                                    <input @change="fileName = $event.target.files[0].name" type="file" name="resume_file" id="new_resume_file" class="hidden" accept=".pdf">
                                    <div class="text-center">
                                        <template x-if="!fileName">
                                            <p class="text-gray-400">Click to upload PDF (Max 5MB)</p>
                                        </template>

                                        <template x-if="fileName">
                                            <div>
                                                <p x-text="fileName" class="mt-4 text-blue-400"></p>
                                                <p class="text-gray-400 text-sm mt-1">Click to change file</p>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

{{--                Submit Button --}}
                <div>
                    <x-primary-button class="w-full">
                        Apply Now
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
