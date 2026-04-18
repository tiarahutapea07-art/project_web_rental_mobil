<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rental Mobil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #121b33 0%, #2d3a5a 50%, #1e3a5f 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .login-wrapper {
            width: 100%;
            max-width: 440px;
        }

        .login-card {
            background: #f4f5f7;
            border-radius: 20px;
            padding: 2.5rem 2rem;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .logo-circle {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #cd2121, #c22c11);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.2rem;
        }

        .logo-circle i {
            font-size: 28px;
            color: #fff;
        }

        .login-title {
            font-size: 26px;
            font-weight: 700;
            color: #1a2540;
            margin-bottom: 6px;
        }

        .login-subtitle {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 2rem;
        }

        /* Alert error */
        .alert-error {
            background: #fee2e2;
            border: 1px solid #c53030;
            border-radius: 10px;
            padding: 10px 14px;
            margin-bottom: 1rem;
            text-align: left;
            font-size: 14px;
            color: #991b1b;
        }

        .field-group {
            margin-bottom: 1.2rem;
            text-align: left;
        }

        .field-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #1a2540;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #9ca3af;
            pointer-events: none;
        }

        .input-wrapper input {
            width: 100%;
            padding: 13px 14px 13px 44px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            background: #ffffff;
            font-size: 15px;
            color: #1b3267;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .input-wrapper input:focus {
            border-color: #e84545;
            box-shadow: 0 0 0 3px rgba(232, 69, 69, 0.12);
        }

        .input-wrapper input.is-invalid {
            border-color: #b71616;
        }

        .input-wrapper input.is-invalid + i,
        .input-wrapper input:focus ~ i {
            color: #e84545;
        }

        /* Trick: ikon ikut warna saat input fokus */
        .input-wrapper:focus-within i {
            color: #e84545;
        }

        .invalid-feedback {
            font-size: 12px;
            color: #e84545;
            margin-top: 5px;
            display: block;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background:  #d22a17 0%;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 0.5rem;
            transition: opacity 0.2s, transform 0.1s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-login:hover {
            opacity: 0.92;
        }

        .btn-login:active {
            transform: scale(0.98);
        }

        .copyright {
            text-align: center;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>

    <div class="login-wrapper">
        <div class="login-card">

            <div class="logo-circle">
                <i class="fas fa-car"></i>
            </div>

            <h1 class="login-title">Rental Mobil</h1>
            <p class="login-subtitle">Masuk untuk melanjutkan ke dashboard</p>

            {{-- Alert error dari session --}}
            @if(session('error'))
                <div class="alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="field-group">
                    <label for="username">Username</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="{{ old('username') }}"
                            placeholder="Masukkan username"
                            class="{{ $errors->has('username') ? 'is-invalid' : '' }}"
                            autofocus
                        >
                    </div>
                    @error('username')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                        >
                    </div>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-login">
                    Login <i class="fas fa-sign-in-alt"></i>
                </button>
            </form>

        </div>

        <p class="copyright">Copyright &copy; Amanah Rental {{ date('Y') }}</p>
    </div>

</body>
</html>