<?php
include 'db.php';

session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: white;
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
            background-image: url('uni.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            filter: blur(5px); 
            z-index: -1; /* Puts the pseudo-element behind the content */
        }

       

        h1 {
            text-align: center;
            color: white;
            margin: 20px 0px;
            padding: 260px 50px;
        }


    </style>
</head>

<body>

    <?php include 'admin_nav.php'; ?>

    <h1>Welcome to the Admin Dashboard</h1>
    <?php include 'footer.php'; ?>


</body>

</html>
