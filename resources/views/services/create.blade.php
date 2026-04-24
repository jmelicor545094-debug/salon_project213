<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Add Service') }}</h2>
            <a href="{{ route('services.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-900 rounded-md hover:bg-gray-300">Back</a>
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

                <form method="POST" action="{{ route('services.store') }}">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <x-input-label for="name" value="{{ __('Service Name') }}" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name') }}" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="price" value="{{ __('Price') }}" />
                            <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" value="{{ old('price') }}" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="duration" value="{{ __('Duration') }}" />
                            <x-text-input id="duration" name="duration" type="text" class="mt-1 block w-full" value="{{ old('duration') }}" placeholder="e.g. 30 mins, 1 hour" required />
                            <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" value="{{ __('Description') }}" />
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save Service') }}</x-primary-button>
                            <a href="{{ route('services.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400">{{ __('Cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
