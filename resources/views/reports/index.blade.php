<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-calendar-check mr-2 medical-icon"></i> {{ __('reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (Auth::user()->role == 'doctor')
                <!-- reports Management -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 dashboard-card">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-primary-color"><i class="fas fa-calendar-alt mr-2"></i>
                                {{ __('Manage Your reports') }}</h3>
                            <a href="{{ route('reports.create') }}" class="primary-button py-2 px-4 rounded-md">
                                <i class="fas fa-plus-circle mr-2"></i> {{ __('New Report') }}
                            </a>
                        </div>
                        <p class="mb-4">{{ __('View and manage all your scheduled reports.') }}</p>
                    </div>
                </div>
            @endif
            @if (Auth::user()->role == 'patient')
                <!-- reports List -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dashboard-card">
                    <div class="p-6">
                        <h3 class="text-lg font-medium mb-4"><i class="fas fa-list-alt mr-2 medical-icon"></i>
                            {{ __('Your reports') }}</h3>

                        @if (count($reports) > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead class="bg-blue-50">
                                        <tr>
                                            <th
                                                class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Title') }}</th>
                                            <th
                                                class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($reports as $report)
                                            <tr>
                                                <td class="py-4 px-4 whitespace-nowrap">{{ $report->title }}</td>
                                                <td class="py-4 px-4 whitespace-nowrap">
                                                </td>
                                                <td class="py-4 px-4 whitespace-nowrap text-sm font-medium">
                                                    <div class="flex space-x-2">
                                                        <a href="{{ route('reports.show', $report->id) }}"
                                                            class="text-blue-600 hover:text-blue-900">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('reports.edit', $report->id) }}"
                                                            class="text-yellow-600 hover:text-yellow-900">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @if ($user_role == 'doctor')
                                                            <form action="{{ route('reports.destroy', $report->id) }}"
                                                                method="POST" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="text-red-600 hover:text-red-900"
                                                                    onclick="return confirm('Are you sure you want to cancel this report?')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        {{-- To Dowenload The Report --}}
                                                        <a href="{{ asset('storage/' . $report->report_path) }}"
                                                            class="text-green-600 hover:text-green-900" download>
                                                            <i class="fas fa-download"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="text-5xl text-gray-300 mb-4">
                                    <i class="fas fa-calendar-times"></i>
                                </div>
                                <p class="text-gray-500 mb-4">{{ __('You don\'t have any reports yet.') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
