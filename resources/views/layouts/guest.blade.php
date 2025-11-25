<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
  $defaultCompany = \App\Models\Company::where('default', true)->first();
@endphp

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

<body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
  <div class="min-h-screen">
    <!-- Header -->
    <div class="relative overflow-hidden bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-600">
      <div class="absolute inset-0 bg-black/20"></div>
      <div class="relative max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
        <div class="text-center">
          <!-- Logo -->
          <div class="flex justify-center mb-6">
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-4 border border-white/20 shadow-xl">
              <img
                src="{{ $defaultCompany && $defaultCompany->logo_path ? Storage::url($defaultCompany->logo_path) : asset('images/default-logo.png') }}"
                alt="Company Logo"
                class="h-16 w-16 object-contain">
            </div>
          </div>

          <!-- Title -->
          <h1 class="text-4xl font-bold text-white mb-4 tracking-tight">
            Demo - Sistema de Facturación
          </h1>
          <p class="text-xl text-indigo-100 mb-8">
            Demostración de capacidades para desarrollar soluciones fiscales adaptadas a cada país y cliente
          </p>
        </div>
      </div>

      <!-- Wave decoration -->
      <div class="absolute bottom-0 left-0 right-0">
        <svg class="w-full h-16 fill-slate-50" viewBox="0 0 1200 120" preserveAspectRatio="none">
          <path d="M0,60 C400,0 800,120 1200,60 L1200,120 L0,120 Z"></path>
        </svg>
      </div>
    </div>

    <!-- Main Content -->
    <div class="relative -mt-8">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(config('app.demo_site', false))
        <!-- Login + Demo Credentials Grid -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 md:gap-8 lg:gap-10 items-stretch">
          <!-- Login Form -->
          <div class="bg-white rounded-xl border border-gray-200 p-6 sm:p-8 md:p-10 shadow-lg h-full flex flex-col">
            <div class="grow">
              {{ $slot }}
            </div>
          </div>

          <!-- Demo Credentials -->
          <div class="bg-gradient-to-br from-white via-indigo-50 to-blue-50 border border-indigo-200 p-6 sm:p-8 md:p-10 shadow-lg rounded-xl flex flex-col gap-6 h-full">
            <div class="mb-6">
              <div class="flex items-center space-x-3 mb-4">
                <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m0 0a2 2 0 012 2m-2-2a2 2 0 00-2 2m2-2V5a2 2 0 00-2-2m0 0V3a2 2 0 00-2-2m2 2a2 2 0 002 2m0 0v2a2 2 0 002 2m-2-2a2 2 0 002 2"></path>
                  </svg>
                </div>
                <div>
                  <h3 class="text-lg sm:text-xl font-bold text-indigo-900">Acceso de Demostración</h3>
                  <p class="text-xs sm:text-sm text-indigo-700">Explore este proyecto demo para evaluar nuestras capacidades</p>
                </div>
              </div>
            </div>

            <div class="space-y-4 grow">
              <div class="bg-white rounded-lg p-4 border border-indigo-100 shadow-sm">
                <div class="flex items-center justify-between mb-2">
                  <span class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Administrador</span>
                  <span class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded">Acceso Total</span>
                </div>
                <div class="space-y-1">
                  <p class="font-mono text-sm text-gray-900 bg-gray-50 px-3 py-1 rounded border">admin@laravelfactura.com</p>
                  <p class="font-mono text-sm text-gray-700 bg-gray-50 px-3 py-1 rounded border">admin123</p>
                </div>
              </div>

              <div class="bg-white rounded-lg p-4 border border-indigo-100 shadow-sm">
                <div class="flex items-center justify-between mb-2">
                  <span class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Contador</span>
                  <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">Acceso Limitado</span>
                </div>
                <div class="space-y-1">
                  <p class="font-mono text-sm text-gray-900 bg-gray-50 px-3 py-1 rounded border">contador@laravelfactura.com</p>
                  <p class="font-mono text-sm text-gray-700 bg-gray-50 px-3 py-1 rounded border">contador123</p>
                </div>
              </div>
            </div>

            <div class="mt-6 p-4 bg-indigo-100 rounded-lg">
              <p class="text-xs sm:text-sm text-indigo-800 font-medium leading-relaxed">
                Este es un proyecto demo que muestra nuestras capacidades de desarrollo. Podemos crear sistemas similares o partir de este para adaptarlo a diferentes marcos fiscales según las necesidades específicas de cada país y cliente.
              </p>
            </div>
          </div>
        </div>
        @else
        <!-- Single Login (no demo mode) -->
        <div class="max-w-lg mx-auto">
          <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-lg">
            {{ $slot }}
          </div>
        </div>
        @endif
      </div>
    </div>

    @if(config('app.demo_site', false))
    <!-- FAQ Section -->
    <div class="max-w-4xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
      <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-8 py-6">
          <h3 class="text-2xl font-bold text-white">Preguntas Frecuentes</h3>
          <p class="text-indigo-100 mt-1">Todo lo que necesitas saber sobre este demo</p>
        </div>

        <div class="px-8 py-8">
          <div class="grid gap-8 md:grid-cols-2">
            <div class="space-y-6">
              <div>
                <h4 class="font-semibold text-lg text-gray-900 mb-3">¿Qué es este demo?</h4>
                <p class="text-gray-600 leading-relaxed">
                  Un proyecto de demostración que exhibe nuestras capacidades de desarrollo en sistemas de facturación
                  con control de series correlativas, gestión de inventario y registro de clientes.
                </p>
              </div>

              <div>
                <h4 class="font-semibold text-lg text-gray-900 mb-3">¿Pueden adaptarlo para mi país?</h4>
                <p class="text-gray-600 leading-relaxed">
                  Sí. Podemos desarrollar versiones personalizadas de este sistema o crear uno nuevo desde cero,
                  adaptándolo a los requerimientos fiscales específicos de cada país y cliente.
                </p>
              </div>
            </div>

            <div class="space-y-6">
              <div>
                <h4 class="font-semibold text-lg text-gray-900 mb-3">¿Qué servicios ofrecemos?</h4>
                <p class="text-gray-600 leading-relaxed">
                  Desarrollo de sistemas de facturación personalizados, adaptación de este demo a normativas específicas,
                  integración con sistemas existentes, y soluciones fiscales a medida para cada mercado.
                </p>
              </div>

              <div>
                <h4 class="font-semibold text-lg text-gray-900 mb-3">¿Quieres un proyecto personalizado?</h4>
                <p class="text-gray-600 leading-relaxed">
                  Encuentra mis datos de contacto en el footer. Desarrollo sistemas similares a este demo
                  o completamente nuevos, adaptados a las necesidades fiscales y operativas específicas de tu país y negocio.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer Credits -->
    <x-footer />
    @endif
  </div>
</body>

</html>
