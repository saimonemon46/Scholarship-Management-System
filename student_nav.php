<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .navbar {
            display: flex;
            justify-content: right;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.7);
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
    </style>
</head>

<body>
    <nav class="navbar">
        <a href="student_dashboard.php">Home</a>
        <a href="apply.php">Apply for Scholarships</a>
        <a href="application_status.php">Application Status</a>
        <a href="see_profile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </nav>


</body>

</html>