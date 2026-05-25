@extends('layouts.layout')
@section('content')
    <a class="btn btn-primary" href="{{ route('product.index') }}">View Products</a>
    <form action="{{ route('product.update',$product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $product->name }}"><br><br>

            <label for="remarks">Remarks:</label>
            <input type="text" id="remarks" name="remarks" value="{{ $product->remarks }}"><br><br>

            <label for="bought_price">Bought Price:</label>
            <input type="number" id="bought_price" name="bought_price" value="{{ $product->bought_price }}"><br><br>

            <label for="margin">Margin (%):</label>
            <input type="number" id="margin" name="margin" placeholder="Enter margin in percentage" value="{{ $product->margin ?? 10 }}" min="0" step="0.01"><br><br>

            <label for="selling_price">Selling Price:</label>
            <input type="number" id="selling_price" name="selling_price" value="{{ $product->selling_price }}" readonly><br><br>


            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="{{ $product->quantity }}"><br><br>

            <label for="unit">Unit:</label>
            <input type="text" id="unit" name="unit" value="{{ $product->unit }}"><br><br>
            <input type="submit" value="Update">
            <input type="reset" value="Reset">
            {{-- <a class="btn btn-secondary" href="{{ route('product.index') }}">Cancel</a> --}}
    </form>    
@endsection

<script>

    const boughtPrice = document.getElementById('bought_price');
    const margin = document.getElementById('margin');
    const sellingPrice = document.getElementById('selling_price');

    function calculateSellingPrice() {
        const bought = parseFloat(boughtPrice.value) || 0;
        const marginPercent = parseFloat(margin.value) || 0;
        const result = bought + (bought * marginPercent / 100);
        sellingPrice.value = result.toFixed(2);
    }

    calculateSellingPrice();
    boughtPrice.addEventListener('input', calculateSellingPrice);
    margin.addEventListener('input', calculateSellingPrice);
    </script>
