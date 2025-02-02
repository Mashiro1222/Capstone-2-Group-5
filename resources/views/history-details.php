<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Details</title>
    <style>
        /* Include the custom font */
        @font-face {
            font-family: 'Made Outer Sans';
            src: url("<?php echo asset('fonts/MADEOuterSans-Regular.otf'); ?>") format('opentype');
            font-weight: normal;
            font-style: normal;
        }

        /* General body styling */
        body {
            font-family: 'Made Outer Sans', Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
            background-color: #f7f7f7;
            color: #333;
        }

        /* Centered container for details */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Image styling */
        img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        /* Back button styling */
        .back-button {
            position: absolute;
            top: 70px; /* Adjusted to appear below the navbar */
            left: 20px;
            padding: 10px 20px;
            background-color: rgb(248, 70, 70);
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Back button hover effect */
        .back-button:hover {
            background-color: #c73232;
        }

        /* Heading styling */
        h1 {
            font-family: 'Made Outer Sans', Arial, sans-serif;
            margin-top: 80px;
            text-align: center;
            color: #444;
            font-size: 40px;
        }

        /* Subheading for detected image */
        h2 {
            margin-top: 20px;
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
            <a href="<?php echo url('/dashboard'); ?>" style="color: #fff; text-decoration: none;">Allercheck</a>
        </div>
        <div class="dropdown">
            <button class="dropdown-btn"><?php echo Auth::user()->name ?? 'Guest'; ?></button>
            <div class="dropdown-content">
                <a href="<?php echo url('/profile'); ?>">Edit Profile</a>
                <a href="<?php echo url('/history'); ?>">History</a>
                <form method="POST" action="<?php echo route('logout'); ?>" style="display: inline;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" style="background: none; border: none; color: #333; padding: 10px 20px; cursor: pointer;">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>


    <!-- Back Button -->
    <a href="javascript:history.back()" class="back-button">⬅ Back to History</a>

    <div class="container">
        <h1>Record Details:</h1>
        <p><strong>ID:</strong> <?php echo $record['id']; ?></p>
        <p><strong>User ID:</strong> <?php echo $record['user_id']; ?></p>
        <p><strong>Item Name:</strong> <?php echo $record['item_name']; ?></p>
        <p><strong>Scientific Name:</strong> <?php echo $record['scientific_name']; ?></p>
        <p><strong>Description:</strong> <?php echo $record['description']; ?></p> 
        <p><strong>Possible Allergen:</strong> <?php echo $record['possible_allergen']; ?></p>
        <p><strong>Symptoms:</strong> <?php echo $record['symptoms']; ?></p>
        <p><strong>Essential Information:</strong> <?php echo $record['essential_information']; ?></p>
        <p><strong>Created At:</strong> <?php echo $record['created_at']; ?></p>

        <h2>Detected Image:</h2>
        <?php if (!empty($record['image_path'])): ?>
            <img src="<?php echo '/' . $record['image_path']; ?>" alt="Detected Image">
        <?php else: ?>
            <p>No Image Available</p>
        <?php endif; ?>
    </div>
</body>
</html>
