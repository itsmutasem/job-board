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
                <form action="{{ route('dashboard') }}" method="get" class="flex items-center justify-center w-1/4">
                    <input type="text" name="search" value="{{ request('search') }}" class="w-full rounded-l-lg bg-white/10 text-white border-white/10" placeholder="search for a job">
                    <button type="submit" class="bg-indigo-500 text-white p-2 rounded-r-lg border border-indigo-500">Search</button>

                    @if(request('filter'))
                        <input type="hidden" name="filter" value="{{ request('filter') }}">
                    @endif
                </form>

{{--                Filters --}}
                <div class="flex space-x-2">
                    <a href="{{ route('dashboard', ['filter' => 'Full-Time', 'search' => request('search')]) }}"
                       class="bg-indigo-500 text-white p-2 rounded-lg">
                        Full-Time
                    </a>
                    <a href="{{ route('dashboard', ['filter' => 'Remote', 'search' => request('search')]) }}"
                       class="bg-indigo-500 text-white p-2 rounded-lg">
                        Remote
                    </a>
                    <a href="{{ route('dashboard', ['filter' => 'Hybrid', 'search' => request('search')]) }}"
                       class="bg-indigo-500 text-white p-2 rounded-lg">
                        Hybrid
                    </a>
                    <a href="{{ route('dashboard', ['filter' => 'Contract', 'search' => request('search')]) }}"
                       class="bg-indigo-500 text-white p-2 rounded-lg">
                        Contract
                    </a>
                </div>
            </div>

{{--            Job List --}}
            <div class="space-y-4 mt-4">
                @forelse($jobs as $job)
                    <div class="border-b border-white/10 pb-4 flex justify-between items-center">
    {{--                    Job Item --}}
                        <div>
                            <a href="" class="text-lg font-semibold text-indigo-500 hover:underline">{{ $job->title }}</a>
                            <p class="text-sm text-white">{{ $job->company->name }} - {{ $job->location }}</p>
                            <p class="text-sm text-white">${{ number_format($job->salary) }} / Year</p>
                        </div>
                        <span class="bg-indigo-500 text-white p-2 rounded-lg">{{ $job->type }}</span>
                    </div>
                @empty
                    <p class="text-white text-2xl font-bold">No jobs found!</p>
                @endforelse
            </div>
            <div class="mt-6">
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
