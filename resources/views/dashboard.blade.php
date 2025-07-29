<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-clinic-medical mr-2 medical-icon"></i> {{ __('Clinic Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 dashboard-card">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-primary-color mb-2"><i class="fas fa-user-md mr-2"></i>
                        {{ __('Welcome to Doctor Clinic') }}</h3>
                    <p>{{ __('Manage your appointments, patients, and medical records all in one place.') }}</p>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <a href="{{ route('dayappointment.index') }}">
                    <!-- Appointments Card -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dashboard-card">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-100 mr-4">
                                    <i class="fas fa-calendar-check text-xl medical-icon"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">{{ __('Today\'s Appointments') }}</p>
                                    <p class="text-2xl font-semibold">{{ $appointmentNumber }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('patients.index') }}">
                    <!-- Patients Card -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dashboard-card">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 mr-4">
                                    <i class="fas fa-users text-xl medical-icon"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">{{ __('Total Patients') }}</p>
                                    <p class="text-2xl font-semibold">{{ $patientNumber }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
