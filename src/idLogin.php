<?php
// Database connection details (replace with your credentials)
require_once 'config.php';

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeID = $_POST["employeeID"];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM users WHERE employeeID = ?");
    $stmt->bind_param("s", $employeeID);
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();

    if ($result->num_rows > 0) {
        // Successful login
        session_start();
        $_SESSION['user_id'] = $result->fetch_assoc()['id']; // Assuming you have a user ID
        $_SESSION['username'] = $result->fetch_assoc()['username'];
        $_SESSION['is_logged_in'] = true;
        header("Location: home.php"); // Redirect to the home page
        exit();
    } else {
        session_start();
        $_SESSION['error_message'] = "Mitarbeiter wurde nicht gefunden.";
        header("Location: /frontend/pages/idLogin.php");
        exit();
    }
}

$conn->close();
?>