<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->get('from', Carbon::now()->startOfMonth()->toDateString());
        $to = $request->get('to', Carbon::now()->endOfMonth()->toDateString());
        $companyId = $request->get('company_id');

        $invoicesQuery = Invoice::dateBetween($from, $to)
            ->where('status', '!=', 'cancelled');

        if ($companyId) {
            $invoicesQuery->where('company_id', $companyId);
        }

        $invoices = $invoicesQuery->get();

        $totalInvoiced = $invoices->sum('total');
        $totalPaid = $invoices->sum('total_paid');
        $totalPending = $invoices->sum('remaining_balance');
        $invoiceCount = $invoices->count();

        $paymentsInPeriod = Payment::whereBetween('payment_date', [
            Carbon::parse($from)->startOfDay(),
            Carbon::parse($to)->endOfDay(),
        ])->where('status', 'completed')->sum('converted_amount');

        $creditInvoices = Invoice::where('payment_type', 'credit')
            ->where('status', '!=', 'cancelled')
            ->where('status', '!=', 'paid')
            ->count();

        return response()->json([
            'period' => ['from' => $from, 'to' => $to],
            'total_invoiced' => round($totalInvoiced, 2),
            'total_collected' => round($totalPaid, 2),
            'total_pending' => round($totalPending, 2),
            'payments_in_period' => round($paymentsInPeriod, 2),
            'invoice_count' => $invoiceCount,
            'credit_invoices_open' => $creditInvoices,
            'total_clients' => Client::count(),
        ]);
    }

    public function receivables(Request $request)
    {
        $invoices = Invoice::with(['client', 'company'])
            ->where('status', '!=', 'cancelled')
            ->where('status', '!=', 'paid')
            ->orderBy('due_date')
            ->get()
            ->map(function ($invoice) {
                $daysOverdue = $invoice->due_date
                    ? Carbon::now()->diffInDays($invoice->due_date, false)
                    : null;

                return [
                    'invoice_id' => $invoice->id,
                    'invoice_number' => $invoice->invoice_series . '-' . $invoice->invoice_number,
                    'client' => $invoice->client->name ?? $invoice->client->business_name,
                    'company' => $invoice->company->name,
                    'total' => round($invoice->total, 2),
                    'paid' => round($invoice->total_paid, 2),
                    'pending' => round($invoice->remaining_balance, 2),
                    'currency' => $invoice->currency,
                    'due_date' => $invoice->due_date?->toDateString(),
                    'days_overdue' => $daysOverdue !== null ? (int) abs($daysOverdue) : null,
                    'is_overdue' => $daysOverdue !== null && $daysOverdue < 0,
                    'issued_at' => $invoice->issued_at?->toDateString(),
                ];
            });

        $totalPending = $invoices->sum('pending');
        $overdueCount = $invoices->where('is_overdue', true)->count();
        $overdueAmount = $invoices->where('is_overdue', true)->sum('pending');

        return response()->json([
            'total_pending' => round($totalPending, 2),
            'overdue_count' => $overdueCount,
            'overdue_amount' => round($overdueAmount, 2),
            'invoices' => $invoices->values(),
        ]);
    }
}
