<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-file-upload mr-2 medical-icon"></i> {{ __('Upload Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dashboard-card">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-primary-color mb-4">
                        <i class="fas fa-file-upload mr-2"></i> {{ __('Upload Report') }}
                    </h3>

                    <form method="POST" action="{{ route('reports.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- User ID -->
                        <div class="mb-4">
                            <x-input-label for="user_id" :value="__('User ID')" />
                            <x-text-input id="user_id" class="block mt-1 w-full" type="number" name="user_id"
                                :value="old('user_id')" required autofocus />
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>

                        <!-- File Upload -->
                        <div class="mb-4">
                            <x-input-label for="report_file" :value="__('Report File')" />
                            <input id="report_file" class="block mt-1 w-full" type="file" name="file"
                                required />
                            <x-input-error :messages="$errors->get('report_file')" class="mt-2" />
                        </div>

                        <!-- Additional Notes -->
                        <div class="mb-4">
                            <x-input-label for="notes" :value="__('Additional Notes')" />
                            <textarea id="notes" name="notes" rows="4"
                                class="block mt-1 w-full border-gray-300 focus:border-primary-color focus:ring-primary-color rounded-md shadow-sm">{{ old('notes') }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('reports.index') }}" class="secondary-button mr-3">
                                <i class="fas fa-times mr-1"></i> {{ __('Cancel') }}
                            </a>
                            <x-primary-button type="submit">
                                <i class="fas fa-upload mr-1"></i> {{ __('Upload Report') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
