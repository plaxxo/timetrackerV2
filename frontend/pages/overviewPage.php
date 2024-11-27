<?php
include "..\components\header.php";
include "../components/navbar.php";

require_once '../../src/config.php';

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Benutzer-ID aus der Anfrage abrufen (Beispiel)
$userId = 2;

// Abfrage ausführen
$ergebnis = $db->query("SELECT * FROM time_entries WHERE user_id = $userId");




?>


<div class="container">
    <div class="row">
        <div class="col s2"></div>
        <div class="col s8">
<table class="striped highlight">
    <thead>
    <tr>
        <th>Datum</th>
        <th>Check In</th>
        <th>Check Out</th>
        <th>Gesamtzeit</th>
    </tr>
    </thead>
    <tbody>
    <?php
        if ($ergebnis->num_rows > 0) {
            while ($zeile = $ergebnis->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $zeile['date'] . "</td>";
                echo "<td>" . date('H:i:s', strtotime($zeile['clock_in'])) . "</td>";
                echo "<td>" . date('H:i:s', strtotime($zeile['clock_out'])) . "</td>";

                $clock_in = strtotime($zeile['clock_in']);
                $clock_out = strtotime($zeile['clock_out']);
                $time_diff = $clock_out - $clock_in;
                $hours = round($time_diff / 3600, 2); // Calculate hours with 2 decimal places

                echo "<td>" . $hours . "</td>";
                echo "</tr>";
            }
        }
    ?>

    </tbody>
</table>
<div class="col s2"></div>
</div></div>