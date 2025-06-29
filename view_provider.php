<?php
// Start the session and check if the admin is logged in
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';  // Include the database connection



// Fetch all records from the fund table
$fund_query = "SELECT * FROM fund";
$fund_result = $conn->query($fund_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Total Balance and Funds</title>
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

        h1,
        h2 {
            color: whitesmoke;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            /* Transparent border */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            text-align: center;
        }

        .balance-container {
            margin-bottom: 30px;
        }

        .balance-container p {
            font-size: 20px;
            font-weight: bold;
        }

        .balance {
            font-size: 24px;
            color: #007BFF;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: rgba(186, 186, 186, 0.8);
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #333;
            color: white;
        }

        td {
            color: #333;
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

    <div class="container">



        <h2>Fund Provider</h2>

        <!-- Display the fund table -->
        <table>
            <tr>
                <th>Fund ID</th>
                <th>Amount</th>
                <th>Provider</th>
                <th>Date Added</th>
            </tr>
            <?php
            if ($fund_result->num_rows > 0) {
                // Output data for each row
                while ($row = $fund_result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['fund_id'] . "</td>
                            <td>$" . number_format($row['amount'], 2) . "</td>
                            <td>" . $row['provider'] . "</td>
                            <td>" . $row['date_added'] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No funds available</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </table>

        <!-- Back Button -->
        <a href="admin_dashboard.php">
            <button class="back-button">Back to Dashboard</button>
        </a>
    </div>
    </div>
    <?php include 'footer.php'; ?>

</body>

</html>