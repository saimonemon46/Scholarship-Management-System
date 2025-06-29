<?php

session_start();

// Check if student is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}

// Include the database connection
include 'db.php';

$student_id = $_SESSION['student_id'];
// Fetch pending applications
$sql = "SELECT a.application_id, s.name ,s.gpa AS student_name, sc.name AS scholarship_name, a.status
        FROM application a
        JOIN student s ON a.student_id = s.student_id
        JOIN scholarship sc ON a.scholarship_id = sc.scholarship_id
        where s.student_id = $student_id
        "; // Show only "Pending" applications
$application = $conn->query($sql);
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application status</title>
    <style>
    body {
            font-family: Arial, sans-serif;
            margin: 0px;
            padding: 0;
            background-color:rgb(242, 228, 228);
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
            color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(0, 0, 0, 0.6); 
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        table th {
            background-color: #f4f4f4;
            color: #333;
        }

        a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
<?php include 'student_nav.php';?>

    <h1>Review Applications</h1>

    <table>
        <tr>
            <th>Application ID</th>
            <th>Student Name</th>
            <th>gpa</th>
            <th>Scholarship</th>
            <th>Status</th>
        </tr>
        <?php if ($application->num_rows > 0) { ?>
            <?php while ($row = $application->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['application_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['gpa']); ?></td>
                    <td><?php echo htmlspecialchars($row['scholarship_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>


                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="5">No Application.</td>
            </tr>
        <?php } ?>
    </table>


    <br><br>
    
    <?php include 'footer.php'; ?>

</body>

</html>

<?php
// Close the database connection
$conn->close();
?>
