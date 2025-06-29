<?php
session_start();

// Include the database connection
include 'db.php';

// Get the application ID from the URL
$application_id = $_GET['id'];

// Begin a transaction
$conn->begin_transaction();

try {
    // Get the amount associated with the application
    $sql = "SELECT amount FROM application WHERE application_id = ? AND status != 'Approved'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $application_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the application exists and is not approved
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $amount = $row['amount'];

        // Check if the balance is greater than or equal to the scholarship amount
        $sql = "SELECT bal FROM balance WHERE id = 1"; // Assuming id = 1 for the balance
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch the current balance
        if ($result->num_rows > 0) {
            $balance_row = $result->fetch_assoc();
            $current_balance = $balance_row['bal'];

            // Check if the current balance is sufficient
            if ($current_balance >= $amount) {
                // Update the status of the application to 'Approved'
                $sql = "UPDATE application SET status = 'Approved' WHERE application_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $application_id);

                if (!$stmt->execute()) {
                    throw new Exception("Error updating application status: " . $stmt->error);
                }

                // Deduct the amount from the balance
                $sql = "UPDATE balance SET bal = bal - ? WHERE id = 1 AND bal >= ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("dd", $amount, $amount);

                if (!$stmt->execute() || $stmt->affected_rows === 0) {
                    throw new Exception("Error updating balance or insufficient balance.");
                }

                // Commit the transaction
                $conn->commit();

                // Redirect back to the review applications page
                header("Location: review_request.php");
                exit();
            } else {
                throw new Exception("Insufficient balance to approve this application.");
            }
        } else {
            throw new Exception("Balance record not found.");
        }
    } else {
        throw new Exception("Application not found or already approved.");
    }
} catch (Exception $e) {
    // Rollback the transaction in case of error
    $conn->rollback();
    echo $e->getMessage();  // Display the error message
}

$conn->close();
?>
