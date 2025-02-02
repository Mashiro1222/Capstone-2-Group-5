<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>AllerCheck | Home</title>
    <style>
        @font-face {
            font-family: 'Made Outer Sans';
            src: url('{{ asset('fonts/MADEOuterSans-Regular.otf') }}') format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'Made Outer Sans', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        /* Other styles remain the same */
        .tutorial {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            background-color: rgb(248, 70, 70);
            padding: 20px;
        }

        .step {
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            width: 40rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .step img {
            width: 500px;
            height: 350px;
            margin-bottom: 15px;
        }

        .step h2 {
            font-size: 2rem;
            margin-bottom: 10px;
            color: rgb(255, 189, 67);
        }

        .step p {
            font-size: 1.5rem;
            color: #636e72;
        }

        header {
            background: linear-gradient(90deg, rgb(248, 70, 70), rgb(255, 189, 67));
            color: white;
            padding: 50px 20px;
            text-align: center;
        }

        header h1 {
            font-size: 5rem;
            margin-bottom: 10px;
        }

        header p {
            font-size: 1.5rem;
            margin: 0 auto;
            max-width: 600px;
        }

        .cta-buttons {
            margin-top: 30px;
        }

        .cta-buttons a {
            display: inline-block;
            text-decoration: none;
            padding: 12px 30px;
            margin: 10px;
            font-size: 30px;
            border-radius: 30px;
            background-color: white;
            color: rgb(248, 70, 70);
            border: 2px solid rgb(255, 189, 67);
            transition: 0.3s;
        }

        .cta-buttons a:hover {
            background-color: rgb(248, 70, 70);
            color: white;
        }

        section {
            padding: 50px 20px;
            text-align: center;
        }

        section h2 {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #2d3436;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
            transition: transform 0.3s;
        }

        .feature img {
            max-width: 100%;
            border-radius: 12px;
        }

        .feature h2 {
            font-size: 2rem;
            margin: 15px 0 10px;
            color: rgb(248, 70, 70);
        }

        .feature p {
            font-size: 1.5rem;
            color: #636e72;
        }

        .feature:hover {
            transform: translateY(-10px);
        }

        footer {
            background-color: #2d3436;
            color: #dfe6e9;
            padding: 20px 0;
            text-align: center;
            font-size: 0.875rem;
        }

        footer a {
            color: rgb(248, 70, 70);
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to AllerCheck</h1>
        <p>A web app to detect fruit and vegetable allergens using image detection technology.</p>
        <div class="cta-buttons">
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('signup') }}">Sign Up</a>
        </div>
    </header>

    <section>
        <h2>Why Choose AllerCheck?</h2>
        <div class="features">
            <div class="feature">
                <img src="{{ asset('images/1.png') }}" alt="Image Detection">
                <h2>Image Detection</h2>
                <p>Upload an image to instantly identify potential allergens in fruits and vegetables.</p>
            </div>
            <div class="feature">
                <img src="{{ asset('images/2.jpg') }}" alt="Fruits and Vegetables">
                <h2>Comprehensive Allergen Database</h2>
                <p>Access detailed allergen profiles for a wide variety of fruits and vegetables.</p>
            </div>
            <div class="feature">
                <img src="{{ asset('images/3.jpg') }}" alt="User-Friendly">
                <h2>User-Friendly Interface</h2>
                <p>A clean and simple interface to make allergen detection hassle-free.</p>
            </div>
        </div>
    </section>

    <!-- Tutorial Section -->
    <div class="tutorial">
        <!-- Step 1 -->
        <div class="step">
            <img src="{{ asset('images/11.jpg') }}" alt="Step 1">
            <h2>Step 1: Sign Up or Log In</h2>
            <p>Create an account or log in to access the AllerCheck dashboard.</p>
        </div>

        <!-- Step 2 -->
        <div class="step">
            <img src="{{ asset('images/22.jpg') }}" alt="Step 2">
            <h2>Step 2: Upload an Image</h2>
            <p>Navigate to the dashboard and upload an image of the fruit or vegetable.</p>
        </div>

        <!-- Step 3 -->
        <div class="step">
            <img src="{{ asset('images/33.jpg') }}" alt="Step 3">
            <h2>Step 3: View Results</h2>
            <p>Our AI analyzes the image and provides allergen detection results instantly.</p>
        </div>

        <!-- Step 4 -->
        <div class="step">
            <img src="{{ asset('images/44.jpg') }}" alt="Step 4">
            <h2>Step 4: Provide Feedback</h2>
            <p>Help us improve by providing feedback about your experience.</p>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 AllerCheck. All rights reserved. | <a href="#">Privacy Policy</a></p>
    </footer>
</body>
</html>
