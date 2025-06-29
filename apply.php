<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_SESSION['student_id'];
    $scholarship_id = intval($_POST['scholarship_id']); 
    $submission_date = date('Y-m-d'); 

    // Check if the student has already applied for a scholarship
    $check_stmt = $conn->prepare("SELECT * FROM application WHERE student_id = ? AND scholarship_id = ?");
    $check_stmt->bind_param("ii", $student_id, $scholarship_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $errorMessage = "You have already applied for this scholarship.";
    } else {
        // Validate that the scholarship exists and is still open
        $stmt = $conn->prepare("SELECT * FROM scholarship WHERE scholarship_id = ? AND deadline >= CURDATE()");
        $stmt->bind_param("i", $scholarship_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $errorMessage = "Invalid or expired scholarship selected.";
        } else {
            // Fetch scholarship amount
            $scholarship = $result->fetch_assoc();
            $amount = $scholarship['amount'];

            // Insert application
            $insert_stmt = $conn->prepare("INSERT INTO application (student_id, scholarship_id, submission_date, amount) VALUES (?, ?, ?, ?)");
            $insert_stmt->bind_param("iisd", $student_id, $scholarship_id, $submission_date, $amount);

            if ($insert_stmt->execute()) {
                $message = "Application submitted successfully.";
                header("Location: apply.php"); 
                exit();
            } else {
                $errorMessage = "Error: " . $conn->error;
            }

            $insert_stmt->close();
        }

        $stmt->close();
    }

    $check_stmt->close();
}

// Fetch open scholarships
$scholarships = $conn->query("SELECT * FROM scholarship WHERE deadline >= CURDATE()");
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Scholarship</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0px;
            padding: 0;
            background-color: #f4f4f4;
            color: whitesmoke;
            position: relative;
            min-height: 100vh;
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
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            filter: blur(8px);
            /* Increase blur for better readability */
            z-index: -1;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
            color: #f4f4f4;
            font-size: 36px;
            font-weight: bold;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
            /* Added text shadow for visibility */
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 30px auto;
            background-color: rgba(0, 0, 0, 0.7);
            /* Darker background for readability */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #f4f4f4;
            font-size: 16px;
        }

        select,
        button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        select {
            background-color: #333;
            color: #fff;
        }

        select:focus {
            border-color: #007BFF;
            outline: none;
            background-color: #444;
        }

        button {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            border: none;
        }

        button:hover {
            background-color: #0056b3;
        }

        button:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin: 10px 0;
            text-align: center;
        }

        .success-message {
            color: green;
            font-weight: bold;
            margin: 10px 0;
            text-align: center;
        }

        .scholarship-list {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php include 'student_nav.php'; ?>

    <h1>Apply For Scholarships</h1>
    <div class="container">
        <form action="apply.php" method="POST">
            <div class="scholarship-list">
                <label for="scholarship_id">Select Scholarship:</label>
                <select name="scholarship_id" id="scholarship_id" required>
                    <?php while ($row = $scholarships->fetch_assoc()) { ?>
                        <option value="<?php echo htmlspecialchars($row['scholarship_id']); ?>">
                            <?php echo htmlspecialchars($row['name']); ?> (Deadline: <?php echo htmlspecialchars($row['deadline']); ?>)
                        </option>
                    <?php } ?>
                </select>
            </div>

            <button type="submit">Apply</button>
        </form>
    </div>
    <?php include 'footer.php'; ?>

</body>

</html>