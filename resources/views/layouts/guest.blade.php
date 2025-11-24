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

<body class="font-sans text-gray-900 antialiased">
  <div class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0">
    <div>
      <a href="/">
        <img
          src="{{ $defaultCompany && $defaultCompany->logo_path ? Storage::url($defaultCompany->logo_path) : asset('images/default-logo.png') }}"
          alt="Company Logo"
          class="h-20 w-20 object-contain">
      </a>
    </div>

    <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
      {{ $slot }}
    </div>

    @if(config('app.demo_site', false))
    <!-- FAQ Section -->
    <div class="mt-8 w-full bg-white px-6 py-6 shadow-md sm:max-w-2xl sm:rounded-lg">
      <h3 class="text-lg font-semibold text-gray-900 mb-4">Frequently Asked Questions</h3>
      <div class="space-y-4">
        <div>
          <h4 class="font-medium text-gray-800">What is this demo?</h4>
          <p class="text-sm text-gray-600 mt-1">This is a demonstration version of our invoicing system. Feel free to explore all features.</p>
        </div>
        <div>
          <h4 class="font-medium text-gray-800">Can I create real invoices?</h4>
          <p class="text-sm text-gray-600 mt-1">Yes, you can create invoices in this demo, but they are for testing purposes only.</p>
        </div>
        <div>
          <h4 class="font-medium text-gray-800">Is my data safe?</h4>
          <p class="text-sm text-gray-600 mt-1">This is a demo environment. Data may be reset periodically for testing purposes.</p>
        </div>
      </div>
    </div>

    <!-- Footer Credits -->
    <div class="mt-6 text-center text-sm text-gray-600 pb-6">
      <p>Built with Laravel & Tailwind CSS</p>
      <p class="mt-1">&copy; {{ date('Y') }} LaravelFactura - Demo Version</p>
    </div>
    @endif
  </div>
</body>

</html>
