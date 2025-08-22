{{--        Flash Messages --}}
<div class="fixed inset-x-0 top-6 z-50 flex justify-center">
    @if(session('create'))
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
                <span>{{ session('create') }}</span>
            </div>

            <!-- Close (X) Button -->
            <button @click="show = false" class="ml-4 text-green-700 hover:text-green-900 focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @elseif(session('update'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition.duration.500ms
            x-init="setTimeout(() => show = false, 4000)"
            class="max-w-lg w-full bg-blue-100 border-l-4 border-blue-500 text-blue-800 px-6 py-4 rounded-lg shadow-lg flex items-center justify-between"
            role="alert"
        >
            <div class="flex items-center space-x-2">
                <!-- Success Check Icon -->
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                </svg>
                <span>{{ session('update') }}</span>
            </div>

            <!-- Close (X) Button -->
            <button @click="show = false" class="ml-4 text-blue-700 hover:text-blue-900 focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif
</div>
