{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
</head>
<body> --}}
@extends('layouts.layout')
    @section('content')
        <a href="{{ route('product.index') }}">View Products</a>

        <form action="{{ route('product.store') }}" method="POST">
            @csrf
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="enter name"><br><br>

            <label for="name">Remarks:</label>
            <input type="text" id="remarks" name="remarks" placeholder="enter remarks"><br><br>

            <label for="bought_price">Bought Price:</label>
            <input type="number" id="bought_price" name="bought_price" placeholder="Enter bought price"><br><br>

            <label for="margin">Margin (%):</label>
            <input type="number" id="margin" name="margin" placeholder="Enter margin in percentage" value="10" min="0" step="0.01">

            <label for="selling_price">Selling Price:</label>
            <input type="number" id="selling_price" name="selling_price" readonly><br><br>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" placeholder="Enter quantity"><br><br>

            <label for="unit">Unit:</label>
            <input type="text" id="unit" name="unit" placeholder="Enter unit"><br><br>

            <input type="submit" value="Add Product">
            <input type="reset" value="Reset">
        </form>
        {{-- </body>
        </html> --}}
        
        
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
    @endsection