<div class="form-group">
    <label for="invoice_number">Invoice Number</label>
    <input type="text" name="invoice_number" class="form-control" value="{{ old('invoice_number', $invoice->invoice_number ?? '') }}">
</div>

<div class="form-group">
    <label for="date">Date</label>
    <input type="date" name="date" class="form-control" value="{{ old('date', $invoice->date ?? '') }}">
</div>

<div class="form-group">
    <label for="customer_name">Customer Name</label>
    <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name', $invoice->customer_name ?? '') }}">
</div>

<div class="form-group">
    <label for="customer_email">Customer Email</label>
    <input type="email" name="customer_email" class="form-control" value="{{ old('customer_email', $invoice->customer_email ?? '') }}">
</div>

<!-- Line Items -->
<h3>Line Items</h3>
<div id="line-items">
    @foreach(old('line_items', $invoice->lineItems ?? []) as $key => $line_item)
        @include('invoices.line_item', ['index' => $key, 'line_item' => $line_item])
    @endforeach
</div>

<button type="button" class="btn btn-success" onclick="addLineItem()">Add Line Item</button>

<script>
    function addLineItem() {
        const index = document.querySelectorAll('.line-item').length;
        const lineItemHtml = `
        @include('invoices.line_item', ['index' => '${index}', 'line_item' => null])
        `;
        document.getElementById('line-items').insertAdjacentHTML('beforeend', lineItemHtml);
    }
</script>
