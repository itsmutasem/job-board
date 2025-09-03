<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="bg-black shadow-lg rounded-lg p-6 max-w-7xl mx-auto">
            <h3 class="text-white text-2xl font-bold mb-6">
                {{ __('Welcome back,') }} {{ Auth::user()->name }}!
            </h3>

{{--            Search & Filters --}}
            <div class="flex items-center justify-between">
{{--                Search Bar --}}
                <form action="" class="flex items-center justify-center w-1/4">
                    <input type="text" class="w-full rounded-l-lg bg-white/10 text-white border-white/10" placeholder="search for a job">
                    <button type="submit" class="bg-indigo-500 text-white p-2 rounded-r-lg border border-indigo-500">Search</button>
                </form>

{{--                Filters --}}
                <div class="flex space-x-2">
                    <a href="" class="bg-indigo-500 text-white p-2 rounded-lg">Full Time</a>
                    <a href="" class="bg-indigo-500 text-white p-2 rounded-lg">Remote</a>
                    <a href="" class="bg-indigo-500 text-white p-2 rounded-lg">Hybrid</a>
                    <a href="" class="bg-indigo-500 text-white p-2 rounded-lg">Contract</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
