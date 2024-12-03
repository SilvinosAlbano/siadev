<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/bootstrap.min.css">   
   <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">
   <title>Login || SIA ICS</title>
</head>

<style>
    body, html {
        height: 100%;
        margin: 0;
        font-family: Arial, sans-serif;
        background: linear-gradient(120deg, #ffffff 0%, #eeeeee 100%);
    }

    .login-container {
        display: flex;
        height: 100vh;
    }

    /* Left Section (Image & Welcome Text) */
    .login-image-section {
        width: 50%;
        background-color: #f8f9fa;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 50px;
        text-align: center;
    }

    .login-image-section h1 {
        font-size: 24px;
        font-weight: bold;
        color: #343a40;
        margin-bottom: 10px;
    }

    .login-image-section p {
        font-size: 16px;
        color: #6c757d;
        margin-bottom: 30px;
    }

    .login-illustration {
        max-width: 70%;
        height: auto;
    }

    /* Right Section (Login Form) */
    .login-form-section {
        width: 50%;
        background-color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-box {
        width: 100%;
        max-width: 500px;
        padding: 90px;
        border-radius: 8px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .item-logo img {
        width: 80px;
        margin-bottom: 20px;
    }

    .login-form .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        height: 45px;
        border-radius: 5px;
    }

    .login-btn {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        background-color: #007bff;
        border: none;
        color: #fff;
        transition: background-color 0.3s ease;
    }

    .login-btn:hover {
        background-color: #0056b3;
    }

    .text-center a {
        color: #007bff;
        text-decoration: none;
        font-size: 0.9rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .login-image-section {
            display: none;
        }

        .login-form-section {
            width: 100%;
        }
    }
</style>

<body>
    <div class="login-container">
        <!-- Left Section (Image & Welcome Text) -->
        <div class="login-image-section shadow">
            <h1>Bem-vindo ao SIA-ICS!</h1>
            <p>Sistema de Informação Acadêmica do Instituto de Ciência de Saúde</p>
            <img src="img/logo2.png" alt="Login Illustration" class="login-illustration" width="50%">
        </div>

        <!-- Right Section (Login Form) -->
        <div class="login-form-section shadow">
            <div class="login-box shadow">
                <div class="item-logo">
                    <!-- <img src="img/logo1.png" alt="ICS Logo"> -->
                     
                </div>
                <h2 class="text-center mb-4" style="font-family:Verdana, Geneva, Tahoma, sans-serif">Login SIA</h2>
                <form action="{{ route('auth.login') }}" method="POST">
                    @csrf
                    <!-- Username -->
                    <div class="form-group mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" placeholder="ID User" class="form-control @error('username') is-invalid @enderror"
                            id="username" name="username" value="{{ old('username') }}" required autofocus>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-4">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                    <!-- Submit Button -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="login-btn">Login</button>
                    </div>

                    <!-- Forgot Password -->
                    <div class="text-center">
                        <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
