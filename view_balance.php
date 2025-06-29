<?php
// Start the session and check if the admin is logged in
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';  // Include the database connection

// Fetch the total balance from the balance table
$query = "SELECT bal FROM balance WHERE id = 1";  // Assuming you have only one record with id = 1
$result = $conn->query($query);

// Check if the result is valid
if ($result->num_rows > 0) {
    // Fetch the balance
    $row = $result->fetch_assoc();
    $balance = $row['bal'];
} else {
    $balance = 0.00;  // If no balance is found, default to 0.00
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Total Balance</title>
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

        h1 {
            color: whitesmoke;
        }

        .balance-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px ;
            border: 1px solid rgba(255, 255, 255, 0.4);
            /* Transparent border */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(0, 0, 0, 0.6); 
            backdrop-filter: blur(5px);
          
            text-align: center;
        }

        .balance-container p {
            font-size: 20px;
            font-weight: bold;
        }

        .balance {
            font-size: 24px;
            color: #007BFF;
        }

        .back-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include 'admin_nav.php'; ?>


    <div class="balance-container">
        <h1>Total Balance</h1>

        <!-- Display the balance -->
        <p class="balance">$<?php echo number_format($balance, 2); ?></p>

        <!-- Back Button -->
        <a href="admin_dashboard.php">
            <button class="back-button">Back to Dashboard</button>
        </a>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>