<?php

require_once 'config.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../frontend/pages/userLoginPage.php");
    exit();
}

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $email = $_POST['email'];


    $stmt = $conn->prepare("UPDATE users SET name=?, surname=?, username=?, email=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $surname, $username, $email, $_SESSION['user_id']);

    if ($stmt->execute()) {
        $_SESSION['name'] = $name;
        $_SESSION['surname'] = $surname;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;

        $_SESSION['success_message'] = "Profil erfolgreich aktualisiert.";

        header("Location: ../frontend/pages/profilPage.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Profil konnte nicht aktualisiert werden.";
    }

    $stmt->close();
}

$conn->close();