<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AllerCheck Upload Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg,#59b512, #fbe62d, #ff282a);
            background-size: 300% 300%;
            animation: gradientAnimation 10s ease infinite;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            display: flex;
            flex-direction: row;
            width: 90%; /* Increased width */
            max-width: 1300px; /* For larger screens */
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .left-section, .right-section {
            padding: 40px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .left-section {
            background-color: #28a745;
            color: #ffffff;
            position: relative;
            background-image: url('build/assets/bg.jpg');
            background-size: cover;
            background-position: center;
        }

        .left-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
            z-index: 1;
        }

        .left-section h1 {
            font-size: 4rem; /* Larger font size */
            font-weight: bold;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .left-section p {
            font-size: 1.6rem; /* Increased text size */
            line-height: 1.8;
            position: relative;
            z-index: 2;
            font-weight: 400;
        }

        .right-section {
            background-color: #f7f7f7;
            color: #333;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .right-section p {
            font-size: 2rem;
            color: #555;
            margin-bottom: 20px;
        }

        .right-section button {
            width: 80%; /* Adjust button width */
            padding: 20px; /* Larger button size */
            font-size: 20px;
            font-weight: bold;
            color: #ffffff;
            background-color: #007bff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .right-section button:hover {
            background-color: #0056b3;
        }

        .right-section .capture-btn {
            background-color: #28a745;
        }

        .right-section .capture-btn:hover {
            background-color: #218838;
        }

        .submit-btn {
            background-color: #6c757d;
        }

        .submit-btn:hover {
            background-color: #5a6268;
        }

        .or-text {
            font-size: 18px;
            font-weight: bold;
            margin: 20px 0;
            color: #333;
        }

        #camera-preview {
            display: none; /* Initially hidden */
            width: 320px;
            height: 240px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        video, canvas {
            max-width: 100%;
            max-height: 100%;
            display: none;
        }

        .navbar {
            width: 100%;
            background-color:#1F2937;
            padding: 10px 20px; /* Reduced padding for smaller screens */
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
            width: calc(100% - 40px); /* Full width minus the margin */
            margin: 0 20px; /* Adds 20px margin on the left and right */
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
            font-family: 'Made Outer Sans', Arial, sans-serif;
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
            font-family: 'Made Outer Sans', Arial, sans-serif;
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

        #backButton {
        width: 80%; /* Align with other buttons */
        padding: 20px;
        font-size: 20px;
        font-weight: bold;
        color: black;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        margin-top: 30px; /* Space between Analyze button and Back button */
    }

    #backButton:hover {
        background-color:rgb(5, 80, 160);

    }
    #uploadImageButton{
        background-color: green;
    }

    #takePhotoButton{
        background-color: red;
    }

    #uploadForm {
        width: 100%;
        display: flex; /* Use flexbox for centering */
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically if needed */
        padding: 0; /* Adjust padding if necessary */
        margin: 0 auto; /* Center horizontally with margin auto */
    }
    #uploadForm button{
        width: 80%;
    }

    .right-section #back-btn {
        background-color: transparent;
    }
            /* Responsive Design */
            @media (max-width: 1050px) {
            body {
                padding: 70px 10px; /* Further reduced padding for smaller screens */
                display: block;
            }

            .container {
                flex-direction: column;
                width: 100%;
                margin: 0;
            }

            .left-section, .right-section {
                padding: 20px;
                flex: unset;
            }

            .left-section h1 {
                font-size: 2.5rem;
            }

            .left-section p, .right-section p {
                font-size: 1.2rem;
            }

            .right-section button {
                padding: 15px;
                font-size: 16px;
            }

            .navbar .title {
                font-size: 18px; /* Reduce font size for better fit */
            }

            .navbar .dropdown-btn {
                font-size: 14px;
            }
        }

    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="title">AllerCheck</div>
        <div class="dropdown">
            <button class="dropdown-btn"> {{ Auth::user()->name ?? 'Guest' }}</button>
            <div class="dropdown-content">
                <a href="/profile">Profile</a>
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
        <!-- Left Section -->
        <div class="left-section">
            <h1>ALLERCHECK</h1>
            <p>Your guide to fruit & vegetable allergies</p>
             
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <p>Discover the possible allergies that may arise from the fruit and vegetable you eat.</p>

            
            <!-- Upload Image Button -->
            <button id="uploadImageButton">Upload Image</button>
            <div id="imageName" class="image-name" style="display: none;"></div>
            <div class="or-text">OR</div>
            
          
            
            <!-- Take a Photo Button -->
            <button id="takePhotoButton" class="capture-btn">Take a Photo</button>

            <!-- Camera and Photo Preview Section -->
            <div id="camera-preview" style="display: none;">
                <video id="video" autoplay></video>
                <canvas id="canvas" style="display: none;"></canvas>
            </div>
            
             
            <!-- Capture and Retake Photo Buttons -->
            <button id="capturePhotoButton" class="capture-btn" style="display: none;">Capture Photo</button>
            <button id="retakePhotoButton" class="submit-btn" style="display: none;">Retake Photo</button>
            
            <!-- Loader (Hidden Initially) -->
            <div id="loaderContainer" style="display: none;">
                <p>Analyzing...</p>
            </div>

            <!-- Upload and Analyze Button -->
            <form id="uploadForm" action="{{ route('upload.image') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="image" id="fileInput" accept=".jpg, .jpeg, .png" style="display: none;">
                <input type="hidden" name="camera_image" id="cameraImageInput">
                <button type="submit" class="submit-btn" id="analyzeButton" style="display: none ;">Analyze</button>
                @error('image') 
                    <span style="color: red;">{{ $message }}</span><br>
                @enderror
            </form>
        </div>
    </div>

    <script>
        const uploadImageButton = document.getElementById('uploadImageButton');
        const takePhotoButton = document.getElementById('takePhotoButton');
        const analyzeButton = document.getElementById('analyzeButton');
        const capturePhotoButton = document.getElementById('capturePhotoButton');
        const retakePhotoButton = document.getElementById('retakePhotoButton');
        const backButton = document.createElement('button'); 
        const fileInput = document.getElementById('fileInput');
        const imageName = document.getElementById('imageName');
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const cameraPreview = document.getElementById('camera-preview');
        const cameraImageInput = document.getElementById('cameraImageInput');
        const orText = document.querySelector('.or-text');
        const loaderContainer = document.getElementById('loaderContainer');
        let cameraStream = null;
        
      // Handle "Analyze" button click
        analyzeButton.addEventListener('click', (event) => {
            // Prevent form submission if no image is selected
            if (!fileInput.value && !cameraImageInput.value) {
                event.preventDefault();
                alert('Please upload or capture an image before analyzing.');
                return;
            }

            // Hide buttons and show loader
            uploadImageButton.style.display = 'none';
            takePhotoButton.style.display = 'none';
            analyzeButton.style.display = 'none';
            loaderContainer.style.display = 'block';
            backButton.style.display='none';
            retakePhotoButton.style.display = 'none'
        });
    // Enable the Analyze button if an image is uploaded
    fileInput.addEventListener('change', () => {
        const file = fileInput.files[0];
        if (file) {
            imageName.textContent = `Selected Image: ${file.name}`;
            imageName.style.display = 'block'; 
            analyzeButton.disabled = false; // Enable Analyze button
        }
    });

    // Enable the Analyze button if a camera image is captured
    cameraImageInput.addEventListener('input', () => {
        if (cameraImageInput.value) {
            analyzeButton.disabled = false; // Enable Analyze button
        }
    });

        // Add styles and functionality to the back button
        backButton.textContent = "Back";
        backButton.style.display = 'none'; 
        backButton.style.marginBottom = '20px';
        backButton.className = "back-btn";

        // Add back button to the DOM
        const rightSection = document.querySelector('.right-section');
        rightSection.insertBefore(backButton, rightSection.lastChild);
        
        // Detect if the user is on a mobile device or PC
        const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

        // Ensure initial visibility of elements
        window.onload = () => {
            canvas.style.display = 'none';
            cameraPreview.style.display = 'none';
            capturePhotoButton.style.display = 'none';
            retakePhotoButton.style.display = 'none';
            backButton.style.display = 'none';
            analyzeButton.style.display = 'none'; 
            imageName.style.display = 'none'; 
            orText.style.display = 'block';
            backButton.style.display = 'none';
            
            // Check if the user is on a mobile device and hide "Take a Photo" button
            const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
            if (isMobile) {
                takePhotoButton.style.display = 'none'; // Hide "Take a Photo" button on mobile devices
                orText.style.display = 'none';          // Hide "OR" text on mobile devices
                uploadImageButton.textContent = 'Upload Image or Take a Photo'; // Update button text on mobile
                backButton.style.display = 'none'; // Hide the "Back" button on mobile devices
            } else {
                takePhotoButton.style.display = 'block'; // Show "Take a Photo" button on PCs
                orText.style.display = 'block';          // Show "OR" text on PCs
                uploadImageButton.textContent = 'Upload Image'; // Reset button text on PCs
            }
        };

        // Handle "Upload Image" button click
        uploadImageButton.addEventListener('click', () => {
            takePhotoButton.style.display = 'none';
            analyzeButton.style.display = 'block'; 
            orText.style.display = 'none';  
            
            
            // Check if the user is on a mobile device
            if (isMobile) {
                backButton.style.display = 'none'; // Keep back button hidden on mobile
            } else {
                backButton.style.display = 'block'; // Show back button on PCs
            }

            if (cameraStream) {
                cameraStream.getTracks().forEach(track => track.stop());
                cameraStream = null;
            }
            cameraPreview.style.display = 'none';
            capturePhotoButton.style.display = 'none';
            retakePhotoButton.style.display = 'none';

            fileInput.click();
        });

        // Display file name after selection
        fileInput.addEventListener('change', () => {
            const file = fileInput.files[0];
            if (file) {
                imageName.textContent = `Selected Image: ${file.name}`;
                imageName.style.display = 'block'; 
            }
        });

        // Handle "Take a Photo" button click
        takePhotoButton.addEventListener('click', () => {
            uploadImageButton.style.display = 'none';
            analyzeButton.style.display = 'block'; 
            backButton.style.display = 'block';
             orText.style.display = 'none';

            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    cameraStream = stream;
                    video.srcObject = stream;
                    cameraPreview.style.display = 'block';
                    video.style.display = 'block';
                    capturePhotoButton.style.display = 'block';
                    takePhotoButton.style.display = 'none';
                })
                .catch(err => console.error("Error accessing camera: ", err));

            imageName.style.display = 'none';
        });

        // Handle back button click
        backButton.addEventListener('click', () => {
            uploadImageButton.style.display = 'block';
            takePhotoButton.style.display = 'block';
            analyzeButton.style.display = 'none'; 
            backButton.style.display = 'none';
            orText.style.display = 'block';

            
            cameraPreview.style.display = 'none';
            capturePhotoButton.style.display = 'none';
            retakePhotoButton.style.display = 'none';

            if (cameraStream) {
                cameraStream.getTracks().forEach(track => track.stop());
                cameraStream = null;
            }

            video.style.display = 'none';
            canvas.style.display = 'none';

            // Reset hidden inputs for images
            cameraImageInput.value = ''; 
            fileInput.value = ''; 
            imageName.style.display = 'none';
            imageName.textContent = ''; 
        });

        // Capture photo
        capturePhotoButton.addEventListener('click', () => {
            const context = canvas.getContext('2d');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            const dataUrl = canvas.toDataURL('image/jpeg');
            cameraImageInput.value = dataUrl; 

            video.style.display = 'none'; 
            canvas.style.display = 'block';

            capturePhotoButton.style.display = 'none'; 
            retakePhotoButton.style.display = 'block';

            if (cameraStream) {
                cameraStream.getTracks().forEach(track => track.stop());
                cameraStream = null;
            }
        });

        // Retake photo
        retakePhotoButton.addEventListener('click', () => {
            canvas.style.display = 'none';
            video.style.display = 'block';
            capturePhotoButton.style.display = 'block';
            retakePhotoButton.style.display = 'none';

            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    cameraStream = stream;
                    video.srcObject = stream;
                })
                .catch(err => console.error("Error accessing camera for retake: ", err));
        });

    </script>
</body>
</html>