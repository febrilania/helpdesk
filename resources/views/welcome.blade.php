<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk - Selamat Datang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e293b, #0f172a);
            color: #e2e8f0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .container {
            background: rgba(30, 41, 59, 0.9);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        .btn-custom {
            width: 150px;
        }
        .logo {
            width: 500px;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
</head>
<body>
    <div class="container">
        <img src="/images/peradaban.png" alt="Logo Universitas" class="logo">
        <h1 class="fw-bold">Selamat Datang di Helpdesk</h1>
        <p class="lead">Solusi cepat dan efisien untuk setiap masalah Anda</p>
        
        @if (Route::has('login'))
            <div class="mt-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-custom">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-custom">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-custom">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</body>
</html>
