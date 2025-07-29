<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-calendar-day mr-2 medical-icon"></i> {{ __('Appointment Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dashboard-card">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-primary-color">
                            <i class="fas fa-info-circle mr-2"></i> {{ __('Appointment Information') }}
                        </h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('appointments.edit', $appointment->id) }}" class="secondary-button py-2 px-4 rounded-md">
                                <i class="fas fa-edit mr-1"></i> {{ __('Edit') }}
                            </a>
                            <a href="{{ route('appointments.index') }}" class="primary-button py-2 px-4 rounded-md">
                                <i class="fas fa-arrow-left mr-1"></i> {{ __('Back to List') }}
                            </a>
                        </div>
                    </div>

                    <div class="bg-blue-50 p-4 rounded-lg mb-6">
                        <div class="flex items-center mb-2">
                            <div class="p-3 rounded-full bg-blue-100 mr-4">
                                <i class="fas fa-calendar-check text-xl medical-icon"></i>
                            </div>
                            <div>
                                <h4 class="font-medium">{{ __('Appointment Status') }}</h4>
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
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">{{ __('Date') }}</h4>
                                <p class="mt-1">{{ $appointment->date }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">{{ __('Time') }}</h4>
                                <p class="mt-1">{{ $appointment->time }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">{{ __('Consultation Fee') }}</h4>
                                <p class="mt-1">${{ $appointment->price }}</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">{{ __('Created At') }}</h4>
                                <p class="mt-1">{{ $appointment->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">{{ __('Last Updated') }}</h4>
                                <p class="mt-1">{{ $appointment->updated_at->format('Y-m-d H:i') }}</p>
                            </div>
                            @if(isset($appointment->notes))
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">{{ __('Additional Notes') }}</h4>
                                <p class="mt-1">{{ $appointment->notes }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="danger-button py-2 px-4 rounded-md" onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                <i class="fas fa-trash mr-1"></i> {{ __('Cancel Appointment') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>