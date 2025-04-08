<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Allergen Results</title>
    <style>
        @font-face {
            font-family: 'Made Outer Sans';
            src: url('{{ asset('fonts/MADEOuterSans-Regular.otf') }}') format('opentype');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'Made Outer Sans', Arial, sans-serif;
            background: linear-gradient(135deg,#59b512, #fbe62d, #ff282a);
            background-size: 300% 300%;
            animation: gradientAnimation 10s ease infinite;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {

            background: linear-gradient(135deg, #ffffff, #f9f9ff);
            border-radius: 16px;
            border: 1px solid #ddd;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            padding: 40px; /* Reduced padding for a smaller box */
            width: 100%; /* Reduced width for better visibility */
            max-width: 600px; /* Adjusted max-width */
            text-align: center;
            margin-top: 60px;
        }

        .header {
            font-size: 37px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .image-section img {
            width: 250px; /* Reduced size */
            height: auto;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .name {
            font-size: 32px;
            font-weight: bold;
            color: #4caf50;
            margin-bottom: 10px;
        }

        .info-section {
            background: #f7faff;
            border-radius: 16px;
            border: 1px solid #ddd;
            padding: 30px 20px; /* Reduced padding for the info section */
            margin-top: 20px;
            box-shadow: inset 0 4px 6px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .info-section h4 {
            font-size: 24px; /* Adjusted size for consistency */
            font-weight: bold;
            color: #000;
            margin: 0 0 15px;
            text-align: center;
        }

        .info-section p {
            font-size: 20px; /* Adjusted for readability in smaller box */
            color: #555;
            margin: 5px 0;
            text-align: left;
        }

        .info-section p strong {
            font-size: 22px; /* Highlight key terms */
            color: #333; 
        }

        .button {
            text-align: center;
            margin-top: 30px;
        }

        .button a {
            display: inline-block;
            background-color: rgb(248, 70, 70);
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .button a:hover {
            background-color: rgb(248, 70, 70);
            transform: scale(1.05);
            cursor: pointer;
        }

        .navbar {
            width: 100%;
            background-color:#1F2937;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #bebebe;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .navbar .title {
            font-size: 16px;
            font-weight: bold;
            color: #bebebe;
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

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5); /* Slightly transparent background */
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            margin: auto;
            padding: 20px 40px;
            border: 1px solid #ddd;
            border-radius: 12px;
            width: 50%;
            max-width: 600px;
            text-align: center;
            position: relative;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Subtle shadow */
            animation: fadeIn 0.3s ease; /* Fade-in effect for modal */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Close Button */
        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #aaa;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #333;
            text-decoration: none;
            cursor: pointer;
        }

        /* Feedback Form Questions */
        .question {
            margin-bottom: 20px;
            text-align: left;
        }

        .question p {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
        }

        /* Radio Button Group */
        .radio-group {
            display: flex;
            justify-content: space-around;
            gap: 10px;
            flex-wrap: wrap; /* Allow wrapping */
            max-width: 300px;
            margin: 0 auto;
        }

        .radio-group input[type="radio"] {
            display: none; /* Hide the native radio input */
        }

        .radio-group label {
            font-size: 16px;
            color: #555;
            cursor: pointer;
            padding: 10px 12px;
            border: 2px solid #ddd;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            line-height: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .radio-group input[type="radio"]:checked + label {
            background-color: rgb(248, 70, 70);
            color: white;
            border-color: rgb(248, 70, 70);
        }

        .radio-group label:hover {
            border-color: rgb(248, 70, 70);
            color: rgb(248, 70, 70);
        }

        /* Submit Button */
        .submit-btn {
            display: inline-block;
            background-color: rgb(248, 70, 70);
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            transition: background-color 0.3s ease, transform 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Responsive Design */
        @media (max-width: 750px) {
            .header {
                font-size: 22px;
            }

            .image-section img {
                max-width: 200px;
            }

            .info-section h4 {
                font-size: 18px;
            }
            
            .info-section p strong {
                font-size: 15px;
            }

            .info-section p {
                font-size: 12px;
            }

            .button a {
                font-size: 12px;
                padding: 8px 15px;
            }

            .navbar .title {
                font-size: 1.2rem;
            }
            
            .modal-content {
                width: 80%;
                padding: 15px 20px;
            }

            .radio-group {
                justify-content: center; /* Center-align on mobile */
                gap: 15px; /* Increase spacing between items */
            }

            .radio-group label {
                width: 35px;
                height: 35px;
                font-size: 14px;
            }

            .submit-btn {
                font-size: 14px;
                padding: 8px 15px;
            }

        }

    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="title">
            <a href="/dashboard" style="color: #bebebe; text-decoration: none;">AllerCheck</a>
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
    
    <div class="container">
        <!-- Header -->
        <div class="header">Allergen Results</div>
        <!-- Allergen Alert -->
        @if (!empty($allergenWarnings))
            <div class="allergen-alert">
                <p>⚠️ <strong>Allergen Alert:</strong> The following allergens from your profile were detected:</p>
            </div>
        @endif

        <!-- Uploaded Image -->
        <div class="image-section">
            <img src="{{ $resultImagePath }}" alt="Annotated Image">
        </div>

        <!-- Detected Name -->
        <div class="name">
            {{ $matchedItems[0]['name'] ?? 'No Item Found' }}
        </div>

        <!-- Essential Information -->
        <div class="info-section">
            <h4>Essential Information</h4>
            <p><strong>Scientific Name:</strong> {{ $matchedItems[0]['scientific_name'] ?? 'N/A' }}</p>
            <p><strong>Description:</strong> {{ $matchedItems[0]['description'] ?? 'N/A' }}</p>
            <p><strong>Possible Allergen:</strong> {{ $matchedItems[0]['possible_allergen'] ?? 'N/A' }}</p>
            <p><strong>Symptoms:</strong> {{ $matchedItems[0]['symptoms'] ?? 'N/A' }}</p>
            <p><strong>Additional Info:</strong> {{ $matchedItems[0]['essential_information'] ?? 'N/A' }}</p>
        </div>

       <!-- Button -->
        <div class="button">
            @foreach ($detectedClasses as $detectedClass)
                <div class="mt-4">
                    <a 
                        href="#" 
                        class="button a" 
                        data-class="{{ $detectedClass }}">
                        Add Allergen
                    </a>
                    <p id="add-allergen-message" class="mt-2 text-sm text-gray-700 hidden"></p>
                </div>
            @endforeach
            <p id="add-allergen-message" class="mt-4 text-sm text-gray-700 hidden"></p>
            <a href="{{ route('dashboard') }}">Upload Another Image</a>
        </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
        // Simulate a request to get detection results
        fetch('/api/results') // Replace with your actual endpoint
            .then(response => response.json())
            .then(data => {
                const detectedName = data.detectedName;
                const isAllergen = data.isAllergen;

                // Display the allergen result
                const resultContainer = document.getElementById('result-container');
                resultContainer.innerText = detectedName;

                // Show an alert if the detected item is an allergen
                if (isAllergen) {
                    alert(`Warning: ${detectedName} is in your allergen list!`);
                }
            })
            .catch(error => {
                console.error('Error fetching result:', error);
            });
        });
        
        
        document.addEventListener('DOMContentLoaded', function () {
            document.addEventListener('click', function (event) {
                // Check if the clicked element matches the .button.a class
                if (event.target.matches('.button.a')) {
                    event.preventDefault(); // Prevent the default behavior of the <a> element
        
                    const allergenName = event.target.getAttribute('data-class');
                    const messageElement = document.getElementById('add-allergen-message');
        
                    fetch('{{ route("add.allergen") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({ name: allergenName }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Success: Display the success message
                            messageElement.textContent = data.message;
                            messageElement.classList.remove('hidden');
                            messageElement.style.color = 'green';
        
                            // Optionally remove the button after adding
                            event.target.remove();
                        } else {
                            // Already exists or error: Display the message
                            messageElement.textContent = data.message;
                            messageElement.classList.remove('hidden');
                            messageElement.style.color = 'red';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        messageElement.textContent = 'An error occurred while processing your request.';
                        messageElement.classList.remove('hidden');
                        messageElement.style.color = 'red';
                    });
                }
            });
        });




    </script>
</body>
</html>
