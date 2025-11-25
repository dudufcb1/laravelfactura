<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Header -->
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-gray-900">Iniciar Sesión</h2>
        <p class="text-sm text-gray-600 mt-2">Accede a tu cuenta del sistema de facturación</p>
    </div>

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" class="text-sm font-medium text-gray-700" />
            <x-text-input id="email"
                class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-200"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                placeholder="tu@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Contraseña')" class="text-sm font-medium text-gray-700" />
            <x-text-input id="password"
                class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-200"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">Mantener sesión activa</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition duration-200" href="{{ route('password.request') }}">
                    ¿Olvidó su contraseña?
                </a>
            @endif
        </div>

        <div>
            <x-primary-button class="w-full bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 focus:ring-indigo-500 transition duration-200 py-3 text-base font-semibold">
                {{ __('INICIAR SESIÓN') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
