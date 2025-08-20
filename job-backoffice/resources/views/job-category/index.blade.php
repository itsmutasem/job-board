<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Categories') }}
        </h2>
    </x-slot>

    <div class="overflow-x-auto p-6">
{{--        Flash Messages --}}
        <div class="fixed inset-x-0 top-6 z-50 flex justify-center">
            @if(session('create-job-category'))
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition.duration.500ms
                    x-init="setTimeout(() => show = false, 4000)"
                    class="max-w-lg w-full bg-green-100 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg shadow-lg flex items-center justify-between"
                    role="alert"
                >
                    <div class="flex items-center space-x-2">
                        <!-- Success Check Icon -->
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('create-job-category') }}</span>
                    </div>

                    <!-- Close (X) Button -->
                    <button @click="show = false" class="ml-4 text-green-700 hover:text-green-900 focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
        </div>

{{--        Job Category Button --}}
        <div class="flex justify-end items-center">
            <a href="{{ route('job-categories.create') }}" class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 mt-4 mr-4">
                Add Job Category
            </a>
        </div>

{{--        Job Category Table --}}
        <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow mt-4 bg-white">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Category Name</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr class="border-b">
                        <td class="px-6 py-4 text-gray-800">{{ $category->name }}</td>
                        <td>
                            <div class="flex space-x-4">
    {{--                            Edit Button --}}
                                <a href="{{ route('job-categories.edit', $category->id) }}" class="text-blue-500 hover:text-blue-700">🖋️ Edit</a>
    {{--                            Archive Button --}}
                                <form action="{{ route('job-categories.destroy', $category->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">🗃️ Archive</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</x-app-layout>

