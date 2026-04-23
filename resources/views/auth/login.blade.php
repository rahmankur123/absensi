<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - BD Camp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0ea5e9, #6366f1);
            height: 100vh;
        }

        .login-card {
            border-radius: 15px;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #0ea5e9;
        }
    </style>
</head>

<body>

<div class="container h-100">
    <div class="row justify-content-center align-items-center h-100">

        <div class="col-md-4">

            <div class="card shadow-lg login-card">
                <div class="card-body p-4">

                    {{-- LOGO --}}
                    <div class="text-center mb-3">
                        <div class="logo">🏋️ BD Camp</div>
                        <small class="text-muted">Sistem Monitoring Atlet</small>
                    </div>

                    <h5 class="text-center mb-3">Login</h5>

                    {{-- ERROR --}}
                    @if(session('error'))
                        <div class="alert alert-danger text-center">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- FORM --}}
                    <form method="POST" action="/login">
                        @csrf

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" 
                                   class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" 
                                   class="form-control" required>
                        </div>

                        <button class="btn btn-primary w-100">
                            Masuk
                        </button>
                    </form>

                </div>
            </div>

            {{-- FOOTER --}}
            <div class="text-center mt-3 text-white">
                <small>© {{ date('Y') }} BD Camp</small>
            </div>

        </div>

    </div>
</div>

</body>
</html>