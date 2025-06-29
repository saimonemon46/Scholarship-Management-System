<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Navigation bar at the top */
        .navbar {
            display: flex;
            justify-content: flex-end;
            /* Aligns items to the right */
            align-items: center;
            width: 95%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Semi-transparent dark background */
            position: absolute;
            top: 0;
            left: 0;
            padding: 15px 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            z-index: 10;
            /* Ensure navbar is above the content */
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .navbar a:hover {
            background-color: #007BFF;
            transform: translateY(-3px);
            /* Slightly lift the button on hover */
        }

        /* Main content container */
        .container {
            text-align: center;
            padding: 30px 50px;
            background-color: rgba(0, 0, 0, 0.7);
            /* Semi-transparent dark background */
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            width: 300px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            /* Center the container */
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="admin_login.php">Admin Login</a>
        <a href="student_login.php">Student Login</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact Us</a>
    </div>
</body>

</html>