<?php
require_once 'config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

// Assuming the user is authenticated and their ID is stored in the session
$userId = $_SESSION['user_id'];

// Check if the user is already checked in
$stmt = $conn->prepare("SELECT * FROM time_entries WHERE user_id = ? AND clock_out IS NULL AND DATE(clock_in) = CURDATE()");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User is checked in, update the clock_out time
    $stmt = $conn->prepare("UPDATE time_entries SET clock_out = NOW() WHERE user_id = ? AND clock_out IS NULL AND DATE(clock_in) = CURDATE()");
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    echo "You are now checked out.";
} else {
    echo "You are already checked out.";
}
$_SESSION['is_checked_in'] = false;

$conn->close();

header("Location: ../frontend/pages/dashboardPage.php");
exit;


