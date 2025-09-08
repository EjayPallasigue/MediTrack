<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    public function index(): View
    {
        $invoices = Invoice::with(['patient', 'appointment'])
            ->latest()
            ->paginate(10);
        
        return view('invoices.index', compact('invoices'));
    }

    public function create(): View
    {
        $patients = Patient::orderBy('first_name')->get();
        $appointments = Appointment::with('patient')->where('status', 'completed')->get();
        
        return view('invoices.create', compact('patients', 'appointments'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'status' => 'required|in:draft,sent,paid,overdue,cancelled',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        // Generate invoice number
        $invoiceNumber = 'INV-' . str_pad(Invoice::max('id') + 1, 6, '0', STR_PAD_LEFT);
        
        // Calculate totals
        $subtotal = 0;
        foreach ($data['items'] as $item) {
            $subtotal += $item['quantity'] * $item['unit_price'];
        }
        
        $taxRate = $data['tax_rate'] ?? 0;
        $taxAmount = $subtotal * ($taxRate / 100);
        $totalAmount = $subtotal + $taxAmount;

        $invoice = Invoice::create([
            'invoice_number' => $invoiceNumber,
            'patient_id' => $data['patient_id'],
            'appointment_id' => $data['appointment_id'],
            'invoice_date' => $data['invoice_date'],
            'due_date' => $data['due_date'],
            'status' => $data['status'],
            'subtotal' => $subtotal,
            'tax_rate' => $taxRate,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount,
            'notes' => $data['notes'],
        ]);

        // Create invoice items
        foreach ($data['items'] as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
            ]);
        }

        return redirect()->route('invoices.show', $invoice)->with('status', 'Invoice created successfully');
    }

    public function show(Invoice $invoice): View
    {
        $invoice->load(['patient', 'appointment', 'items']);
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice): View
    {
        $patients = Patient::orderBy('first_name')->get();
        $appointments = Appointment::with('patient')->where('status', 'completed')->get();
        $invoice->load('items');
        
        return view('invoices.edit', compact('invoice', 'patients', 'appointments'));
    }

    public function update(Request $request, Invoice $invoice): RedirectResponse
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'status' => 'required|in:draft,sent,paid,overdue,cancelled',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        // Calculate totals
        $subtotal = 0;
        foreach ($data['items'] as $item) {
            $subtotal += $item['quantity'] * $item['unit_price'];
        }
        
        $taxRate = $data['tax_rate'] ?? 0;
        $taxAmount = $subtotal * ($taxRate / 100);
        $totalAmount = $subtotal + $taxAmount;

        $invoice->update([
            'patient_id' => $data['patient_id'],
            'appointment_id' => $data['appointment_id'],
            'invoice_date' => $data['invoice_date'],
            'due_date' => $data['due_date'],
            'status' => $data['status'],
            'subtotal' => $subtotal,
            'tax_rate' => $taxRate,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount,
            'notes' => $data['notes'],
        ]);

        // Update invoice items
        $invoice->items()->delete();
        foreach ($data['items'] as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
            ]);
        }

        return redirect()->route('invoices.show', $invoice)->with('status', 'Invoice updated successfully');
    }

    public function destroy(Invoice $invoice): RedirectResponse
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('status', 'Invoice deleted successfully');
    }
}
