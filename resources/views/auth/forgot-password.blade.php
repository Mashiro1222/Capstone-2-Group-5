<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
            width: 500px; /* Reduce width to match login page */
            padding: 10px; /* Reduce padding for a smaller feel */
            border-radius: 12px;
            background-color: #27ae60;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            
        }
        
        .container form input {
            text-align: left; /* Align text inside inputs to the left */
            width: 90%; /* Adjust width */
            padding: 12px; /* Increase padding for better visibility */
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: block;
            margin-bottom: 20px;
        }
        
        .container form button {
            width: 90%; /* Make button match input width */
            margin-bottom: 20px; /* Add spacing below button */
            font-size: 18px; /* Increase font size */
            border-radius: 8px; /* Slightly round corners */
        }
        
        .container a {
            font-size: 16px;
            color: white; /* Change text color to white */
            text-decoration: none; /* Remove underline */
            font-weight: bold; /* Make it stand out */
        }
        
        .container a:hover {
            text-decoration: underline; /* Add underline on hover for visibility */
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
            font-size: 40px; /* Larger font size */
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
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <div class="branding-section">
        <h1>Forgot Your Password?</h1>
        <p>
           Enter your email address and we'll send you a link to reset your password.
        </p>
         @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <input type="email" name="email" placeholder="Enter your email" required>
            @error('email')
                <span style="color: red;">{{ $message }}</span>
            @enderror
            <button type="submit">Send Password Reset Link</button>
        </form>

        <a href="{{ route('login') }}">Back to Login</a>
    </div>
</body>
</html>
