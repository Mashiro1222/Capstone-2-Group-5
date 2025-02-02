<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
            width: 70%; /* Adjusted for responsiveness */
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background: #fff;
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
            font-size: 60px; /* Larger font size */
            margin-bottom: 20px;
        }

        .branding-section p {
            font-size: 18px; /* Larger font size */
            margin-bottom: 20px;
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
            padding: 60px; /* Increased padding for better spacing */
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
            font-size: 16px; /* Larger font size */
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
</head>
<body>
<div class="container">
        <div class="branding-section">
            <h1>Welcome to AllerCheck!</h1>
            <p>
            AllerCheck is your reliable companion for direct allergen identification, understanding cross-reactivity, and gaining essential insights into the foods you consume. Designed with simplicity and accuracy in mind, AllerCheck empowers you to make safe and informed choices effortlessly.
            </p>
        </div>
        <div class="form-section">
    <h1>Login</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required><br>
        @error('email') <span>{{ $message }}</span><br> @enderror

        <input type="password" name="password" placeholder="Password" required><br>
        @error('password') <span>{{ $message }}</span><br> @enderror

        <button type="submit">Login</button>
    </form>
    
    <!-- Add a link to the signup page -->
    <p>
        <a href="{{ route('signup') }}">Create New Account</a>
    </p>
    <div class="image-section"></div>
</body>
</html>
