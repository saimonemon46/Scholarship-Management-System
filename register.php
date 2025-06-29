<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gpa = floatval($_POST['gpa']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Validate GPA
    if ($gpa < 0 || $gpa > 4.0) {
        die("GPA must be between 0.0 and 4.0.");
    }

    // Validate phone (allowing only numeric values)
    if (!preg_match('/^[0-9]{10,15}$/', $phone)) {
        die("Phone number must contain only digits and be 10-15 characters long.");
    }

    // Use prepared statements for secure database insertion
    $stmt = $conn->prepare("INSERT INTO student (name, email, phone_number, gpa, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $name, $email, $phone, $gpa, $password);

    if ($stmt->execute()) {
        echo "Registration Successful. <a href='student_login.php'>Login here</a>";
    } else {
        // Check for duplicate email error
        if ($conn->errno === 1062) {
            echo "Error: Email already exists. Please try another.";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Scholarship Management System</title>
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
            height: 118%;
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
        h3 {
            text-align: center;
            color: whitesmoke;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(0, 0, 0, 0.6); 
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            color: whitesmoke;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"], button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"]:hover, button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include 'in_nav.php'; ?>
    <div class="container">
        <h1>SMS</h1>
        <h3>Scholarship Management System</h3>
        <h3>Student Registration</h3>

        <!-- Display any error messages -->
        <div class="error">
            <?php if (!empty($error)) echo $error; ?>
        </div>

        <form action="register.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required> <br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required> <br>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" maxlength="15" required> <br>

            <label for="gpa">GPA:</label>
            <input type="number" id="gpa" name="gpa" step="0.01" min="0" max="4.0" required> <br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required> <br>

            <button type="submit">Register</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>
