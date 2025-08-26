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
        </div>
    </div>
</x-app-layout>

