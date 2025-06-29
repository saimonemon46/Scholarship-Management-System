<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

// Optional: Regenerate session ID to prevent session fixation
session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0px;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Background image with blur effect */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('background.jpg');
            /* Set your image path here */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            filter: blur(5px);
            /* Apply blur */
            z-index: -1;
            /* Puts the pseudo-element behind the content */
        }
        .navbar {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: #007bff;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .navbar a:hover {
            background-color: #0056b3;
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        h1 {
            
            color:white;
           
        }
    </style>
</head>
<body>
        <?php include 'student_nav.php'; ?>

    <div class="content">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
        
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>
