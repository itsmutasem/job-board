<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User Password') }}
        </h2>
    </x-slot>

    <div class="overflow-x-auto p-6">
        <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('put')

                {{--                User Details --}}
                <div class="mb-4 p-6 bg-gray-50 border-gray-100 rounded-lg shadow-sm">
                    <h3 class="text-lg font-bold">User Details</h3>
                    <p class="text-sm mb-2">Change the user password</p>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Name
                        </label>
                        <span>{{ $user->name }}</span>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Email
                        </label>
                        <span>{{ $user->email }}</span>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Role
                        </label>
                        <span>{{ $user->role }}</span>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Change User Password
                        </label>
                        <div class="relative" x-data="{ show: false }">

                            <div class="relative">
                                <x-text-input id="password" class="{{ $errors->has('password') ? 'outline-red-500 outline outline-1' : '' }} block mt-1 w-full pr-10" x-bind:type="show ? 'text' : 'password'"
                                              name="password" autocomplete="current-password" />

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

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>

                    {{--                Action Buttons --}}
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('users.index') }}" class="inline-flex items-center py-2 bg-white text-gray-500 rounded-md hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 mt-4 mr-4">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 mt-4 mr-4">
                            Update User Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
