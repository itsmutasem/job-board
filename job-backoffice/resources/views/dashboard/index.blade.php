<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 px-6">
{{--        Overview Cards --}}
        <div class="grid grid-cols-3 gap-6">

            <div class="p-6 bg-white overflow-hidden shadow-sm rounded-lg">
                <h3 class="text-lg font-medium text-gray-900">Active Users</h3>
                <p class="text-3xl font-bold text-indigo-600">100</p>
                <p class="text-sm text-gray-500">Last 30 days</p>
            </div>

            <div class="p-6 bg-white overflow-hidden shadow-sm rounded-lg">
                <h3 class="text-lg font-medium text-gray-900">Total Jobs</h3>
                <p class="text-3xl font-bold text-indigo-600">100</p>
                <p class="text-sm text-gray-500">All time</p>
            </div>

            <div class="p-6 bg-white overflow-hidden shadow-sm rounded-lg">
                <h3 class="text-lg font-medium text-gray-900">Total Applications</h3>
                <p class="text-3xl font-bold text-indigo-600">100</p>
                <p class="text-sm text-gray-500">All time</p>
            </div>
        </div>
{{--        Most Applied Jobs --}}

{{--        Conversion Rate --}}
    </div>
</x-app-layout>
