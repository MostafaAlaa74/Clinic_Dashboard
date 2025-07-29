<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-calendar-check mr-2 medical-icon"></i> {{ __('Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Appointments Management -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 dashboard-card">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-primary-color"><i class="fas fa-calendar-alt mr-2"></i>
                            {{ __('Manage Your Appointments') }}</h3>
                        <a href="{{ route('appointments.create') }}" class="primary-button py-2 px-4 rounded-md">
                            <i class="fas fa-plus-circle mr-2"></i> {{ __('New Appointment') }}
                        </a>
                    </div>
                    <p class="mb-4">{{ __('View and manage all your scheduled appointments.') }}</p>
                </div>
            </div>

            <!-- Appointments List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dashboard-card">
                <div class="p-6">
                    <h3 class="text-lg font-medium mb-4"><i class="fas fa-list-alt mr-2 medical-icon"></i>
                        {{ __('Your Appointments') }}</h3>
                    
                    @if(isset($appointments) && count($appointments) > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-blue-50">
                                    <tr>
                                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Date') }}</th>
                                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Time') }}</th>
                                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Price') }}</th>
                                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($appointments as $appointment)
                                        <tr>
                                            <td class="py-4 px-4 whitespace-nowrap">{{ $appointment->date }}</td>
                                            <td class="py-4 px-4 whitespace-nowrap">{{ $appointment->time }}</td>
                                            <td class="py-4 px-4 whitespace-nowrap">${{ $appointment->price }}</td>
                                            <td class="py-4 px-4 whitespace-nowrap">
                                                @if($appointment->status == 'confirmed')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        {{ __('Confirmed') }}
                                                    </span>
                                                @elseif($appointment->status == 'pending')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        {{ __('Pending') }}
                                                    </span>
                                                @elseif($appointment->status == 'cancelled')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        {{ __('Cancelled') }}
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                        {{ $appointment->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-4 px-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('appointments.show', $appointment->id) }}" class="text-blue-600 hover:text-blue-900">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="text-yellow-600 hover:text-yellow-900">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
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
                            <p class="text-gray-500 mb-4">{{ __('You don\'t have any appointments yet.') }}</p>
                            <a href="{{ route('appointments.create') }}" class="primary-button py-2 px-4 rounded-md">
                                <i class="fas fa-plus-circle mr-2"></i> {{ __('Schedule Your First Appointment') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
                            <div>
                                <p class="font-medium">{{ __('Appointment rescheduled') }}</p>
                                <p class="text-sm text-gray-600">{{ __('Emily Davis - 2 hours ago') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
