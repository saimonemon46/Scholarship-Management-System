<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get values from the form and sanitize them
    $amount = floatval($_POST['amount']);
    $provider = htmlspecialchars($_POST['provider']);

    if ($amount <= 0) {
        echo "Amount should be greater than zero.";
        exit();
    }

    // Begin the transaction
    $conn->begin_transaction();

    try {
        // Insert into fund table
        $stmt = $conn->prepare("INSERT INTO fund (amount, provider, date_added) VALUES (?, ?, NOW())");
        $stmt->bind_param("ds", $amount, $provider);

        if (!$stmt->execute()) {
            throw new Exception("Error inserting into fund table: " . $stmt->error);
        }

        // Update balance table
        $updateBalance = $conn->prepare("UPDATE balance SET bal = bal + ? WHERE id = 1");
        $updateBalance->bind_param("d", $amount);

        if (!$updateBalance->execute()) {
            throw new Exception("Error updating balance: " . $updateBalance->error);
        }

        // Commit the transaction
        $conn->commit();
        //echo "Fund added successfully and balance updated.";

        // Close the statement objects
        $stmt->close();
        $updateBalance->close();
    } catch (Exception $e) {
        // Rollback if an error occurs
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Fund</title>
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

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: white;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(0, 0, 0, 0.7);

            
        }

        button {
            padding: 10px 15px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <?php include 'admin_nav.php'; ?>


    <h1>Add Fund</h1>

    <form method="POST">
        <label for="amount">Amount</label>
        <input type="number" name="amount" id="amount" step="0.01" required >

        <label for="provider">Fund Provider</label>
        <input type="text" name="provider" id="provider" required>

        <button type="submit">Add Fund</button>
        <br><br><br>
        

    </form>


    <?php include 'footer.php'; ?>

</body>
</html>
