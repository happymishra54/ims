@extends('layouts.layout')
@section('content')
<form action="{{ route('supplier.update',$supplier->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ $supplier->name }}"><br><br>

    <label for="phone">Phone:</label>
    <input type="tel" id="phone" name="phone" value="{{ $supplier->phone }}"><br><br>

    <label for="remarks">Remarks:</label>
    <input type="text" id="remarks" name="remarks" value="{{ $supplier->remarks }}"><br><br>

    {{-- <label for="debit">Debit:</label>
    <input type="number" id="debit" name="debit"  value="{{ $supplier->debit }}"><br><br>

    <label for="credit">Credit:</label>
    <input type="number" id="credit" name="credit" value="{{ $supplier->credit }}"><br><br>

    <label for="balance">Balance:</label>
    <input type="number" id="balance" name="balance" readonly value="{{ $supplier->balance }}"><br><br> --}}

    <input type="submit" value="Update">
    <input type="reset" value="Reset">
</form>

@endsection