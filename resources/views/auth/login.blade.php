<x-guest-layout>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color:rgb(224, 176, 204);
            margin: 0;
            padding: 0;
        }

        .login-header {
            background-color:rgb(238, 157, 220);
            color: white;
            padding: 30px 40px;
            text-align: center;
            font-size: 26px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .login-container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgb(226, 132, 214);
        }

        label {
            display: block;
            font-weight: 600;
            margin-top: 20px;
            margin-bottom: 5px;
            color:rgb(138, 174, 231);
        }

        input   [type="email"],
        input[type="password"] {
            width: 100%;
            padding: 15px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background-color: #f9fafb;
            font-size: 15px;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-top: 4px;
        }

        .remember {
            margin-top: 20px;
            display: flex;
            align-items: center;
        }

        .remember label {
            font-weight: normal;
            margin-left: 8px;
            font-size: 14px;
            color:rgb(201, 96, 166);
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .actions a {
            font-size: 14px;
            color:white;
            text-decoration: none;
        }

        .actions a:hover {
            color:rgb(236, 112, 189);
            text-decoration: underline;
        }

        .button-group {
            display: flex;
            gap: 10px;
        }

        .primary-button,
        .register-button {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            transition: background-color 0.3s, transform 0.2s;
        }

        .primary-button {
            background-color:rgb(223, 47, 155);
            color:white;
        }

        .primary-button:hover {
            background-color:rgb(223, 47, 155);
            transform: translateY(-2px);
        }

        .register-button {
            background-color:rgb(223, 47, 155);
            color: white;
        }

        .register-button:hover {
            background-color:#1d4ed8;
            transform: translateY(-2px);
        }

        .status-message {
            background-color: #d1fae5;
            border: 1px solid #10b981;
            color: #065f46;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>

    <div class="login-header">
        Ashlley's Booking Login Portal
    </div>

    <div class="login-container">

        <!-- Session Status -->
        @if (session('status'))
            <div class="status-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <!-- Password -->
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <!-- Remember Me -->
            <div class="remember">
                <input type="checkbox" id="remember_me" name="remember">
                <label for="remember_me">Remember Me</label>
            </div>

            <div class="actions">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot your password?</a>
                @endif

                <div class="button-group">
                    <button type="submit" class="primary-button">Log in</button>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="register-button">Register</a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
