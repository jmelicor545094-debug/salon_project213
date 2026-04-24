<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Dashboard') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 md:grid-cols-3">
                <div class="rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Total Services') }}</h3>
                    <p class="mt-4 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $serviceCount }}</p>
                </div>
                <div class="rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Appointments') }}</h3>
                    <p class="mt-4 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $appointmentCount }}</p>
                </div>
                <div class="rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Payments Recorded') }}</h3>
                    <p class="mt-4 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $paymentCount }}</p>
                </div>
            </div>

            <div class="mt-6 grid gap-6 md:grid-cols-2">
                <div class="rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Unpaid Appointments') }}</h3>
                    <p class="mt-4 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $unpaidAppointments }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
