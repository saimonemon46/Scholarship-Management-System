<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .navbar {
            display: flex;
            justify-content: right;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease, color 0.3s ease;
            margin: 0 5px;
        }

        .navbar a:hover {
            background-color: #0056b3;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <a href="admin_dashboard.php">Home</a>
        <a href="add_fund.php">Add Fund</a>
        <a href="add_scholarship.php">Add Scholarship</a>
        <a href="show_scholarships.php">Show Scholarships</a>
        <a href="see_status.php">See Status</a>
        <a href="review_request.php">View Requests</a>
        <a href="view_balance.php">View Balance</a>
        <a href="view_provider.php">View Provider</a>
        <a href="logout.php">Logout</a>
    </nav>
</body>

</html>