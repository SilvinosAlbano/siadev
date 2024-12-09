<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Login || SIA ICS</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Roboto', Arial, sans-serif;
            background: linear-gradient(135deg, #008000, #FFFF00);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .login-logo img {
            width: 100px;
            margin-bottom: 20px;
        }

        .login-box h2 {
            font-size: 24px;
            font-weight: 700;
            color: #008000;
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }

        .form-control {
            height: 45px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            background-color: #008000;
            border: none;
            color: #fff;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .login-btn:hover {
            background-color: #006600;
            transform: scale(1.02);
        }

        .text-center a {
            color: #008000;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        footer {
            margin-top: 20px;
            font-size: 12px;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <!-- Logo -->
        <div class="login-logo">
            <img src="img/logo2.png" alt="ICS Logo">
        </div>
        <!-- Heading -->
        <h2>Bem-vindo ao SIA-ICS</h2>
        <!-- Login Form -->
        <form action="{{ route('auth.login') }}" method="POST">
            @csrf
            <!-- Username -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Digite seu username" required>
            </div>
            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Digite sua senha" required>
            </div>
            <!-- Remember Me -->
            <div class="form-check mb-3">
                <input type="checkbox" id="remember" name="remember" class="form-check-input">
                <label for="remember" class="form-check-label">Lembrar de mim</label>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="login-btn">Entrar</button>
        </form>
        <!-- Forgot Password -->
        <div class="text-center mt-3">
            <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
        </div>
        <!-- Footer -->
        <footer class="text-center">
            &copy; {{ date('Y') }} Instituto de Ciência da Saúde, Timor-Leste
        </footer>
    </div>
</body>

</html>
