<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                Dashboard
            </h2>
            <div class="text-sm text-gray-600">
                Bienvenido, <span class="font-semibold">{{ Auth::user()->name }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-indigo-600 to-blue-600 overflow-hidden shadow-lg rounded-xl">
                <div class="p-8 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">¡Bienvenido al Sistema de Facturación!</h3>
                            <p class="text-indigo-100 text-lg">Gestiona tu negocio de manera eficiente</p>
                        </div>
                        <div class="hidden md:block">
                            <svg class="w-20 h-20 text-white opacity-30" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Stat Card 1 -->
                <div class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition transform hover:-translate-y-1 duration-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 mb-1">Clientes</p>
                                <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Client::count() }}</p>
                                <p class="text-xs text-gray-500 mt-2">Total registrados</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 2 -->
                <div class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition transform hover:-translate-y-1 duration-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 mb-1">Productos</p>
                                <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Product::count() }}</p>
                                <p class="text-xs text-gray-500 mt-2">En catálogo</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 3 -->
                <div class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition transform hover:-translate-y-1 duration-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 mb-1">Facturas</p>
                                <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Invoice::count() }}</p>
                                <p class="text-xs text-gray-500 mt-2">Totales emitidas</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 4 -->
                <div class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition transform hover:-translate-y-1 duration-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 mb-1">Pagos</p>
                                <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Payment::count() }}</p>
                                <p class="text-xs text-gray-500 mt-2">Registrados</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-yellow-100 rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Acciones Rápidas</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('clients.create') }}" class="flex items-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg hover:from-blue-100 hover:to-blue-200 transition group">
                            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Nuevo Cliente</p>
                                <p class="text-xs text-gray-600">Registrar cliente</p>
                            </div>
                        </a>

                        <a href="{{ route('products.create') }}" class="flex items-center p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-lg hover:from-green-100 hover:to-green-200 transition group">
                            <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Nuevo Producto</p>
                                <p class="text-xs text-gray-600">Agregar producto</p>
                            </div>
                        </a>

                        <a href="{{ route('invoices.create') }}" class="flex items-center p-4 bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg hover:from-purple-100 hover:to-purple-200 transition group">
                            <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Nueva Factura</p>
                                <p class="text-xs text-gray-600">Crear factura</p>
                            </div>
                        </a>

                        <a href="{{ route('payments.index') }}" class="flex items-center p-4 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg hover:from-yellow-100 hover:to-yellow-200 transition group">
                            <div class="w-10 h-10 bg-yellow-600 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Ver Pagos</p>
                                <p class="text-xs text-gray-600">Historial de pagos</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Invoices -->
                <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Facturas Recientes</h3>
                            <a href="{{ route('invoices.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Ver todas</a>
                        </div>
                        @php
                            $recentInvoices = \App\Models\Invoice::latest()->take(5)->get();
                        @endphp
                        @if($recentInvoices->count() > 0)
                            <div class="space-y-3">
                                @foreach($recentInvoices as $invoice)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                        <div class="flex-1">
                                            <p class="font-medium text-gray-900">{{ $invoice->client->name ?? 'N/A' }}</p>
                                            <p class="text-xs text-gray-500">{{ $invoice->created_at->format('d/m/Y') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-semibold text-gray-900">${{ number_format($invoice->total, 2) }}</p>
                                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                                                @if($invoice->status === 'paid') bg-green-100 text-green-800
                                                @elseif($invoice->status === 'pending') bg-yellow-100 text-yellow-800
                                                @else bg-red-100 text-red-800
                                                @endif">
                                                {{ ucfirst($invoice->status) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-8">No hay facturas registradas</p>
                        @endif
                    </div>
                </div>

                <!-- Recent Payments -->
                <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Pagos Recientes</h3>
                            <a href="{{ route('payments.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Ver todos</a>
                        </div>
                        @php
                            $recentPayments = \App\Models\Payment::latest()->take(5)->get();
                        @endphp
                        @if($recentPayments->count() > 0)
                            <div class="space-y-3">
                                @foreach($recentPayments as $payment)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                        <div class="flex-1">
                                            <p class="font-medium text-gray-900">{{ $payment->invoice->client->name ?? 'N/A' }}</p>
                                            <p class="text-xs text-gray-500">{{ $payment->payment_date->format('d/m/Y') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-semibold text-green-600">${{ number_format($payment->amount, 2) }}</p>
                                            <p class="text-xs text-gray-500">{{ ucfirst($payment->payment_method) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-8">No hay pagos registrados</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
