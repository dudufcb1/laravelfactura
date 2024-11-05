<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Facturas') }}
      </h2>
      <a href="{{ route('invoices.create') }}"
        class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
        {{ __('Nueva Factura') }}
      </a>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      {{-- Mensajes flash --}}
      @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700">
          {{ session('success') }}
        </div>
      @endif

      @if (session('error'))
        <div class="mb-4 rounded-lg bg-red-100 p-4 text-red-700">
          {{ session('error') }}
        </div>
      @endif

      {{-- Listado de facturas --}}
      <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th scope="col"
                class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                Serie/Número
              </th>
              <th scope="col"
                class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                Cliente
              </th>
              <th scope="col"
                class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                Estado
              </th>
              <th scope="col"
                class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                Tipo de Pago
              </th>
              <th scope="col"
                class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                Vencimiento
              </th>
              <th scope="col"
                class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                Total
              </th>
              <th scope="col"
                class="bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                Moneda
              </th>
              <th scope="col" class="relative bg-gray-50 px-6 py-3">
                <span class="sr-only">Acciones</span>
              </th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 bg-white">
            @forelse ($invoices as $invoice)
              <tr>
                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                  {{ $invoice->invoice_series }}-{{ $invoice->invoice_number }}
                  @if ($invoice->reference_number)
                    <div class="text-xs text-gray-500">Ref: {{ $invoice->reference_number }}</div>
                  @endif
                </td>
                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                  {{ $invoice->client->name }}
                  <div class="text-xs">{{ $invoice->client->document_number }}</div>
                </td>
                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                  @if ($invoice->status === 'issued')
                    <span
                      class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">
                      Emitida
                    </span>
                  @else
                    <span
                      class="inline-flex rounded-full bg-yellow-100 px-2 text-xs font-semibold leading-5 text-yellow-800">
                      Pendiente
                    </span>
                  @endif
                </td>
                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                  @if ($invoice->payment_type === 'cash')
                    <span
                      class="inline-flex rounded-full bg-blue-100 px-2 text-xs font-semibold leading-5 text-blue-800">
                      Contado
                    </span>
                  @else
                    <span
                      class="inline-flex rounded-full bg-purple-100 px-2 text-xs font-semibold leading-5 text-purple-800">
                      Crédito ({{ $invoice->credit_days }} días)
                    </span>
                  @endif
                </td>
                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                  @if ($invoice->due_date)
                    {{ \Carbon\Carbon::parse($invoice->due_date)->format('d/m/Y') }}
                  @else
                    -
                  @endif
                </td>
                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                  {{ number_format($invoice->total, 2) }}
                  <div class="text-xs text-gray-500">
                    Sub: {{ number_format($invoice->subtotal, 2) }}
                    <br>
                    IVA: {{ number_format($invoice->tax, 2) }}
                  </div>
                </td>
                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                  {{ $invoice->currency }}
                  @if ($invoice->exchange_rate)
                    <div class="text-xs">TC: {{ number_format($invoice->exchange_rate, 2) }}</div>
                  @endif
                </td>
                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                  <div class="flex justify-end gap-2">
                    <a href="{{ route('invoices.show', $invoice) }}"
                      class="text-blue-600 hover:text-blue-900">
                      Ver
                    </a>
                    <a href="{{ route('invoices.edit', $invoice) }}"
                      class="text-indigo-600 hover:text-indigo-900">
                      Editar
                    </a>
                    <form action="{{ route('invoices.destroy', $invoice) }}"
                      method="POST"
                      class="inline"
                      onsubmit="return confirm('¿Estás seguro de querer eliminar esta factura?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-600 hover:text-red-900">
                        Eliminar
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                  No hay facturas registradas
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>

        @if ($invoices->count())
          <div class="px-6 py-4">
            {{ $invoices->links() }}
          </div>
        @endif
      </div>
    </div>
  </div>
</x-app-layout>