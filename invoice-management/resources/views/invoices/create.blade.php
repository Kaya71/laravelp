<form method="POST" action="{{ route('invoices.store') }}">
    @csrf
    <input type="text" name="invoice_number" placeholder="Invoice Number" required>
    <input type="text" name="customer_name" placeholder="Customer Name" required>
    <input type="email" name="customer_email" placeholder="Customer Email" required>
    <input type="date" name="date" required>
    <input type="text" name="total_amount" placeholder="Total Amount" required>

    <h4>Line Items</h4>
    <div id="line-items">
        <input type="text" name="line_items[0][description]" placeholder="Description" required>
        <input type="number" name="line_items[0][quantity]" placeholder="Quantity" required>
        <input type="number" name="line_items[0][unit_price]" placeholder="Unit Price" required>
    </div>
    <button type="submit">Save</button>
</form>
