<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Include the database connection
include 'db.php';

// Fetch all applications (including Pending, Approved, and Rejected)
$sql = "
    SELECT 
        application.application_id, 
        student.name AS student_name,
        scholarship.name AS scholarship_name, 
        application.submission_date, 
        application.amount, 
        application.status 
    FROM application
    INNER JOIN student ON application.student_id = student.student_id
    INNER JOIN scholarship ON application.scholarship_id = scholarship.scholarship_id
     WHERE application.status = 'Approved'
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Applications</title>
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

        th, td {
            padding: 10px;
            /* border: 1px solid #ccc; */
            text-align: center;
        }

        th {

            background-color:rgb(0, 123, 255);

            color: white;
        }

        tr {
            color: whitesmoke;
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

    <h1>All Applications</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Application ID</th>
                    <th>Student Name</th>
                    <th>Scholarship Name</th>
                    <th>Submission Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['application_id']; ?></td>
                        <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['scholarship_name']); ?></td>
                        <td><?php echo $row['submission_date']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-data">No applications found.</p>
    <?php endif; ?>

    <?php
    // Close the database connection
    $conn->close();
    ?>

<?php include 'footer.php'; ?>

</body>
</html>
