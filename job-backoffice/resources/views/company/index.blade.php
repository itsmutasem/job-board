<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Companies {{ request()->has('archived') == 'true' ? '(Archived)' : '' }}
        </h2>
    </x-slot>

    <div class="overflow-x-auto p-6">
        <x-toast-notification/>

        <div class="flex justify-end items-center">
            @if(request()->input('archived') == 'true')
                {{-- Active --}}
                <a href="{{ route('companies.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 mt-4 mr-4">
                    Active Companies
                </a>

            @else
                {{-- Archived --}}
                <a href="{{ route('companies.index', ['archived' => 'true']) }}"
                   class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 mt-4 mr-4">
                    Archived Companies
                </a>
            @endif
            {{-- Add company Button --}}
            <a href="{{ route('companies.create') }}"
               class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 mt-4 mr-4">
                Add Companies
            </a>
        </div>

        {{--        Companise Table --}}
        <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow mt-4 bg-white">
            <thead>
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Company Name</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Address</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Industry</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Website</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($companies as $company)
                <tr class="border-b">
                    <td class="px-6 py-4 text-gray-800">
                        @if(request()->input('archived') == 'true')
                            <span class="text-gray-500">{{ $company->name }}</span>
                        @else
                            <a class="text-blue-500 hover:text-gray-700 underline"
                               href="{{ route('companies.show', $company->id) }}">
                                {{ $company->name }}
                            </a>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-800">{{ $company->address }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $company->industry }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $company->website }}</td>
                    <td>
                        <div class="flex space-x-4">
                            @if(request()->input('archived') == 'true')
                                {{-- Restore Button --}}
                                <form action="{{ route('companies.restore', $company->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-green-500 hover:text-green-700">🔄️ Restore
                                    </button>
                                </form>
                            @else
                                {{-- Edit Button --}}
                                <a href="{{ route('companies.edit', ['company' => $company->id, 'redirectToList' => 'true']) }}"
                                   class="text-blue-500 hover:text-blue-700">🖋️ Edit</a>
                                {{-- Archive Button --}}
                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                                      class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">🗃️ Archive</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="px-6 py-4 text-gray-800">No Categories found</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $companies->links() }}
        </div>
    </div>
</x-app-layout>

