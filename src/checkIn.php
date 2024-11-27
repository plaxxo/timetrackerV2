<?php
require_once 'config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();


// Assuming the user is authenticated and their ID is stored in the session
$userId = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM time_entries WHERE user_id = ? AND clock_out IS NULL AND DATE(clock_in) = CURDATE()");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // User is not checked in, insert a new time entry
    $stmt = $conn->prepare("INSERT INTO time_entries (user_id, clock_in, date) VALUES (?, NOW(), CURDATE())"); // Use CURDATE()
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    echo "You are now checked in.";
} else {
    echo "You are already checked in.";
}

$_SESSION['is_checked_in'] = true;
$conn->close();

header("Location: ../frontend/pages/dashboardPage.php");
exit;