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
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();

    if ($result->num_rows > 0) {
        // Successful login
        session_start();
        $_SESSION['user_id'] = $result->fetch_assoc()['id']; // Assuming you have a user ID
        $_SESSION['username'] = $username;
        $_SESSION['is_logged_in'] = true;
        header("Location: home.php"); // Redirect to the home page
        exit();
    } else {
        session_start();
        $_SESSION['error_message'] = "Benutzername oder Passwort nicht gefunden";
        header("Location: /frontend/pages/userLogin.php");
        exit();
    }
}

$conn->close();
?>