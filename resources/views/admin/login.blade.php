<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
        }

        .login-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .login-card .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 2.5rem 2rem 1.5rem;
            text-align: center;
        }

        .login-card .card-body {
            padding: 2rem;
        }

        .login-icon {
            color: #4e73df;
            margin-bottom: 1rem;
            display: block;
        }

        .login-title {
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .login-subtitle {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .input-group {
            border-radius: 10px;
            overflow: hidden;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-right: none;
            padding: 0.75rem 1rem;
            color: #6c757d;
        }

        .form-control {
            border: 1px solid #ced4da;
            border-left: none;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
            border-color: #4e73df;
        }

        .form-control:focus+.input-group-text {
            border-color: #4e73df;
        }

        .alert-danger {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            border: none;
            background-color: #f8d7da;
            color: #721c24;
            margin-bottom: 1.5rem;
        }

        .alert-danger i {
            margin-right: 0.5rem;
        }

        .btn-login {
            background: linear-gradient(135deg, #4e73df, #5a8dee);
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .back-link {
            color: #6c757d;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-link:hover {
            color: #4e73df;
        }

        .card-footer-text {
            text-align: center;
            padding-top: 1.5rem;
            margin-top: 1.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="card login-card">
            <div class="card-header">
                <i class="fas fa-user-shield fa-3x login-icon"></i>
                <h4 class="login-title">Login Admin</h4>
                <p class="login-subtitle">Silakan masuk untuk melanjutkan</p>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-triangle-exclamation"></i>
                        Email atau Password salah
                    </div>
                @endif

                <form method="POST" action="/login">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" name="email" class="form-control" placeholder="admin@email.com"
                                required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                    </div>

                    <a href="{{ url('/dashboard') }}" class="btn btn-primary w-100 btn-login" type="submit">
                        Login
                    </a>
                </form>

                <div class="card-footer-text">
                    <a href="/" class="back-link">
                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
