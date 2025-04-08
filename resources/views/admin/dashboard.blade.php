<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            background-color: #f7faff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .navbar {
            width: 100%;
            background-color: #1f2937;
            padding: 10px 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .navbar .title {
            font-size: 20px;
            font-weight: bold;
        }

        .navbar .dropdown {
            position: relative;
        }

        .navbar .dropdown-btn {
            background: none;
            color: #ffffff; /* Ensure high contrast on dark navbar */
            border: none;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            padding: 10px 15px; /* Adjust padding for better spacing */
            max-width: 200px; /* Prevent overflow */
            white-space: nowrap; /* Prevent text wrapping */
            overflow: hidden; /* Hide overflowing text */
            text-overflow: ellipsis; /* Add ellipsis for long names */
            transition: color 0.3s ease, background-color 0.3s ease; /* Smooth hover effect */
        }
        
        .navbar .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #ffffff; /* Background color for dropdown */
            color: #333333; /* Text color */
            min-width: 150px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow for better visibility */
            border-radius: 4px;
            overflow: hidden;
            z-index: 10;
        }
        
        .navbar .dropdown-content a {
            display: block;
            text-decoration: none;
            color: #333333; /* Text color for links */
            padding: 10px 20px;
            font-size: 14px;
            transition: background 0.2s;
        }
        
        .navbar .dropdown-content a:hover {
            background-color: #f1f1f1; /* Hover background for dropdown items */
        }


        .navbar .dropdown:hover .dropdown-content {
            display: block;
        }

        .container {
            text-align: center;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            max-width: 500px;
            width: 90%;
            margin: 100px auto;
        }

        .header {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 30px;
            color: #333;
        }

        .button-group {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            padding: 12px 20px;
            font-size: 1rem;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            background-color: #007bff;
            transition: background-color 0.3s ease, transform 0.3s ease;
            text-align: center;
        }

        .button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .logout-button {
            font-family: 'Made Outer Sans', Arial, sans-serif;
            background-color: #dc3545;
            color: white;
            border: none;
            cursor: pointer;
            padding: 12px 20px;
            font-size: 1rem;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .logout-button:hover {
            background-color: #a71d2a;
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .header {
                font-size: 1.5rem;
            }

            .button,
            .logout-button {
                font-size: 0.875rem;
                padding: 10px 15px;
                width: 100%; /* Make buttons full-width on smaller screens */
            }

            .button-group {
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="title" style="padding-left: 30px; padding: 15px; ">AllerCheck</div>
        <div class="dropdown">
            <button class="dropdown-btn" style="padding-right: 50px;"> {{ Auth::user()->name ?? 'Guest' }}</button>
            <div class="dropdown-content">
                <a href="/profile">Profile</a>
                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                        style="display: block; text-decoration: none; color: #333; padding: 10px 20px;">
                        Logout
                    </a>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="header">Admin Dashboard</div>
        <div class="button-group">
            <a href="{{ route('admin.users') }}" class="button">All User Details</a>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>
</body>
</html>
