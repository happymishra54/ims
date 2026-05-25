@extends('layouts.layout')
@section('content')
    <form action="{{ route('customer.update',$customer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $customer->name }}"><br><br>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" value="{{ $customer->phone }}"><br><br>

        <label for="remarks">Remarks:</label>
        <input type="text" id="remarks" name="remarks" value="{{ $customer->remarks }}"><br><br>

        {{-- <label for="debit">Debit:</label>
        <input type="number" id="debit" name="debit"  value="{{ $customer->debit }}"><br><br>

        <label for="credit">Credit:</label>
        <input type="number" id="credit" name="credit" value="{{ $customer->credit }}"><br><br>

        <label for="balance">Balance:</label>
        <input type="number" id="balance" name="balance" readonly value="{{ $customer->balance }}"><br><br> --}}

        <input type="submit" value="Update">
        <input type="reset" value="Reset">
    </form>
@endsection
