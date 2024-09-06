<div class="form-group line-item">
    <label for="line_items[{{ $index }}][description]">Description</label>
    <input type="text" name="line_items[{{ $index }}][description]" class="form-control" value="{{ old("line_items.$index.description", $line_item->description ?? '') }}">
    <label for="line_items[{{ $index }}][quantity]">Quantity</label>
    <input type="number" name="line_items[{{ $index }}][quantity]" class="form-control" value="{{ old("line_items.$index.quantity", $line_item->quantity ?? 1) }}">
    <label for="line_items[{{ $index }}][unit_price]">Unit Price</label>
    <input type="text" name="line_items[{{ $index }}][unit_price]" class="form-control" value="{{ old("line_items.$index.unit_price", $line_item->unit_price ?? '') }}">
</div>
