<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $deadline = $_POST['deadline'];
    $amount = $_POST['amount'];

    
    $currentDateTime = date('Y-m-d\TH:i', time()); 


    if ($deadline <= $currentDateTime) {
        $errorMessage = "The deadline must be greater than the current date and time.";
    } else {
        
        $stmt = $conn->prepare("INSERT INTO scholarship (name, amount, deadline) VALUES (?, ?, ?)");

        
        $stmt->bind_param("sds", $name, $amount, $deadline);

        if ($stmt->execute()) {
            
           // $message = "Scholarship added successfully.";
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Scholarship</title>
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
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: transparent;
            /* No background */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Slightly darker shadow for contrast */
            border: 1px solid rgba(255, 255, 255, 0.4);
            /* Soft border for subtle separation */
        }


        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 16px;
            margin-bottom: 8px;
            color: whitesmoke;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
        }

        button {
            padding: 10px 15px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        h1{
            color: whitesmoke;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>

    <?php include 'admin_nav.php'; ?>


    <div class="container">
        <h1>Add Scholarship</h1>

        <?php if (isset($message)) { ?>
            <p class="message"><?php echo $message; ?></p>
        <?php } ?>

        <form action="" method="POST">
            <label for="name">Scholarship Name:</label>
            <input type="text" name="name" id="name" required >

            <label for="amount">Amount:</label>
            <input type="number" name="amount" id="amount" step="0.01" required >
            <label for="deadline">Deadline:</label>
            <input type="date" name="deadline" id="deadline" required>

            <button type="submit">Add Scholarship</button>
        </form>

        <br><br><br>


    </div>
    <?php include 'footer.php'; ?>

</body>

</html>