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
                <?php
                $weeks = [];
                while ($zeile = $ergebnis->fetch_assoc()) {
                    $weekNumber = date('W', strtotime($zeile['date']));
                    if (!isset($weeks[$weekNumber])) {
                        $weeks[$weekNumber] = [];
                    }
                    $weeks[$weekNumber][] = $zeile;
                }

                foreach ($weeks as $weekNumber => $weekData) {
                    $totalWeeklyHours = 0;
                    foreach ($weekData as $zeile) {
                        $clock_in = strtotime($zeile['clock_in']);
                        $clock_out = strtotime($zeile['clock_out']);
                        $time_diff = $clock_out - $clock_in;
                        $hours = round($time_diff / 3600, 2);
                        $totalWeeklyHours += $hours;
                    }

                    echo '<div class="card grey lighten-2">';
                    echo '<div class="card-content black-text">';
                    echo '<span class="card-title">Zeiterfassung Woche ' . $weekNumber . ' ('.$totalWeeklyHours.' Stunden)</span>';
                    echo '</div>';
                    echo '<table class="striped highlight">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Datum</th>';
                    echo '<th>Check In</th>';
                    echo '<th>Check Out</th>';
                    echo '<th>Gesamtzeit</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    foreach ($weekData as $zeile) {
                        echo "<tr>";

                        $date = date('d.m.Y', strtotime($zeile['date']));
                        $weekday = strftime('%A', strtotime($zeile['date']));
                        $weekday_german = [
                            'Sunday' => 'Sonntag',
                            'Monday' => 'Montag',
                            'Tuesday' => 'Dienstag',
                            'Wednesday' => 'Mittwoch',
                            'Thursday' => 'Donnerstag',
                            'Friday' => 'Freitag',
                            'Saturday' => 'Samstag',
                        ];
                        $germanWeekday = $weekday_german[$weekday];
                        echo "<td>" . $germanWeekday . ", " . $date . "</td>";


                        echo "<td>" . date('H:i:s', strtotime($zeile['clock_in'])) . "</td>";
                        echo "<td>" . date('H:i:s', strtotime($zeile['clock_out'])) . "</td>";

                        $clock_in = strtotime($zeile['clock_in']);
                        $clock_out = strtotime($zeile['clock_out']);
                        $time_diff = $clock_out - $clock_in;
                        $hours = round($time_diff / 3600, 2);

                        echo "<td>" . $hours . "</td>";
                        echo "</tr>";
                    }

                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                }
                ?>
    <div class="col s2"></div>
</div></div>