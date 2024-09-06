@extends('layouts.app')

@section('content')
    <h1>Invoices</h1>
    <a href="{{ route('invoices.create') }}" class="btn btn-primary">Create Invoice</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Invoice Number</th>
            <th>Date</th>
            <th>Customer Name</th>
            <th>Total Amount</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <form method="GET" action="{{ route('invoices.index') }}">
            <input type="text" name="search" placeholder="Search invoices" value="{{ request('search') }}">
            <button type="submit">Search</button>
        </form>
        @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->invoice_number }}</td>
                <td>{{ $invoice->date }}</td>
                <td>{{ $invoice->customer_name }}</td>
                <td>{{ $invoice->total_amount }}</td>
                <td>
                    <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-info">Edit</a>
                    <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $invoices->links() }}
@endsection
