<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ $jobVacancy->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="bg-black shadow-lg rounded-lg p-6 max-w-7xl mx-auto">
{{--            Back Button --}}
            <a href="{{ route('dashboard') }} " class="text-white hover:text-gray-300 hover:underline mb-6 inline-block">
                ← Back to Jobs
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
        </div>
    </div>
</x-app-layout>
