<?php
    session_start();
    session_destroy();
    header("Location: ../frontend/pages/idLoginPage.php");
    exit();
?>