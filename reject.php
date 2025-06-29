<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Include the database connection
include 'db.php';

// Get the application ID from the URL
$application_id = $_GET['id'];

// Update the status of the application to 'Rejected'
$sql = "UPDATE application SET status = 'Rejected' WHERE application_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $application_id);
$stmt->execute();

// Redirect back to the review applications page
header("Location: review_request.php");
exit();
?>
