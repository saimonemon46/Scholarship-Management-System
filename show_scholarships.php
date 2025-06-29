<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Include the database connection
include 'db.php';

// Fetch all scholarships
$sql = "SELECT scholarship_id, name, amount, deadline FROM scholarship WHERE deadline >= CURDATE()";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Scholarships</title>
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
            text-align: center;
            color: whitesmoke;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(0, 0, 0, 0.6);
        }

        th,
        td {
            padding: 10px;
            /* border: 1px solid #ccc; */
            text-align: center;
        }

        th {
            background-color: rgb(0, 123, 255);
            color: white;
        }

        tr {
            color: white;
            /* background-color:rgb(23, 37, 53); */
        }

        .no-data {
            margin-top: 20px;
            font-size: 18px;
            color: #666;
        }
    </style>
</head>

<body>
    <?php include 'admin_nav.php'; ?>

    <h1>All Scholarships</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Scholarship ID</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Deadline</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['scholarship_id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo number_format($row['amount'], 2); ?></td>
                        <td><?php echo $row['deadline']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-data">No scholarships found.</p>
    <?php endif; ?>

    <?php
    // Close the database connection
    $conn->close();
    ?>


    <?php include 'footer.php'; ?>

</body>

</html>