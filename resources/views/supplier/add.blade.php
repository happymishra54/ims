@extends('layouts.layout')
@section('content')
    <a href="{{ route('supplier.index') }}">View Suppliers</a>
    <form action="{{ route('supplier.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="enter name"><br><br>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter phone"><br><br>

        <label for="remarks">Remarks:</label>
        <input type="text" id="remarks" name="remarks" placeholder="Enter remarks"><br><br>

        {{-- <label for="debit">Debit:</label>
        <input type="number" id="debit" name="debit" placeholder="Enter debit amount if debit"><br><br>

        <label for="credit">Credit:</label>
        <input type="number" id="credit" name="credit" placeholder="Enter credit amount if credit"><br><br>

        <label for="balance">Balance:</label>
        <input type="number" id="balance" name="balance" readonly><br><br> --}}

        <input type="submit" value="Add Supplier">
        <input type="reset" value="Reset">
    </form>
@endsection