<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }}
        </h2>
    </x-slot>

    <div class="overflow-x-auto p-6">
        <x-toast-notification />

        <div class="w-full mx-auto p-6 bg-white rounded-lg shadow">
            {{-- Company Details --}}
            <div>
                <h3 class="text-lg font-bold">Company Information</h3>
                <p><strong>Address:</strong> {{ $company->address }}</p>
                <p><strong>Industry:</strong> {{ $company->industry }}</p>
                <p><strong>Website:</strong> <a class="text-blue-500 hover:text-blue-700 underline" href="{{ $company->webiste }}" target="_blank">{{ $company->website }}</a></p>
            </div>

            <div class="flex justify-end space-x-4 mb-6">
                {{-- Edit Button --}}
                <a href="{{ route('companies.edit', $company->id) }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 mt-4 mr-4">Edit</a>
                {{-- Archive Button --}}
                <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                      class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 mt-4 mr-4">Archive</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

