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
            height: 100vh;
        }

        .container {
        text-align: center;
        background: white;
        padding: 50px; /* Increased padding for larger appearance */
        border-radius: 16px; /* Slightly more rounded corners */
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); /* Enhanced shadow for emphasis */
        max-width: 800px; /* Increased max-width */
        width: 90%;
        margin-top: 80px; /* Adds spacing below the navbar */
        }

        .header {
            font-size: 70px;
            font-weight: bold;
            margin-bottom: 50px;
        }

        .button-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            padding: 12px 20px;
            font-size: 20px;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            background-color: #007bff;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .logout-button {
            font-family: 'Made Outer Sans', Arial, sans-serif;
            background-color: #dc3545;
            font
        }

        .logout-button:hover {
            background-color: #a71d2a;
        }
        .navbar {
            width: 100%;
            background-color:#1f2937;
            padding: 10px 20px; /* Reduced padding for smaller screens */
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
            font-size: 20px; /* Adjust font size for mobile */
            font-size: 20px;
            font-weight: bold;
            white-space: nowrap; /* Prevent wrapping */
            overflow: hidden; /* Hide overflowing text */
            text-overflow: ellipsis; /* Add ellipsis for overflow */
        }

        .navbar .dropdown {
            position: relative;
        }

        .navbar .dropdown-btn {
            background: none;
            color: #fff;
            border: none;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            padding: 10px 100px;
            max-width: 500px; /* Adjust for long names */
            white-space: nowrap; /* Prevent wrapping */
            overflow: hidden; /* Hide overflowing text */
            text-overflow: ellipsis; /* Add ellipsis for overflow */
        }

        .navbar .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #fff;
            color: #333;
            min-width: 150px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            overflow: hidden;
            z-index: 10;
        }

        .navbar .dropdown-content a {
            display: block;
            text-decoration: none;
            color: #333;
            padding: 10px 20px;
            font-size: 14px;
            transition: background 0.2s;
        }

        .navbar .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .navbar .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body>
<div class="navbar">
        <div class="title">
            <a href="/dashboard" style="color: #fff; text-decoration: none;">Allercheck</a>
        </div>
        <div class="dropdown">
            <button class="dropdown-btn">{{ Auth::user()->name ?? 'Guest' }}</button>
            <div class="dropdown-content">
                <a href="/profile">Edit Profile</a>
                <a href="/history">History</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #333; padding: 10px 20px; cursor: pointer;">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="header">Admin Dashboard</div>
        <div class="button-group">
            <!-- Button for All User Details -->
            <a href="{{ route('admin.users') }}" class="button">All User Details</a>
            
            <!-- Button for All Feedback Details -->
            <a href="{{ route('admin.feedback') }}" class="button">All Feedback Details</a>
            
        </div>
        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="button logout-button">Logout</button>
        </form>
    </div>
</body>
</html>
