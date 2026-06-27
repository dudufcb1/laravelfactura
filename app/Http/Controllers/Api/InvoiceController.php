<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::with(['client', 'company', 'payments'])
            ->where('status', '!=', 'cancelled');

        if ($from = $request->get('from')) {
            $to = $request->get('to', Carbon::now()->toDateString());
            $query->dateBetween($from, $to);
        }

        if ($status = $request->get('status')) {
            $query->status($status);
        }

        if ($clientId = $request->get('client_id')) {
            $query->client($clientId);
        }

        if ($companyId = $request->get('company_id')) {
            $query->where('company_id', $companyId);
        }

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                  ->orWhereHas('client', function ($cq) use ($search) {
                      $cq->where('name', 'like', "%{$search}%")
                         ->orWhere('business_name', 'like', "%{$search}%");
                  });
            });
        }

        $invoices = $query->orderByDesc('issued_at')
            ->paginate($request->get('per_page', 25));

        $invoices->getCollection()->transform(function ($invoice) {
            $invoice->total_paid = $invoice->total_paid;
            $invoice->remaining_balance = $invoice->remaining_balance;
            $invoice->payment_status = $invoice->payment_status;
            return $invoice;
        });

        return response()->json($invoices);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'client_id' => 'required|exists:clients,id',
            'payment_type' => 'required|in:cash,credit',
            'credit_days' => 'nullable|integer|min:0',
            'currency' => 'required|in:USD,NIO',
            'exchange_rate' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.discount' => 'nullable|numeric|min:0',
        ]);

        $company = Company::findOrFail($validated['company_id']);

        $subtotal = 0;
        $tax = 0;
        $productData = [];

        foreach ($validated['products'] as $item) {
            $product = \App\Models\Product::findOrFail($item['id']);
            $discount = $item['discount'] ?? 0;
            $lineTotal = ($item['price'] * $item['quantity']) - $discount;
            $lineTax = $lineTotal * ($product->tax_rate / 100);

            $subtotal += $lineTotal;
            $tax += $lineTax;

            $productData[$item['id']] = [
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'discount' => $discount,
                'total' => $lineTotal,
            ];
        }

        $invoiceNumber = $company->assignNextInvoiceNumber();
        $dueDate = $validated['payment_type'] === 'credit'
            ? Carbon::now()->addDays($validated['credit_days'] ?? 30)
            : Carbon::now();

        $invoice = Invoice::create([
            'company_id' => $validated['company_id'],
            'client_id' => $validated['client_id'],
            'invoice_series' => $company->invoice_series,
            'invoice_number' => $invoiceNumber,
            'status' => 'issued',
            'payment_type' => $validated['payment_type'],
            'credit_days' => $validated['credit_days'] ?? 0,
            'due_date' => $dueDate,
            'currency' => $validated['currency'],
            'exchange_rate' => $validated['exchange_rate'] ?? 1,
            'notes' => $validated['notes'] ?? null,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $subtotal + $tax,
            'issued_at' => Carbon::now(),
        ]);

        $company->updateNextInvoiceNumber();
        $invoice->products()->attach($productData);

        return response()->json(
            $invoice->load(['client', 'company', 'products']),
            201
        );
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['client', 'company', 'products', 'payments']);
        $invoice->total_paid = $invoice->total_paid;
        $invoice->remaining_balance = $invoice->remaining_balance;
        $invoice->payment_status = $invoice->payment_status;

        return response()->json($invoice);
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'notes' => 'nullable|string',
            'due_date' => 'nullable|date',
            'credit_days' => 'nullable|integer|min:0',
        ]);

        $invoice->update($validated);

        return response()->json($invoice->load(['client', 'company']));
    }

    public function destroy(Invoice $invoice)
    {
        if (! $invoice->canBeVoided()) {
            return response()->json(['error' => 'Esta factura no puede ser anulada.'], 422);
        }

        $invoice->voidInvoice('Anulada vía API', auth()->id());

        return response()->json(['message' => 'Factura anulada.']);
    }

    public function pdf(Invoice $invoice)
    {
        $invoice->load(['client', 'company', 'products']);

        $logoImage = null;
        if ($invoice->company->logo_path) {
            if (Storage::exists($invoice->company->logo_path)) {
                $imageData = Storage::get($invoice->company->logo_path);
                $type = pathinfo($invoice->company->logo_path, PATHINFO_EXTENSION);
                $logoImage = 'data:image/' . $type . ';base64,' . base64_encode($imageData);
            }
        }

        $statusPath = 'public/company-logos/' . ($invoice->status === 'paid' ? 'Pagado.png' : 'Pendiente.png');
        $statusImage = null;
        if (Storage::exists($statusPath)) {
            $imageData = Storage::get($statusPath);
            $type = pathinfo($statusPath, PATHINFO_EXTENSION);
            $statusImage = 'data:image/' . $type . ';base64,' . base64_encode($imageData);
        }

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('invoices.pdf', [
            'invoice' => $invoice,
            'logoImage' => $logoImage,
            'statusImage' => $statusImage,
        ]);

        $filename = 'Factura_' . $invoice->invoice_series . '-' . $invoice->invoice_number . '.pdf';

        return response()->json([
            'base64' => base64_encode($pdf->output()),
            'filename' => $filename,
            'mimetype' => 'application/pdf',
            'invoice_number' => $invoice->invoice_series . '-' . $invoice->invoice_number,
            'client' => $invoice->client->name ?? $invoice->client->business_name,
            'total' => $invoice->total,
            'currency' => $invoice->currency,
        ]);
    }
}
