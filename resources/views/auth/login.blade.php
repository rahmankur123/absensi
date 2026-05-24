<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - BD Camp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body{
            margin:0;
            height:100vh;
            overflow:hidden;
            background:
                radial-gradient(circle at top left, #1e3a8a, transparent 30%),
                radial-gradient(circle at bottom right, #7c3aed, transparent 30%),
                linear-gradient(135deg,#0f172a,#111827);
        }

        .login-wrapper{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:20px;
        }

        .login-card{
            width:100%;
            max-width:420px;

            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(18px);

            border:1px solid rgba(255,255,255,0.12);

            border-radius:28px;

            padding:40px;

            box-shadow:
                0 10px 40px rgba(0,0,0,0.35);
        }

        .logo-img{
            width:75px;
            height:75px;
            object-fit:cover;
            border-radius:20px;

            box-shadow:
                0 10px 25px rgba(14,165,233,0.4);
        }

        .logo-text{
            font-size:30px;
            font-weight:700;
            color:white;
            margin-top:18px;
            letter-spacing:0.5px;
        }

        .subtitle{
            color:rgba(255,255,255,0.7);
            font-size:14px;
        }

        .login-title{
            color:white;
            font-weight:600;
            margin-top:35px;
            margin-bottom:25px;
        }

        .form-label{
            color:rgba(255,255,255,0.8);
            font-size:14px;
            margin-bottom:8px;
        }

        .form-control{
            background: rgba(255,255,255,0.08);
            border:1px solid rgba(255,255,255,0.1);
            height:52px;
            border-radius:14px;
            color:white;
            padding-left:18px;
        }

        .form-control:focus{
            background: rgba(255,255,255,0.12);
            color:white;

            border-color:#38bdf8;

            box-shadow:none;
        }

        .form-control::placeholder{
            color:rgba(255,255,255,0.4);
        }

        .btn-login{
            width:100%;
            height:52px;
            border:none;
            border-radius:14px;

            background: linear-gradient(135deg,#0ea5e9,#6366f1);

            color:white;
            font-weight:600;

            transition:0.3s;
        }

        .btn-login:hover{
            transform:translateY(-2px);

            box-shadow:
                0 10px 25px rgba(99,102,241,0.4);
        }

        .alert{
            border-radius:14px;
        }

        .footer{
            margin-top:25px;
            text-align:center;
            color:rgba(255,255,255,0.6);
            font-size:13px;
        }

    </style>
</head>

<body>

<div class="login-wrapper">

    <div class="login-card">

        <!-- LOGO -->
        <div class="text-center">

            <img src="{{ asset('logo.jpg') }}"
                 class="logo-img"
                 alt="BD Camp">

            <div class="logo-text">
                BD Camp
            </div>

            <div class="subtitle">
                Sistem Monitoring Atlet
            </div>

        </div>

        <!-- TITLE -->
        <h4 class="text-center login-title">
            Welcome Back
        </h4>

        <!-- ERROR -->
        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="/login">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Email
                </label>

                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="Masukkan email"
                       required>

            </div>

            <div class="mb-4">

                <label class="form-label">
                    Password
                </label>

                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Masukkan password"
                       required>

            </div>

            <button class="btn-login">
                Masuk
            </button>

        </form>

        <!-- FOOTER -->
        <div class="footer">
            © {{ date('Y') }} BD Camp
        </div>

    </div>

</div>

</body>
</html>