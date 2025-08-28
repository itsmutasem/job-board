<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Company') . ' - ' . $company->name }}
        </h2>
    </x-slot>

    <div class="overflow-x-auto p-6">
        <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
            <form action="{{ route('companies.update', ['company' => $company->id, 'redirectToList' => request('redirectToList')]) }}" method="POST">
                @csrf
                @method('PUT')

                {{--                Company Details --}}
                <div class="mb-4 p-6 bg-gray-50 border-gray-100 rounded-lg shadow-sm">
                    <h3 class="text-lg font-bold">Company Details</h3>
                    <p class="text-sm mb-2">Enter the company details</p>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Company Name
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $company->name) }}" class="{{ $errors->has('name') ? 'outline-red-500 outline outline-1' : '' }} mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700">
                            Address
                        </label>
                        <input type="text" name="address" id="address" value="{{ old('address', $company->address) }}" class="{{ $errors->has('address') ? 'outline-red-500 outline outline-1' : '' }} mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
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
                                <option value="{{ $industry }}"
                                    {{ old('industry', $company->industry) == $industry ? 'selected' : '' }}>
                                    {{ $industry }}
                                </option>
                            @endforeach
                        </select>
                        @error('industry')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="website" class="block text-sm font-medium text-gray-700">
                            Website (optional)
                        </label>
                        <input type="text" name="website" id="website" value="{{ old('website', $company->website) }}" class="{{ $errors->has('website') ? 'outline-red-500 outline outline-1' : '' }} mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('website')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{--                Owner Details --}}
                <div class="mb-4 p-6 bg-gray-50 border-gray-100 rounded-lg shadow-sm">
                    <h3 class="text-lg font-bold">Company Owner</h3>
                    <p class="text-sm mb-2">Enter the owner details</p>
                    <div class="mb-4">
                        <label for="owner_name" class="block text-sm font-medium text-gray-700">
                            Owner Name
                        </label>
                        <input type="text" name="owner_name" id="owner_name" value="{{ old('owner_name', $company->owner->name) }}" class="{{ $errors->has('owner_name') ? 'outline-red-500 outline outline-1' : '' }} mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('owner_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

{{--                    Owner Email (read-onle cannot be changed) --}}
                    <div class="mb-4">
                        <label for="owner_email" class="block text-sm font-medium text-gray-700">
                            Owner Email (Read only)
                        </label>
                        <input disabled type="email" name="owner_email" id="owner_email" value="{{ old('owner_email', $company->owner->email) }}" class="{{ $errors->has('owner_email') ? 'outline-red-500 outline outline-1' : '' }} mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-gray-100">
                        @error('owner_email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

{{--                    Onwer Password (can update the password) --}}
                    <div class="mb-4">
                        <label for="owner_password" class="block text-sm font-medium text-gray-700">
                            Change Owner Password (Leave blank to keep the same)
                        </label>
                        <div class="relative" x-data="{ show: false }">

                            <div class="relative">
                                <x-text-input id="owner_password" class="{{ $errors->has('owner_password') ? 'outline-red-500 outline outline-1' : '' }} block mt-1 w-full pr-10" x-bind:type="show ? 'text' : 'password'"
                                              name="owner_password" autocomplete="current-password" />

                                <!-- Eye Icon for Show/Hide Password -->
                                <button type="button" class="absolute inset-y-0 right-2 flex items-center text-gray-500"
                                        @click="show = !show">
                                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                                    </svg>

                                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M13.875 18.825a9.56 9.56 0 01-1.875.175c-4.478 0-8.268-2.943-9.542-7 1.002-3.364 3.843-6 7.542-7.575M15 12a3 3 0 00-6 0 3 3 0 006 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                                    </svg>
                                </button>
                            </div>

                            <x-input-error :messages="$errors->get('owner_password')" class="mt-2" />
                        </div>
                    </div>
                </div>

                {{--                Action Buttons --}}
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('companies.index') }}" class="inline-flex items-center py-2 bg-white text-gray-500 rounded-md hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 mt-4 mr-4">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 mt-4 mr-4">
                        Update Company
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
