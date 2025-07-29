<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-calendar-check mr-2 medical-icon"></i> {{ __('Appointments') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 bg-gray-50 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-semibold text-gray-800">Notifications</h2>
                    @if (count($notifications) > 0)
                        <button id="mark-all-read"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                            Mark All as Read
                        </button>
                    @endif
                </div>
            </div>

            <div class="divide-y divide-gray-200">
                @forelse($notifications as $notification)
                    <div
                        class="p-6 hover:bg-gray-50 transition {{ is_null($notification->read_at) ? 'bg-blue-50' : '' }}">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-4">
                                @if (is_null($notification->read_at))
                                    <span class="inline-block w-3 h-3 bg-blue-500 rounded-full"></span>
                                @else
                                    <span class="inline-block w-3 h-3 bg-gray-300 rounded-full"></span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between">
                                    <h3 class="text-lg font-medium text-gray-900">
                                        {{ $notification->data['title'] ?? ($notification->data['message'] ?? 'Notification') }}
                                    </h3>
                                    <span class="text-sm text-gray-500">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <p class="mt-1 text-gray-600">
                                    {{ $notification->data['message'] ?? '' }}
                                </p>
                                @if (isset($notification->data['action_url']))
                                    <div class="mt-3">
                                        <a href="{{ $notification->data['action_url'] }}"
                                            class="text-blue-600 hover:text-blue-800 transition">
                                            {{ $notification->data['action_text'] ?? 'View Details' }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center">
                        <p class="text-gray-500">You have no notifications.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const markAllReadBtn = document.getElementById('mark-all-read');

                if (markAllReadBtn) {
                    markAllReadBtn.addEventListener('click', function() {
                        fetch('{{ route('notifications.markAsRead') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content')
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    window.location.reload();
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>
