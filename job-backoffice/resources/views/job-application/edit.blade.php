<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Applicant Status') }}
        </h2>
    </x-slot>

    <div class="overflow-x-auto p-6">
        <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
            <form action="{{ route('job-applications.update', ['job_application' => $jobApplication->id, 'redirectToList' => request()->input('redirectToList')]) }}" method="POST">
                @csrf
                @method('put')

                {{--                Job Applicatino Details --}}
                <div class="mb-4 p-6 bg-gray-50 border-gray-100 rounded-lg shadow-sm">
                    <h3 class="text-lg font-bold">Job Application Details</h3>
                    <p class="text-sm mb-2">Change the status of this application</p>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Applicant Name
                        </label>
                        <span>{{ $jobApplication->user->name }}</span>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Job Vacancy
                        </label>
                        <span>{{ $jobApplication->jobVacancy->title }}</span>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Company
                        </label>
                        <span>{{ $jobApplication->jobVacancy->company->name }}</span>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            AI Generated Score
                        </label>
                        <span>{{ $jobApplication->aiGeneratedScore }}</span>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            AI Generated Feedback
                        </label>
                        <span>{{ $jobApplication->aiGeneratedFeedback }}</span>
                    </div>


                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">
                            Status
                        </label>
                        <select
                            name="status" id="status" class="{{ $errors->has('status') ? 'outline-red-500 outline outline-1' : '' }} mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option class="text-yellow-500" value="pending" {{ old('status', $jobApplication->status) == 'pending' ? 'selected' : '' }}>Pending - Under review</option>
                            <option class="text-green-500" value="accepted" {{ old('status', $jobApplication->status) == 'accepted' ? 'selected' : '' }}>Accepted - Qualified</option>
                            <option class="text-red-500" value="rejected" {{ old('status', $jobApplication->status) == 'rejected' ? 'selected' : '' }}>Rejected - Disqualified</option>
                        </select>
                        @error('type')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{--                Action Buttons --}}
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('job-applications.index') }}" class="inline-flex items-center py-2 bg-white text-gray-500 rounded-md hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 mt-4 mr-4">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 mt-4 mr-4">
                            Update Applicant Status
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
