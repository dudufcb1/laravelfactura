<x-guest-layout>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Bienvenido</h1>
            <p class="text-gray-600">Sistema de Facturación Laravel</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Demo Credentials Section -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-4 mb-6">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                <div class="flex-1">
                    <h3 class="text-sm font-semibold text-blue-900 mb-2">Credenciales Demo</h3>
                    <div class="space-y-2 text-sm">
                        <div class="bg-white bg-opacity-60 rounded p-2">
                            <p class="font-medium text-gray-900">Administrador</p>
                            <p class="text-gray-700 font-mono text-xs mt-1">admin@laravelfactura.com</p>
                            <p class="text-gray-700 font-mono text-xs">admin123</p>
                        </div>
                        <div class="bg-white bg-opacity-60 rounded p-2">
                            <p class="font-medium text-gray-900">Contador</p>
                            <p class="text-gray-700 font-mono text-xs mt-1">contador@laravelfactura.com</p>
                            <p class="text-gray-700 font-mono text-xs">contador123</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Correo Electrónico')" class="text-gray-700 font-medium" />
                <x-text-input
                    id="email"
                    class="block mt-2 w-full px-4 py-3 border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="correo@ejemplo.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700 font-medium" />
                <x-text-input
                    id="password"
                    class="block mt-2 w-full px-4 py-3 border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Ingresa tu contraseña" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                    <input
                        id="remember_me"
                        type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 transition cursor-pointer"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-700 group-hover:text-gray-900 transition">{{ __('Recordarme') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition"
                       href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-semibold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition duration-200">
                    {{ __('Iniciar Sesión') }}
                </button>
            </div>
        </form>

        <!-- Additional Info -->
        <div class="text-center text-sm text-gray-600 pt-4 border-t border-gray-200">
            <p>Sistema de Facturación - Demo Técnico</p>
        </div>
    </div>
</x-guest-layout>
