<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>IMS</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            background:#f4f7fe;
        }

        .sidebar{
            position:fixed;
            width:260px;
            height:100vh;
            background:linear-gradient(
                180deg,
                #111827,
                #1f2937
            );
            padding-top:20px;
            color:white;
        }

        .logo{
            text-align:center;
            font-size:28px;
            font-weight:700;
            margin-bottom:30px;
            color:#60a5fa;
        }

        .sidebar a{
            display:flex;
            align-items:center;
            gap:15px;
            color:#d1d5db;
            text-decoration:none;
            padding:15px 25px;
            transition:0.3s;
            font-size:16px;
        }

        .sidebar a:hover{
            background:#374151;
            color:white;
            border-left:5px solid #60a5fa;
        }

        .main-content{
            margin-left:260px;
            padding:25px;
        }

        .topbar{
            background:white;
            border-radius:15px;
            padding:18px 25px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 5px 20px rgba(0,0,0,0.05);
            margin-bottom:25px;
        }

        .search-box{
            width:300px;
        }

        .search-box input{
            border-radius:10px;
        }

        .dashboard-title{
            font-size:28px;
            font-weight:600;
            color:#111827;
        }

        .profile{
            display:flex;
            align-items:center;
            gap:10px;
        }

        .profile img{
            width:45px;
            height:45px;
            border-radius:50%;
        }

    </style>

</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">

        <div class="logo">
            IMS
        </div>

        <a href="{{ route('view.dashboard') }}">
            <i class="fas fa-home"></i>
            Dashboard
        </a>

        <a href="{{ route('product.index') }}">
            <i class="fas fa-box"></i>
            Products
        </a>

        <a href="{{ route('customer.index') }}">
            <i class="fas fa-users"></i>
            Customers
        </a>

        <a href="{{ route('supplier.index') }}">
            <i class="fas fa-truck"></i>
            Suppliers
        </a>

        <a href="#">
            <i class="fas fa-shopping-cart"></i>
            Purchases
        </a>

        <a href="#">
            <i class="fas fa-chart-line"></i>
            Reports
        </a>

        <a href="#">
            <i class="fas fa-cog"></i>
            Settings
        </a>

    </div>

    <!-- Main Content -->
    <div class="main-content">

        <!-- Topbar -->
        <div class="topbar">

            <div>

                <div class="dashboard-title">
                    Inventory Management System
                </div>

                <small class="text-muted">
                    Welcome back, {{ session('user_name') }} 👋
                </small>

            </div>

            <div class="d-flex align-items-center gap-4">

                <div class="search-box">

                    <input type="text"
                           class="form-control"
                           placeholder="Search...">

                </div>

                <div class="profile">

                    <img src="https://i.pravatar.cc/100"
                         alt="profile">

                    <div>

                        <strong>
                            {{ session('user_name') }}
                        </strong>

                        <br>

                        {{-- <small class="text-muted">
                            Super Admin
                        </small> --}}
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                        
                            <button
                                type="submit"
                                class="btn btn-danger">
                                Logout
                            </button>
                        </form>

                    </div>

                </div>

            </div>

        </div>

        {{-- Dynamic Page Content --}}
        @yield('content')

    </div>

</body>
</html>