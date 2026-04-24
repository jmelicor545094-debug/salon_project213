<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Process Payment') }}</h2>
            <a href="{{ route('payments.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-900 rounded-md hover:bg-gray-300">Back</a>
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

                <form method="POST" action="{{ route('payments.store') }}">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <x-input-label for="appointment_id" value="{{ __('Appointment') }}" />
                            <select id="appointment_id" name="appointment_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100" required>
                                <option value="">Select appointment</option>
                                @foreach($appointments as $appointment)
                                    <option value="{{ $appointment->id }}" @selected(old('appointment_id') == $appointment->id)>
                                        {{ $appointment->customer_name }} — {{ $appointment->service->name }} on {{ $appointment->scheduled_at->format('M d, Y \@ h:i A') }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('appointment_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="amount" value="{{ __('Amount') }}" />
                            <x-text-input id="amount" name="amount" type="number" step="0.01" class="mt-1 block w-full" value="{{ old('amount') }}" required />
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="payment_method" value="{{ __('Payment Method') }}" />
                            <x-text-input id="payment_method" name="payment_method" type="text" class="mt-1 block w-full" value="{{ old('payment_method') }}" placeholder="Cash, Card, Mobile Pay" />
                            <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="status" value="{{ __('Payment Status') }}" />
                            <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100" required>
                                <option value="Paid" @selected(old('status') == 'Paid')>Paid</option>
                                <option value="Unpaid" @selected(old('status') == 'Unpaid')>Unpaid</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save Payment') }}</x-primary-button>
                            <a href="{{ route('payments.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400">{{ __('Cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
