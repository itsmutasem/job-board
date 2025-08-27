<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Company') }}
        </h2>
    </x-slot>

    <div class="overflow-x-auto p-6">
        <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
            <form action="{{ route('companies.store') }}" method="POST">
                @csrf

{{--                Company Details --}}
                    <div class="mb-4 p-6 bg-gray-50 border-gray-100 rounded-lg shadow-sm">
                        <h3 class="text-lg font-bold">Company Details</h3>
                        <p class="text-sm mb-2">Enter the company details</p>
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Company Name
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="{{ $errors->has('name') ? 'outline-red-500 outline outline-1' : '' }} mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="address" class="block text-sm font-medium text-gray-700">
                                Address
                            </label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}" class="{{ $errors->has('address') ? 'outline-red-500 outline outline-1' : '' }} mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('address')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="industry" class="block text-sm font-medium text-gray-700">
                                Industry
                            </label>
                            <select
                                name="industry" id="industry" class="{{ $errors->has('industry') ? 'outline-red-500 outline outline-1' : '' }} mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @foreach($industries as $industry)
                                    <option value="{{ $industry }}">{{ $industry }}</option>
                                @endforeach
                            </select>
                            @error('industry')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="website" class="block text-sm font-medium text-gray-700">
                                Website
                            </label>
                            <input type="text" name="website" id="website" value="{{ old('website') }}" class="{{ $errors->has('website') ? 'outline-red-500 outline outline-1' : '' }} mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('website')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

{{--                Owner Details --}}
                <div class="mb-4 p-6 bg-gray-50 border-gray-100 rounded-lg shadow-sm">
                    <h3 class="text-lg font-bold">Company Details</h3>
                    <p class="text-sm mb-2">Enter the owner details</p>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('companies.index') }}" class="inline-flex items-center py-2 bg-white text-gray-500 rounded-md hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 mt-4 mr-4">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 mt-4 mr-4">
                        Add Company
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
