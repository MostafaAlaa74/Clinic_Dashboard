<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-chart-line mr-2 medical-icon"></i> {{ __('Monthly Revenue') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Revenue Management -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 dashboard-card">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-primary-color"><i class="fas fa-money-bill-wave mr-2"></i>
                            {{ __('Revenue Tracking') }}</h3>
                    </div>
                    <p class="mb-4">{{ __('Track and manage monthly revenue from appointments.') }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <!-- Calculate Current Month Revenue -->
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h4 class="font-medium text-blue-700 mb-2"><i class="fas fa-calendar-day mr-2"></i> {{ __('Current Month') }}</h4>
                            <p class="text-sm text-gray-600 mb-4">{{ __('Calculate revenue for the current month.') }}</p>
                            <form action="{{ route('revenues.calculate-current') }}" method="POST">
                                @csrf
                                <button type="submit" class="primary-button py-2 px-4 rounded-md w-full">
                                    <i class="fas fa-sync-alt mr-2"></i> {{ __('Update Current Month') }}
                                </button>
                            </form>
                        </div>

                        <!-- Calculate Specific Month Revenue -->
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="font-medium text-green-700 mb-2"><i class="fas fa-calendar-alt mr-2"></i> {{ __('Specific Month') }}</h4>
                            <p class="text-sm text-gray-600 mb-4">{{ __('Calculate revenue for a specific month.') }}</p>
                            <form action="{{ route('revenues.calculate-specific') }}" method="POST" class="flex flex-col space-y-3">
                                @csrf
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label for="month" class="block text-sm font-medium text-gray-700">{{ __('Month') }}</label>
                                        <select id="month" name="month" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50">
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" {{ now()->month == $i ? 'selected' : '' }}>
                                                    {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div>
                                        <label for="year" class="block text-sm font-medium text-gray-700">{{ __('Year') }}</label>
                                        <select id="year" name="year" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-color focus:ring focus:ring-primary-color focus:ring-opacity-50">
                                            @for ($i = now()->year; $i >= 2020; $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="primary-button py-2 px-4 rounded-md">
                                    <i class="fas fa-calculator mr-2"></i> {{ __('Calculate') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Revenue Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dashboard-card">
                <div class="p-6">
                    <h3 class="text-lg font-medium mb-4"><i class="fas fa-table mr-2 medical-icon"></i>
                        {{ __('Monthly Revenue History') }}</h3>

                    @if (count($formattedRevenues) > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-blue-50">
                                    <tr>
                                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Month') }}</th>
                                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Year') }}</th>
                                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Revenue') }}</th>
                                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Last Updated') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($formattedRevenues as $revenue)
                                        <tr>
                                            <td class="py-4 px-4 whitespace-nowrap">{{ $revenue['month_name'] }}</td>
                                            <td class="py-4 px-4 whitespace-nowrap">{{ $revenue['year'] }}</td>
                                            <td class="py-4 px-4 whitespace-nowrap">${{ number_format($revenue['total_revenue'], 2) }}</td>
                                            <td class="py-4 px-4 whitespace-nowrap">{{ $revenue['updated_at']->format('M d, Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-chart-bar text-gray-300 text-5xl mb-4"></i>
                            <p class="text-gray-500">{{ __('No revenue data available yet.') }}</p>
                            <p class="text-gray-500 text-sm mt-2">{{ __('Use the controls above to calculate monthly revenue.') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>