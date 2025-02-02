<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            width: 40px;
            height: 40px;
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

        /* Responsiveness */
        @media (max-width: 768px) {
            .modal-content {
                width: 80%;
                padding: 15px 20px;
            }

            .radio-group {
                flex-wrap: wrap;
                gap: 10px;
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

        /* Responsive Design */
        @media (max-width: 1050px) {
            .header {
                font-size: 2rem;
            }

            .image-section img {
                max-width: 200px;
            }

            .info-section h4 {
                font-size: 1.5rem;
            }

            .info-section p {
                font-size: 1.2rem;
            }

            .button a {
                padding: 8px 15px;
                font-size: 1.2rem;
            }

            .navbar .title {
                font-size: 1.2rem;
            }
        }

    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="title">
            <a href="/dashboard" style="color: #bebebe; text-decoration: none;">Allercheck</a>
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
            <a href="{{ route('dashboard') }}">Upload Another Image</a>
            <br></br>
            <a id="feedbackBtn">Give Feedback</a>
        </div>
        <div id="feedbackModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>We value your feedback!</h2>
            <form id="feedbackForm" action="{{ route('user.feedback.submit') }}" method="POST">
                @csrf
                <!-- Question 1 -->
                <div class="question">
                    <p>1. How accurate do you feel the allergen detection results are?</p>
                    <div class="radio-group">
                        <input type="radio" name="accuracy" value="5" id="accuracy-5" required>
                        <label for="accuracy-5">5</label>

                        <input type="radio" name="accuracy" value="4" id="accuracy-4">
                        <label for="accuracy-4">4</label>

                        <input type="radio" name="accuracy" value="3" id="accuracy-3">
                        <label for="accuracy-3">3</label>

                        <input type="radio" name="accuracy" value="2" id="accuracy-2">
                        <label for="accuracy-2">2</label>

                        <input type="radio" name="accuracy" value="1" id="accuracy-1">
                        <label for="accuracy-1">1</label>
                    </div>
                </div>

                <!-- Question 2 -->
                <div class="question">
                    <p>2. How easy was it to upload or capture an image using AllerCheck?</p>
                    <div class="radio-group">
                        <input type="radio" name="ease" value="5" id="ease-5" required>
                        <label for="ease-5">5</label>

                        <input type="radio" name="ease" value="4" id="ease-4">
                        <label for="ease-4">4</label>

                        <input type="radio" name="ease" value="3" id="ease-3">
                        <label for="ease-3">3</label>

                        <input type="radio" name="ease" value="2" id="ease-2">
                        <label for="ease-2">2</label>

                        <input type="radio" name="ease" value="1" id="ease-1">
                        <label for="ease-1">1</label>
                    </div>
                </div>

                <!-- Question 3 -->
                <div class="question">
                    <p>3. How helpful is the information provided (scientific name, allergens, symptoms, additional info)?</p>
                    <div class="radio-group">
                        <input type="radio" name="info_helpfulness" value="5" id="info-5" required>
                        <label for="info-5">5</label>

                        <input type="radio" name="info_helpfulness" value="4" id="info-4">
                        <label for="info-4">4</label>

                        <input type="radio" name="info_helpfulness" value="3" id="info-3">
                        <label for="info-3">3</label>

                        <input type="radio" name="info_helpfulness" value="2" id="info-2">
                        <label for="info-2">2</label>

                        <input type="radio" name="info_helpfulness" value="1" id="info-1">
                        <label for="info-1">1</label>
                    </div>
                </div>

                <!-- Question 4 -->
                <div class="question">
                    <p>4. How satisfied are you with the overall design and layout of the application?</p>
                    <div class="radio-group">
                        <input type="radio" name="design" value="5" id="design-5" required>
                        <label for="design-5">5</label>

                        <input type="radio" name="design" value="4" id="design-4">
                        <label for="design-4">4</label>

                        <input type="radio" name="design" value="3" id="design-3">
                        <label for="design-3">3</label>

                        <input type="radio" name="design" value="2" id="design-2">
                        <label for="design-2">2</label>

                        <input type="radio" name="design" value="1" id="design-1">
                        <label for="design-1">1</label>
                    </div>
                </div>

                <!-- Question 5 -->
                <div class="question">
                    <p>5. Would you recommend AllerCheck to others for allergen detection?</p>
                    <div class="radio-group">
                        <input type="radio" name="recommend" value="5" id="recommend-5" required>
                        <label for="recommend-5">5</label>

                        <input type="radio" name="recommend" value="4" id="recommend-4">
                        <label for="recommend-4">4</label>

                        <input type="radio" name="recommend" value="3" id="recommend-3">
                        <label for="recommend-3">3</label>

                        <input type="radio" name="recommend" value="2" id="recommend-2">
                        <label for="recommend-2">2</label>

                        <input type="radio" name="recommend" value="1" id="recommend-1">
                        <label for="recommend-1">1</label>
                    </div>
                </div>
                <button type="submit" class="submit-btn">Submit Feedback</button>
            </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        const feedbackBtn = document.getElementById("feedbackBtn");
        const feedbackModal = document.getElementById("feedbackModal");
        const closeBtn = document.querySelector(".close");

        feedbackBtn.addEventListener("click", () => {
            feedbackModal.style.display = "block";
        });

        closeBtn.addEventListener("click", () => {
            feedbackModal.style.display = "none";
        });

        window.addEventListener("click", (event) => {
            if (event.target === feedbackModal) {
                feedbackModal.style.display = "none";
            }
        });

        const feedbackForm = document.getElementById("feedbackForm");

        feedbackForm.addEventListener("submit", async (e) => {
            e.preventDefault();

            const formData = new FormData(feedbackForm);
            try {
                const response = await fetch("{{ route('user.feedback.submit') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    body: formData,
                });

                if (response.ok) {
                    const data = await response.json();
                    alert(data.message || "Thank you for your feedback!");
                    feedbackModal.style.display = "none";
                } else {
                    const errorData = await response.json();
                    alert(errorData.message || "Something went wrong. Please try again.");
                }
            } catch (error) {
                console.error("Error:", error);
                alert("Failed to submit feedback. Please try again.");
            }

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
    });

        
    </script>
</body>
</html>
