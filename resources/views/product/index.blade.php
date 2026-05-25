    @extends('layouts.layout')
    @section('content')
    <table class="table" type="table">
        <h1>Products List</h1>
        <a class="btn btn-info" href="{{ route('product.create') }}">Add Product</a>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Remarks</th>
                <th>Bought Price</th>
                <th>Margin(%)</th>
                <th>Selling Price</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
@foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->remarks }}</td>
                    <td>{{ $product->bought_price }}</td>
                    <td>
                        <form action="{{ route('product.updateMargin', $product->id) }}" method="POST" style="display:flex; gap:8px; align-items:center;" class="margin-form" data-product-id="{{ $product->id }}">
                            @csrf
                            <input
                                class="margin-input"
                                type="number"
                                name="margin"
                                value="{{ $product->margin }}"
                                min="0"
                                step="0.01"
                                style="width:110px;"
                            />
                        </form>
                    </td>
                    <td>{{ number_format((float)$product->selling_price, 2, '.', '') }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->unit }}</td>
                    <td>
                        <a href="{{ route('product.edit',$product->id)}}" class="btn btn-info">Edit</a>
                        <form action="{{ route('product.destroy',$product->id) }}" method="POST" style="display:inline-block;">
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
</html> --}}

<script>
    // Auto-submit margin update on input change (instant update)
    document.querySelectorAll('form.margin-form').forEach((form) => {
        const input = form.querySelector('input.margin-input');
        if (!input) return;

        let timeout = null;
        input.addEventListener('input', () => {
            // debounce a bit to avoid submitting on every keystroke character
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                form.requestSubmit();
            }, 0);
        });
    });
</script>



