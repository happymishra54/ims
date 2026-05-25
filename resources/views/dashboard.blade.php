@extends('layouts.layout')

@section('content')

<style>

    .stat-card{
        border-radius:20px;
        padding:25px;
        color:white;
        position:relative;
        overflow:hidden;
        transition:0.3s;
    }

    .stat-card:hover{
        transform:translateY(-5px);
    }

    .stat-card i{
        position:absolute;
        right:20px;
        bottom:20px;
        font-size:50px;
        opacity:0.2;
    }

    .blue{
        background:linear-gradient(
            135deg,
            #3b82f6,
            #2563eb
        );
    }

    .green{
        background:linear-gradient(
            135deg,
            #10b981,
            #059669
        );
    }

    .orange{
        background:linear-gradient(
            135deg,
            #f59e0b,
            #d97706
        );
    }

    .red{
        background:linear-gradient(
            135deg,
            #ef4444,
            #dc2626
        );
    }

    .table-card{
        background:white;
        border-radius:20px;
        padding:20px;
        margin-top:30px;
        box-shadow:0 5px 20px rgba(0,0,0,0.05);
    }

    .table thead{
        background:#111827;
        color:white;
    }

    .badge-stock{
        padding:8px 12px;
        border-radius:20px;
        font-size:12px;
    }

    .in-stock{
        background:#d1fae5;
        color:#065f46;
    }

    .low-stock{
        background:#fef3c7;
        color:#92400e;
    }

</style>

<!-- Cards -->
<div class="row g-4">

    <div class="col-md-3">

        <div class="stat-card blue">

            <h3>{{ $productCount }}</h3>

            <p>Total Products</p>

            <i class="fas fa-box"></i>

        </div>

    </div>

    <div class="col-md-3">

        <div class="stat-card green">

            <h3>{{ $customerCount }}</h3>

            <p>Total Customers</p>

            <i class="fas fa-users"></i>

        </div>

    </div>

    <div class="col-md-3">

        <div class="stat-card orange">

            <h3>{{ $balanceCount }}</h3>

            <p>You will get</p>

            <i class="fas fa-exclamation-triangle"></i>

        </div>

    </div>

    <div class="col-md-3">

        <div class="stat-card red">

            <h3>{{ $outstandingCount }}</h3>

            <p>you will give</p>

            <i class="fas fa-rupee-sign"></i>

        </div>

    </div>

</div>

<!-- Product Table -->
<div class="table-card">

    <div class="d-flex
                justify-content-between
                align-items-center
                mb-3">

        <h4>
            Recent Products
        </h4>

        <a href="{{ route('product.index') }}"
           class="btn btn-primary">

            View Products

        </a>

    </div>

    <table class="table table-hover align-middle">

        <thead>

            <tr>

                <th>ID</th>

                <th>Product</th>

                <th>Quantity</th>

                <th>Bought Price</th>

                <th>Selling Price</th>

                <th>Status</th>

            </tr>

        </thead>

        <tbody>
            @foreach ($products as $product) 
            <tr>
                
                <td>{{ $product->id }}</td>
                
                <td>{{ $product->name }}</td>
                
                <td>{{ $product->quantity }}</td>
                
                <td>₹ {{ $product->bought_price }}</td>
                
                <td>₹ {{ $product->selling_price }}</td>
                
                <td>
                    @if ($product->quantity < 10)
                        <span class="badge-stock low-stock">
                            Low Stock
                        </span>
                    @else
                        <span class="badge-stock in-stock">
                            In Stock
                        </span>
                    @endif
                </td>
            @endforeach

            </tr>

            

        </tbody>

    </table>

</div>

@endsection