<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-calendar-plus mr-2 medical-icon"></i> {{ __('Schedule New Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dashboard-card">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-primary-color mb-4">
                        <i class="fas fa-clipboard-list mr-2"></i> {{ __('Appointment Details') }}
                    </h3>

                    <form method="POST" action="{{ route('appointments.store') }}">
                        @csrf

                        <!-- Date -->
                        <div class="mb-4">
                            <x-input-label for="date" :value="__('Appointment Date')" />
                            <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')" required autofocus />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>

                        <!-- Time -->
                        <div class="mb-4">
                            <x-input-label for="time" :value="__('Appointment Time')" />
                            <x-text-input id="time" class="block mt-1 w-full" type="time" name="time" :value="old('time')" required />
                            <x-input-error :messages="$errors->get('time')" class="mt-2" />
                        </div>

                        

                        <!-- Additional Notes -->
                        <div class="mb-4">
                            <x-input-label for="notes" :value="__('Additional Notes')" />
                            <textarea id="notes" name="notes" rows="4" class="block mt-1 w-full border-gray-300 focus:border-primary-color focus:ring-primary-color rounded-md shadow-sm">{{ old('notes') }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('appointments.index') }}" class="secondary-button mr-3">
                                <i class="fas fa-times mr-1"></i> {{ __('Cancel') }}
                            </a>
                            <x-primary-button type="submit">
                                <i class="fas fa-save mr-1"></i> {{ __('Schedule Appointment') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>