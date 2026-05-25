{{-- <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Customers</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    </head>
    <body> --}}
        @extends('layouts.layout')
        @section('content')
        <h1>Customers List</h1>
        <a href="{{ route('customer.create') }}" class="btn btn-info">Add Customer</a>
        <table class="table" type="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Remarks</th>
                    {{-- <th>Debit</th>
                    <th>Credit</th> --}}
                    <th>Balance</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        @php
                            $balance=$customer->ledger->sum('credit') - $customer->ledger->sum('debit')
                        @endphp
                        <td><a href="{{ route('customer.show',$customer->id) }}">{{ $customer->name }}</a></td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->remarks }}</td>
                        {{-- <td>{{ $customer->debit }}</td>
                        <td>{{ $customer->credit }}</td> --}}
                        <td>{{ $balance }}</td>
                        <td>
                            <!-- Add action buttons for edit and delete -->
                            <a href="{{ route('customer.show',$customer->id) }}"
                                class="btn btn-primary">Open
                             </a>
                            <a href="{{ route('customer.edit',$customer->id)}}" class="btn btn-info">Edit</a>
                            <form action="{{ route('customer.destroy',$customer->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endsection
{{-- </body>
</html>  --}}

