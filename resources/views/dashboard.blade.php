<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(config('app.demo_site', false))
                        <h3 class="text-lg font-semibold mb-2">Welcome to the Demo!</h3>
                        <p>{{ __("You're logged in to the demo version of the application.") }}</p>
                        <p class="mt-2 text-sm text-gray-600">Explore the features and functionality freely.</p>
                    @else
                        {{ __("You're logged in!") }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
