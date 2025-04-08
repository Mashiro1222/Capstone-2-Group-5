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
            font-family: 'Made Outer Sans', Arial, sans-serif;
            background: none;
            color: #bebebe;
            border: none;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            padding: 10px 100px;
            max-width: 500px; /* Adjust for long names */
            white-space: nowrap; /* Prevent wrapping */
            overflow: hidden; /* Hide overflowing text */
            text-overflow: ellipsis; /* Add ellipsis for overflow */
            display: flex;
            align-items: center;
            gap: 8px; /* Spacing between text and icon */
        }
        
        .navbar .dropdown-btn::after {
            content: "▼"; /* Unicode Downward Arrow */
            font-size: 12px;
            transition: transform 0.3s ease-in-out;
        }
        
        /* Rotate icon when dropdown is open */
        .navbar .dropdown-btn.active::after {
            transform: rotate(180deg);
        }
        
                /* Minimal hover effect */
        .navbar .dropdown-btn:hover {
            color: #e0e0e0; /* Slightly brighter hover color */
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
        
        /* Style the search filter container */
        .filter-container {
            display: flex;
            align-items: center;
            gap: 15px; /* Adjust spacing */
            justify-content: center;
            margin-bottom: 20px;
            flex-wrap: wrap; /* Makes it responsive */
        }
        
        /* Style the search input */
        #searchInput {
            width: 280px;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
        }
        
        /* Focus effect */
        #searchInput:focus {
            border-color: #c73232;
            outline: none;
            box-shadow: 0 0 5px rgba(199, 50, 50, 0.5);
        }
        
        /* Style the date inputs */
        #startDate, #endDate {
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            width: 170px;
        }
        
        /* Style labels */
        label {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        
        /* Make inputs align properly */
        input[type="date"] {
            text-align: center;
            cursor: pointer;
        }

        
    </style>
</head>
<body>
    <div class="navbar">
        <div class="title">
            <a href="/dashboard" style="color: #fff; text-decoration: none;">AllerCheck</a>
        </div>
        <div class="dropdown">
            <button class="dropdown-btn">{{ Auth::user()->name ?? 'Guest' }}</button>
            <div class="dropdown-content">
                <a href="/profile">Profile</a>
                <a href="/dashboard">Dashboard</a>
                <a href="/history">History</a>
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

    <h1>Your Detection History</h1>
    <!-- Search Filter -->
    <input type="text" id="searchInput" placeholder="Search for fruit/vegetable..." onkeyup="filterTable()" />
    
    <!-- Date Range Filters -->
    <label for="startDate">From:</label>
    <input type="date" id="startDate" onchange="filterTable()" />
    
    <label for="endDate">To:</label>
    <input type="date" id="endDate" onchange="filterTable()" />


    <table id="historyTable">
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
<script>
    
function filterTable() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let startDate = document.getElementById("startDate").value;
    let endDate = document.getElementById("endDate").value;
    let table = document.getElementById("historyTable");
    let rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) { // Skip the header row
        let dateColumn = rows[i].getElementsByTagName("td")[0]; // Date column (1st column)
        let fruitColumn = rows[i].getElementsByTagName("td")[1]; // Fruit/Vegetable column (2nd column)

        if (dateColumn && fruitColumn) {
            let dateText = dateColumn.textContent || dateColumn.innerText;
            let fruitText = fruitColumn.textContent || fruitColumn.innerText;

            let rowDate = new Date(dateText.split(" ")[0]); // Convert date string to Date object

            let matchesSearch = fruitText.toLowerCase().includes(input);

            // Check if the row date is within the selected range
            let matchesDate = true;
            if (startDate) {
                let start = new Date(startDate);
                matchesDate = rowDate >= start;
            }
            if (endDate) {
                let end = new Date(endDate);
                matchesDate = matchesDate && rowDate <= end;
            }

            // Show row only if both conditions are met
            rows[i].style.display = matchesSearch && matchesDate ? "" : "none";
        }
    }
}


</script>
</html>
