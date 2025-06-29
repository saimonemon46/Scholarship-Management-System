<?php

session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Include the database connection
include 'db.php';

// Fetch pending applications
$sql = "SELECT a.application_id, s.name,s.gpa AS student_name, sc.name AS scholarship_name, a.status
        FROM application a
        JOIN student s ON a.student_id = s.student_id
        JOIN scholarship sc ON a.scholarship_id = sc.scholarship_id
        WHERE a.status = 'Pending'"; // Show only "Pending" applications
$application = $conn->query($sql);
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Review Applications</title>
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
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(0, 0, 0, 0.6); 
        }

        table th, table td {
            /* border: 1px solid #ddd; */
            padding: 8px;
            text-align: center;
        }

        table th {
            background-color:rgb(0, 42, 255);
            color: white;
        }
        table tr{
            color: white;
            /* background-color:rgb(23, 37, 53); */
        }

        a {
            color:rgb(92, 48, 251);
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php include 'admin_nav.php'; ?>

    <h1>Review Applications</h1>

    <table>
        <tr>
            <th>Application ID</th>
            <th>Student Name</th>
            <th>gpa</th>
            <th>Scholarship</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php if ($application->num_rows > 0) { ?>
            <?php while ($row = $application->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['application_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['gpa']); ?></td>
                    <td><?php echo htmlspecialchars($row['scholarship_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td>
                        <a href="approve.php?id=<?php echo $row['application_id']; ?>">Approve</a> |
                        <a href="reject.php?id=<?php echo $row['application_id']; ?>">Reject</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="5">No pending applications to review.</td>
            </tr>
        <?php } ?>
    </table>
</body>

<?php include 'footer.php'; ?>


</html>

<?php
// Close the database connection
$conn->close();
?>
