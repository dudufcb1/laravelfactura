<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['invoice.client'])
            ->where('status', 'completed');

        if ($from = $request->get('from')) {
            $to = $request->get('to', Carbon::now()->toDateString());
            $query->whereBetween('payment_date', [
                Carbon::parse($from)->startOfDay(),
                Carbon::parse($to)->endOfDay(),
            ]);
        }

        if ($invoiceId = $request->get('invoice_id')) {
            $query->where('invoice_id', $invoiceId);
        }

        if ($method = $request->get('payment_method')) {
            $query->where('payment_method', $method);
        }

        return response()->json(
            $query->orderByDesc('payment_date')
                ->paginate($request->get('per_page', 25))
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'amount_paid' => 'required|numeric|min:0.01',
            'payment_currency' => 'required|in:USD,NIO',
            'exchange_rate' => 'nullable|numeric|min:0',
            'payment_method' => 'required|in:cash,bank_transfer,check,credit_card,debit_card,other',
            'reference_number' => 'nullable|string',
            'notes' => 'nullable|string',
            'payment_date' => 'nullable|date',
            'bank_name' => 'nullable|string',
            'bank_account' => 'nullable|string',
        ]);

        $invoice = Invoice::findOrFail($validated['invoice_id']);

        if ($invoice->status === 'cancelled') {
            return response()->json(['error' => 'No se puede registrar pago en factura anulada.'], 422);
        }

        if ($invoice->remaining_balance <= 0) {
            return response()->json(['error' => 'Esta factura ya está pagada.'], 422);
        }

        $payment = Payment::create([
            ...$validated,
            'user_id' => auth()->id(),
            'status' => 'completed',
            'payment_date' => $validated['payment_date'] ?? Carbon::now(),
            'exchange_rate' => $validated['exchange_rate'] ?? 1,
        ]);

        return response()->json(
            $payment->load('invoice.client'),
            201
        );
    }

    public function show(Payment $payment)
    {
        return response()->json($payment->load('invoice.client'));
    }
}
