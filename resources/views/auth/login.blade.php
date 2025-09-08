<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediTrack - Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8f4f0 0%, #e8ddd4 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(184, 86, 59, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            position: relative;
        }

        .login-header {
            background: linear-gradient(135deg, #b8563b 0%, #a04d35 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
            position: relative;
        }

        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .logo svg {
            width: 50px;
            height: 50px;
            fill: white;
        }

        .login-header h1 {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .login-header p {
            font-size: 14px;
            opacity: 0.9;
            font-weight: 300;
        }

        .login-form {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e5e5e5;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-group input:focus {
            outline: none;
            border-color: #b8563b;
            background: white;
            box-shadow: 0 0 0 3px rgba(184, 86, 59, 0.1);
        }

        .form-group input::placeholder {
            color: #999;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #b8563b 0%, #a04d35 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(184, 86, 59, 0.3);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .forgot-password {
            text-align: center;
            margin-top: 20px;
        }

        .forgot-password a {
            color: #b8563b;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: opacity 0.3s ease;
        }

        .forgot-password a:hover {
            opacity: 0.8;
        }

        .divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
            color: #666;
            font-size: 14px;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e5e5;
            z-index: 1;
        }

        .divider span {
            background: white;
            padding: 0 20px;
            position: relative;
            z-index: 2;
        }

        .signup-link {
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        .signup-link a {
            color: #b8563b;
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            background: #fee;
            color: #c33;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border: 1px solid #fcc;
        }

        .success-message {
            background: #efe;
            color: #363;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border: 1px solid #cfc;
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 0;
                border-radius: 0;
                min-height: 100vh;
            }
            
            .login-header, .login-form {
                padding: 30px 20px;
            }
        }

        /* Floating animation for the logo */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .logo {
            animation: float 3s ease-in-out infinite;
        }

        /* Ripple effect for button */
        .login-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .login-btn:active::after {
            width: 300px;
            height: 300px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="logo">
                <svg viewBox="0 0 500 500">
                    <!-- Clipboard -->
                    <rect x="90" y="40" width="320" height="420" rx="20" fill="none" stroke="currentColor" stroke-width="15"/>
                    <rect x="110" y="60" width="280" height="380" rx="10" fill="none" stroke="currentColor" stroke-width="8"/>
                    
                    <!-- Clipboard header -->
                    <rect x="180" y="20" width="140" height="60" rx="15" fill="none" stroke="currentColor" stroke-width="12"/>
                    <rect x="200" y="70" width="100" height="40" rx="8" fill="none" stroke="currentColor" stroke-width="8"/>
                    
                    <!-- Medical cross -->
                    <rect x="150" y="140" width="50" height="15" rx="5" fill="currentColor"/>
                    <rect x="167.5" y="125" width="15" height="50" rx="5" fill="currentColor"/>
                    
                    <!-- Lines representing text -->
                    <rect x="270" y="145" width="80" height="8" rx="4" fill="currentColor"/>
                    <rect x="270" y="165" width="60" height="8" rx="4" fill="currentColor"/>
                    
                    <!-- Table/form lines -->
                    <rect x="150" y="220" width="200" height="140" rx="8" fill="none" stroke="currentColor" stroke-width="8"/>
                    <line x1="230" y1="220" x2="230" y2="360" stroke="currentColor" stroke-width="6"/>
                    <line x1="150" y1="250" x2="350" y2="250" stroke="currentColor" stroke-width="6"/>
                    <line x1="150" y1="280" x2="350" y2="280" stroke="currentColor" stroke-width="6"/>
                    <line x1="150" y1="310" x2="350" y2="310" stroke="currentColor" stroke-width="6"/>
                    <line x1="150" y1="340" x2="350" y2="340" stroke="currentColor" stroke-width="6"/>
                    
                    <!-- Pen -->
                    <g transform="translate(380, 40) rotate(15)">
                        <rect x="0" y="0" width="20" height="80" rx="10" fill="currentColor"/>
                        <rect x="2" y="5" width="16" height="15" rx="3" fill="none" stroke="white" stroke-width="2"/>
                        <rect x="2" y="25" width="16" height="15" rx="3" fill="none" stroke="white" stroke-width="2"/>
                        <polygon points="10,80 5,95 15,95" fill="currentColor"/>
                    </g>
                </svg>
            </div>
            <h1>MEDITRACK</h1>
            <p>Secure Medical Records Management</p>
        </div>
        
        <form class="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            
            <!-- Session Status -->
            @if (session('status'))
                <div class="success-message">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="error-message">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            
            <button type="submit" class="login-btn">
                Sign In
            </button>
            
            <div class="forgot-password">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot your password?</a>
                @endif
            </div>
            
            <div class="divider">
                <span>or</span>
            </div>
            
            <div class="signup-link">
                Don't have an account? <a href="{{ route('register') }}">Sign up here</a>
            </div>
        </form>
    </div>

    <script>
        // Add some interactive effects
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>
