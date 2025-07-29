<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-calendar-check mr-2 medical-icon"></i> {{ __('Appointments') }}
        </h2>
    </x-slot>

    @if (Auth::user()->role != 'doctor')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Appointments Management -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dashboard-card mb-6">
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
            </div>
        </div>
    @endif


    <!-- Confirmed Appointments -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dashboard-card mb-6">
        <div class="p-6">
            <h3 class="text-lg font-medium mb-4"><i class="fas fa-check-circle mr-2 text-green-600"></i>
                {{ __('Confirmed Appointments') }}</h3>

            @php
                $confirmedAppointments = $appointments->where('status', 'confirmed');
            @endphp

            @if ($confirmedAppointments->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-green-50">
                            <tr>
                                <th
                                    class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Patient Name') }}</th>
                                <th
                                    class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Date') }}</th>
                                <th
                                    class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Time') }}</th>
                                <th
                                    class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Price') }}</th>
                                <th
                                    class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($confirmedAppointments as $appointment)
                                <tr>
                                    <td class="py-4 px-4 whitespace-nowrap">{{ $appointment->user->name }}</td>
                                    <td class="py-4 px-4 whitespace-nowrap">{{ $appointment->date }}</td>
                                    <td class="py-4 px-4 whitespace-nowrap">{{ $appointment->time }}</td>
                                    <td class="py-4 px-4 whitespace-nowrap">${{ $appointment->price }}</td>
                                    <td class="py-4 px-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('appointments.show', $appointment->id) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('appointments.edit', $appointment->id) }}"
                                                class="text-yellow-600 hover:text-yellow-900">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('appointments.destroy', $appointment->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900"
                                                    onclick="return confirm('Are you sure you want to cancel this appointment?')">
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
                <p class="text-gray-500 text-center py-4">{{ __('No confirmed appointments found.') }}</p>
            @endif
        </div>
    </div>

    <!-- Pending Appointments -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dashboard-card">
        <div class="p-6">
            <h3 class="text-lg font-medium mb-4"><i class="fas fa-clock mr-2 text-yellow-600"></i>
                {{ __('Pending Appointments') }}</h3>

            @php
                $pendingAppointments = $appointments->where('status', 'pending');
            @endphp

            @if ($pendingAppointments->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-yellow-50">
                            <tr>
                                <th
                                    class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Patient Name') }}</th>
                                <th
                                    class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Date') }}</th>
                                <th
                                    class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Time') }}</th>
                                <th
                                    class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Price') }}</th>
                                <th
                                    class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($pendingAppointments as $appointment)
                                <tr>
                                    <td class="py-4 px-4 whitespace-nowrap">{{ $appointment->user->name }}</td>
                                    <td class="py-4 px-4 whitespace-nowrap">{{ $appointment->date }}</td>
                                    <td class="py-4 px-4 whitespace-nowrap">{{ $appointment->time }}</td>
                                    <td class="py-4 px-4 whitespace-nowrap">${{ $appointment->price }}</td>
                                    <td class="py-4 px-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('appointments.show', $appointment->id) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('appointments.edit', $appointment->id) }}"
                                                class="text-yellow-600 hover:text-yellow-900">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('appointments.destroy', $appointment->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900"
                                                    onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @if (Auth::user()->role == 'doctor')
                                                {{-- Confirm Or Cancel The Appointement --}}
                                                <form
                                                    action="{{ route('appointments.changeStatus', $appointment->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="confirmed">
                                                    <button type="submit" class="text-green-600 hover:text-green-900">
                                                        <i class="fas fa-check"></i> {{ __('Confirm') }}
                                                    </button>
                                                </form>
                                                <form
                                                    action="{{ route('appointments.changeStatus', $appointment->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                                        <i class="fas fa-times"></i> {{ __('Cancel') }}
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 text-center py-4">{{ __('No pending appointments found.') }}</p>
            @endif
        </div>
    </div>
    </div>
    </div>
    </div>
    </td>

</x-app-layout>
