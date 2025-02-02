<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Link to your CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert Library -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> <!-- Axios Library -->
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
            padding: 60px; /* Consistent with login page */
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .branding-section h1 {
            font-size: 60px;
            margin-bottom: 20px;
        }

        .branding-section p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .branding-section button {
            padding: 14px 20px;
            background-color: #fff;
            color: #27ae60;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
        }

        .branding-section button:hover {
            background-color: #f0f4f7;
        }

        .form-section {
            flex: 1;
            padding: 60px; /* Consistent padding */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-section h1 {
            font-size: 28px;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .form-section input {
            margin-bottom: 20px;
            padding: 15px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 100%;
        }

        .form-section button {
            padding: 15px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
        }

        .form-section button:hover {
            background-color: #1e8449;
        }

        .form-section a {
            font-size: 16px;
            color: #27ae60;
            text-decoration: none;
        }

        .form-section a:hover {
            text-decoration: underline;
        }

        /* Mobile Responsiveness */
        @media (max-width: 1050px) {
            .container {
                flex-direction: column; /* Stack sections vertically */
                max-width: 100%; /* Full width */
            }

            .branding-section {
                padding: 20px;
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
            <h1>Welcome</h1>
            <p>
                Create your account to access AllerCheck and make informed decisions about allergens and cross-reactivity.
            </p>
        </div>
        <div class="form-section">
    <h1>Signup</h1>
    <form id="signupForm">
        @csrf
        <input type="text" name="name" id="name" placeholder="Name" value="{{ old('name') }}" required><br>
        <span id="nameError" style="color: red;"></span>

        <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required><br>
        <span id="emailError" style="color: red;"></span>

        <input type="password" name="password" id="password" placeholder="Password" required><br>
        <span id="passwordError" style="color: red;"></span>

        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required><br>

        <a href="{{ route('login') }}">Cancel</a>

        <button type="button" onclick="handleSignup()">Sign Up</button>
    </form>
</div>
    </div>

<script>
    function handleSignup() {
        const formData = new FormData(document.getElementById('signupForm'));

        Swal.fire({
            title: 'Are you sure?',
            text: "A verification email will be sent to your account.",
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Yes, sign up!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post("{{ route('signup') }}", formData)
                    .then(response => {
                        Swal.fire({
                            title: 'Signup Successful!',
                            text: response.data.message || 'A verification email has been sent to your account.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/login'; // Redirect to the login page
                            }
                        });   
                    })
                    .catch(error => {
                        if (error.response && error.response.data && error.response.data.errors) {
                            const errors = error.response.data.errors;
                            document.getElementById('nameError').innerText = errors.name ? errors.name[0] : '';
                            document.getElementById('emailError').innerText = errors.email ? errors.email[0] : '';
                            document.getElementById('passwordError').innerText = errors.password ? errors.password[0] : '';
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong. Please try again.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
            }
        });
    }
</script>
</body>
</html>
