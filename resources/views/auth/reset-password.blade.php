<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
     <style>
        @font-face {
            font-family: 'Made Outer Sans';
            src: url('{{ asset('fonts/MADEOuterSans-Regular.otf') }}') format('opentype');
            font-weight: normal;
            font-style: normal;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Made Outer Sans', Arial, sans-serif;
            background-color: #f0f4f7;
            background: url('{{ asset('build/assets/pic2.jpg') }}') no-repeat center center;
            background-size: cover;
            color: #fff; /* Adjust text color for readability */
        }

       .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 500px;
            padding: 10px;
            border-radius: 12px;
            background-color: #27ae60;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .container form input {
            text-align: left;
            width: 90%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: block;
            margin-bottom: 20px;
        }

        .container form button {
            width: 90%;
            margin-bottom: 20px;
            font-size: 18px;
            border-radius: 8px;
            background-color: #fff;
            color: #27ae60;
            border: none;
            cursor: pointer;
            padding: 12px;
        }

        .container form button:hover {
            background-color: #f0f4f7;
        }

        .container a {
            font-size: 16px;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .container a:hover {
            text-decoration: underline;
        }
        .branding-section {
            flex: 1;
            background-color: #27ae60;
            color: #fff;
            padding: 60px; /* Increased padding for better spacing */
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .branding-section h1 {
            font-size: 50px; /* Larger font size */
            margin-bottom: 15px;
            word-wrap: break-word;
        }

        .branding-section p {
            font-size: 20px; /* Larger font size */
            margin-bottom: 15px;
            max-width: 80%;
            text-align: center;
            padding: 50px;
        }

        .branding-section button {
            padding: 14px 20px;
            background-color: #fff;
            color: #27ae60;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px; /* Larger font size */
        }

        .branding-section button:hover {
            background-color: #f0f4f7;
        }

        .form-section {
            flex: 1;
            padding: 200px; /* Increased padding for better spacing */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-section h1 {
            font-size: 28px; /* Larger font size */
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .form-section input {
            margin-bottom: 20px;
            padding: 15px; /* Increased input size */
            font-size: 40px; /* Larger font size */
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 100%;
        }

        .form-section button {
            font-family: 'Made Outer Sans', Arial, sans-serif;
            padding: 15px; /* Increased button size */
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px; /* Larger font size */
            cursor: pointer;
        }

        .form-section button:hover {
            background-color: #1e8449;
        }

        .form-section a {
            font-size: 16px; /* Larger font size */
            color: #27ae60;
            text-decoration: none;
        }

        .form-section a:hover {
            text-decoration: underline;
        }

        .form-section .links {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        /* Media Query for Mobile Devices */
        @media (max-width: 1050px) {
            .container {
                flex-direction: column;
                width: 100%;
                max-width: 400px;
            }

            .branding-section {
                padding: 20px;
                text-align: center;
            }

            .branding-section h1 {
                font-size: 1.5rem;
            }

            .branding-section p {
                font-size: 1rem;
            }

            .form-section {
                padding: 20px;
            }

            .form-section h1 {
                font-size: 1.5rem;
            }

            .form-section input {
                font-size: 0.9rem;
                padding: 10px;
            }

            .form-section button {
                font-size: 0.9rem;
                padding: 10px;
            }

            .form-section a {
                font-size: 0.9rem;
            }
    </style>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h2>Reset Your Password</h2>
        <p>Enter a new password for your account.</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.update.save') }}" method="POST">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="token" value="{{ request()->route('token') }}">
        
            <label for="email">Email Address</label>
            <input type="email" name="email" required>
        
            <label for="password">New Password</label>
            <input type="password" name="password" required>
        
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" name="password_confirmation" required>
        
            <button type="submit">Reset Password</button>
        </form>

        <a href="{{ route('login') }}">Back to Login</a>
    </div>
</body>
</html>
