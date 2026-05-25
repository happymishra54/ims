@extends('layouts.layout')
@section('content')
    <div class="container mt-4">
        <h1>Suppliers</h1>
        <a href="{{ route('supplier.create') }}" class="btn btn-primary mb-3">Add Supplier</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    {{-- <th>Debit</th>
                    <th>Credit</th> --}}
                    <th>Balance</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->phone }}</td>
                    {{-- <td>{{ $supplier->debit }}</td>
                    <td>{{ $supplier->credit }}</td> --}}
                    @php
                        $supplierLedgers = \App\Models\Ledger::where('supplier_id', $supplier->id);
                        $balance = $supplierLedgers->sum('debit') - $supplierLedgers->sum('credit');
                    @endphp
                    <td>{{ $balance }}</td>
                    <td>
                        <a href="{{ route('supplier.show', $supplier->id) }}" class="btn btn-sm btn-info">Ledger</a>
                        <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection