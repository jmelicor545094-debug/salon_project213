<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Edit Appointment') }}</h2>
            <a href="{{ route('appointments.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-900 rounded-md hover:bg-gray-300">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                @if($errors->any())
                    <div class="mb-4 rounded-md bg-red-100 p-4 text-red-800">
                        <ul class="list-disc ps-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('appointments.update', $appointment) }}">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <x-input-label for="service_id" value="{{ __('Service') }}" />
                            <select id="service_id" name="service_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100" required>
                                <option value="">Select service</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" @selected(old('service_id', $appointment->service_id) == $service->id)>{{ $service->name }} — ₱{{ number_format($service->price, 2) }} / {{ $service->duration }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="customer_name" value="{{ __('Customer Name') }}" />
                            <x-text-input id="customer_name" name="customer_name" type="text" class="mt-1 block w-full" value="{{ old('customer_name', $appointment->customer_name) }}" required />
                            <x-input-error :messages="$errors->get('customer_name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="customer_phone" value="{{ __('Customer Phone') }}" />
                            <x-text-input id="customer_phone" name="customer_phone" type="text" class="mt-1 block w-full" value="{{ old('customer_phone', $appointment->customer_phone) }}" required />
                            <x-input-error :messages="$errors->get('customer_phone')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="scheduled_at" value="{{ __('Date and Time') }}" />
                            <x-text-input id="scheduled_at" name="scheduled_at" type="datetime-local" class="mt-1 block w-full" value="{{ old('scheduled_at', $appointment->scheduled_at->format('Y-m-d\TH:i')) }}" required />
                            <x-input-error :messages="$errors->get('scheduled_at')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update Appointment') }}</x-primary-button>
                            <a href="{{ route('appointments.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400">{{ __('Cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
