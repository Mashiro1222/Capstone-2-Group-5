<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Detection History</title>
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
            padding: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            font-size: 50px;
            text-align: center;
            margin-bottom: 40px;
            padding-top: 40px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f8f8f8;
            font-weight: bold;
            font-size: 20px;
            color: #c73232;
        }

        tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #555;
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

    <h1>Your Detection History</h1>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Fruit/Vegetable Name</th>
            </tr>
        </thead>
        <tbody>
            @forelse($history as $record)
                <tr onclick="window.location='{{ route('history.show', $record->id) }}'">
                    <td>{{ $record->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>{{ $record->item_name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="no-data">No detection history found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
