<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:linear-gradient(
                135deg,
                #1e3a8a,
                #2563eb
            );
            font-family:sans-serif;
        }

        .login-box{
            width:400px;
            background:white;
            padding:40px;
            border-radius:20px;
            box-shadow:0 10px 30px rgba(0,0,0,0.2);
        }

        .login-box h2{
            text-align:center;
            margin-bottom:30px;
            font-weight:bold;
        }

        .input-group{
            position:relative;
            margin-bottom:20px;
        }

        .input-group i{
            position:absolute;
            left:15px;
            top:15px;
            color:gray;
        }

        .form-control{
            padding-left:45px;
            height:50px;
            border-radius:12px;
        }

        .btn-login{
            width:100%;
            height:50px;
            border:none;
            border-radius:12px;
            background:#2563eb;
            color:white;
            font-weight:bold;
            transition:0.3s;
        }

        .btn-login:hover{
            background:#1d4ed8;
        }

        .bottom-text{
            text-align:center;
            margin-top:20px;
        }

        .bottom-text a{
            text-decoration:none;
            font-weight:bold;
        }

    </style>

</head>

<body>

    <div class="login-box">

        <h2>
            IMS Login
        </h2>

        @if(session('error'))

            <div class="alert alert-danger">

                {{ session('error') }}

            </div>

        @endif

        <form method="POST"
              action="/login">

            @csrf

            <div class="input-group">

                <i class="fas fa-envelope"></i>

                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="Enter Email">

            </div>

            <div class="input-group">

                <i class="fas fa-lock"></i>

                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Enter Password">

            </div>

            <button type="submit"
                    class="btn-login">

                Login

            </button>

        </form>

        <div class="bottom-text">

            Don't have an account?

            <a href="{{ route('signup') }}">
                Signup
            </a>

        </div>

    </div>

</body>

</html>