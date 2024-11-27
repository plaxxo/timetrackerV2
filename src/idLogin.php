<?php
require_once 'config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeID = $_POST["employeeID"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE employeeID = ?");
    $stmt->bind_param("s", $employeeID);
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();

    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['surname'] = $row['surname'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['employeeId'] = $row['employeeId'];
        $_SESSION['is_logged_in'] = true;

        $total_time_today = 0;
        $stmt2 = $conn->prepare("SELECT clock_in, clock_out FROM time_entries WHERE user_id = ? AND DATE(clock_in) = CURDATE()");
        $stmt2->bind_param("i", $_SESSION['user_id']);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        while ($row2 = $result2->fetch_assoc()) {
            $clock_in = strtotime($row2['clock_in']);
            $clock_out = $row2['clock_out'] ? strtotime($row2['clock_out']) : time();
            $time_diff = $clock_out - $clock_in;
            $total_time_today += $time_diff;
        }

        $hours = round($total_time_today / 3600, 2);
        $_SESSION['hours_left_today'] = 8 - $hours;

        if ($result2->num_rows > 0) {
            $_SESSION['is_checked_in'] = true;
        } else {
            $_SESSION['is_checked_in'] = false;
        }

        header("Location: ../frontend/pages/dashboardPage.php");
        exit();
    } else {
        session_start();
        $_SESSION['error_message'] = "Mitarbeiter wurde nicht gefunden.";
        header("Location: /frontend/pages/idLoginPage.php");
        exit();
    }
}

$conn->close();
?>