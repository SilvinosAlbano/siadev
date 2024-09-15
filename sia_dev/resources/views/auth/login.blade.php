<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<style>
    body {
        background: linear-gradient(120deg, #ffffff 0%, #eeeeee 100%);
        /* Or use a background image */
        /* background: url('public/img/logo1.png') no-repeat center center fixed; */
        background-size: cover;
        /* C:\Users\ALFON\Desktop\siadev\siadev\sia_dev\public\img\logo1.png */
    }

    .card {
        border: none;
        border-radius: 10px;
    }

    .card-body {
        padding: 2rem;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row w-100">
            <div class="col-md-6 mx-auto">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <div class="item-logo d-flex justify-content-center mb-4">
                            <img src="img/logo1.png" alt="ics_logo" width="15%" class="align-center">
                        </div>
                        <h2 class="text-center mb-4">Bem-vindo ao SIA-ICS</h2>
                        <form method="POST" action="{{ route('auth.login') }}">
                            @csrf
                            <!-- Username -->
                            <div class="form-group mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" value="{{ old('username') }}" required autofocus>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="form-check mb-4">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">Login</button>
                            </div>

                            <!-- Forgot Password -->
                            <div class="text-center">
                                <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot Your
                                    Password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
