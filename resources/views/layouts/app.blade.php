<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            @if (session('demo_mode_notice'))
                @php
                    $demoBlocked = session('demo_mode_blocked', false);
                @endphp
                <div id="demo-mode-toast"
                     class="fixed top-4 right-4 z-50 max-w-md transform rounded-lg border border-amber-200 bg-white shadow-lg transition duration-300 ease-out">
                    <div class="flex items-start gap-3 px-4 py-3">
                        <svg class="h-5 w-5 {{ $demoBlocked ? 'text-amber-600' : 'text-sky-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1 text-sm text-gray-700">
                            <p class="font-semibold text-gray-900">Modo demostración activo</p>
                            <p>{{ session('demo_mode_notice') }}</p>
                        </div>
                        <button type="button"
                                class="text-gray-400 transition hover:text-gray-600"
                                aria-label="Cerrar aviso"
                                data-dismiss="demo-toast">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <script>
                    window.addEventListener('DOMContentLoaded', () => {
                        const toast = document.getElementById('demo-mode-toast');
                        if (!toast) {
                            return;
                        }

                        const hide = () => {
                            toast.classList.add('opacity-0', 'translate-y-2');
                            window.setTimeout(() => toast.remove(), 200);
                        };

                        const closeButton = toast.querySelector('[data-dismiss="demo-toast"]');
                        if (closeButton) {
                            closeButton.addEventListener('click', hide, { once: true });
                        }

                        window.setTimeout(hide, 6000);
                    });
                </script>
            @endif

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            @if(config('app.demo_site', false))
            <!-- Demo Footer -->
            <footer class="bg-white border-t border-gray-200 mt-12">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="text-center text-sm text-gray-600">
                        <p>Built with Laravel & Tailwind CSS</p>
                        <p class="mt-1">&copy; {{ date('Y') }} LaravelFactura - Demo Version</p>
                    </div>
                </div>
            </footer>
            @endif
        </div>
    </body>
</html>
