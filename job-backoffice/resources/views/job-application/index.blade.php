<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Job Applications {{ request()->has('archived') == 'true' ? '(Archived)' : '' }}
        </h2>
    </x-slot>

    <div class="overflow-x-auto p-6">
        <x-toast-notification/>

        <div class="flex justify-end items-center">
            @if(request()->input('archived') == 'true')
                {{-- Active --}}
                <a href="{{ route('job-applications.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 mt-4 mr-4">
                    Active Job Applications
                </a>

            @else
                {{-- Archived --}}
                <a href="{{ route('job-applications.index', ['archived' => 'true']) }}"
                   class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 mt-4 mr-4">
                    Archived Job Applications
                </a>
            @endif
        </div>

        {{--        Job Applications Table --}}
        <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow mt-4 bg-white">
            <thead>
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Applicant Name</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Position (Job Vacancy)</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Company</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($jobApplications as $jobApplication)
                <tr class="border-b">
                    <td class="px-6 py-4 text-gray-800">
                        @if(request()->input('archived') == 'true')
                            <span class="text-gray-500">{{ $jobApplication->user->name }}</span>
                        @else
                            <a class="text-blue-500 hover:text-gray-700 underline"
                               href="{{ route('job-applications.show', $jobApplication->id) }}">
                                {{ $jobApplication->user->name }}
                            </a>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-800">{{ $jobApplication->jobVacancy->title }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $jobApplication->jobVacancy->company->name }}</td>
                    <td class="px-6 py-4 text-gray-800 {{ match($jobApplication->status) { 'pending' => 'text-yellow-500', 'accepted' => 'text-green-500', 'rejected' => 'text-red-500', default => 'text-gray-500' } }}">
                        {{ $jobApplication->status }}
                    </td>
                    <td>
                        <div class="flex space-x-4">
                            @if(request()->input('archived') == 'true')
                                {{-- Restore Button --}}
                                <form action="{{ route('job-applications.restore', $jobApplication->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-green-500 hover:text-green-700">🔄️ Restore
                                    </button>
                                </form>
                            @else
                                {{-- Edit Button --}}
                                <a href="{{ route('job-applications.edit', ['job_application' => $jobApplication->id, 'redirectToList' => 'true']) }}"
                                   class="text-blue-500 hover:text-blue-700">🖋️ Edit</a>
                                {{-- Archive Button --}}
                                <form action="{{ route('job-applications.destroy', $jobApplication->id) }}" method="POST"
                                      class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">🗃️ Archive</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="px-6 py-4 text-gray-800">No job applications found</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $jobApplications->links() }}
        </div>
    </div>
</x-app-layout>

