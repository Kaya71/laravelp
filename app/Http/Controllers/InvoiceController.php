<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    // List invoices with pagination and optional search functionality
    public function index(Request $request)
    {
        $query = Invoice::with('lineItems');

        if ($request->has('search')) {
            $query->where('customer_name', 'like', "%{$request->search}%")
                ->orWhere('invoice_number', 'like', "%{$request->search}%");
        }

        $invoices = $query->paginate(10);

        return view('invoices.index', compact('invoices'));
    }

    // Show the form for creating a new invoice
    public function create()
    {
        return view('invoices.create');
    }

    // Store a newly created invoice in the database
    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'invoice_number' => 'required',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'client_name' => 'required',
            'client_email' => 'required|email',
            'line_items.*.description' => 'required',
            'line_items.*.quantity' => 'required|numeric|min:1',
            'line_items.*.unit_price' => 'required|numeric|min:0',
        ]);

        // Create the invoice
        $invoice = Invoice::create($request->only(['invoice_number', 'invoice_date', 'due_date', 'client_name', 'client_email']));

        // Add line items
        foreach ($request->line_items as $item) {
            $invoice->lineItems()->create($item);
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully');
    }

    // Show the form for editing an existing invoice
    public function edit(Invoice $invoice)
    {
        return view('invoices.edit', compact('invoice'));
    }

    // Update the specified invoice in the database
    public function update(Request $request, Invoice $invoice)
    {
        // Validate input data
        $request->validate([
            'invoice_number' => 'required',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'client_name' => 'required',
            'client_email' => 'required|email',
            'line_items.*.description' => 'required',
            'line_items.*.quantity' => 'required|numeric|min:1',
            'line_items.*.unit_price' => 'required|numeric|min:0',
        ]);

        // Update the invoice details
        $invoice->update($request->only(['invoice_number', 'invoice_date', 'due_date', 'client_name', 'client_email']));

        // Remove old line items and add new ones
        $invoice->lineItems()->delete();
        foreach ($request->line_items as $item) {
            $invoice->lineItems()->create($item);
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully');
    }

    // Remove the specified invoice from the database
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully');
    }
}
