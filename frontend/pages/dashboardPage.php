<?php
include "..\components\header.php";
include "../components/navbar.php";


date_default_timezone_set('Europe/Berlin');
$hour = date('G');
if ($hour >= 6 && $hour < 11) {
    $greeting = "Guten Morgen";
} elseif ($hour >= 11 && $hour < 18) {
    $greeting = "Guten Tag";
} else {
    $greeting = "Guten Abend";
}
?>

<div class="container">
    <div class="row">
        <div class="col s2"></div>
        <div class="col s8">

            <div class="card grey lighten-4">
                <div class="card-content">
                    <div style="display: flex; justify-content: space-between;">
                        <span class="card-title"><?= $greeting ?>
                            <?php
                            if (isset($_SESSION['surname'])): ?>
                                <?= $_SESSION['surname'] ?>
                            <?php endif; ?>
                            </span>
                        <span class="card-title" id="current-time"></span>
                        <script>
                            function updateTime() {
                                const now = new Date();

                                const day = now.getDate().toString().padStart(2, '0');
                                const month = (now.getMonth() + 1).toString().padStart(2, '0');
                                const year = now.getFullYear();

                                const hours = now.getHours().toString().padStart(2, '0');
                                const minutes = now.getMinutes().toString().padStart(2, '0');
                                const seconds = now.getSeconds().toString().padStart(2, '0');

                                const dateString = `${day}.${month}.${year}`;
                                const timeString = `${hours}:${minutes}:${seconds}`;

                                document.getElementById('current-time').textContent = `${dateString} ` + ` -` +` ${timeString}`;
                            }

                            setInterval(updateTime, 1000);
                        </script>
                    </div>
                    <blockquote>
                        Deine Arbeitszeiten im Blick! Starte jetzt einen neuen Eintrag oder sieh dir deine bisherigen Arbeitszeiten an.
                    </blockquote>
                </div>
            </div>

            <div class="row">
                <div class="col s4">
                    <div class="card-deck">
                        <div class="card hoverable green lighten-3" onclick="location.href='../../src/checkIn.php';"
                            style="cursor: pointer;">
                            <div class="card-content">
                                <span class="card-title">Check In</span>
                                <p>Starte deine Schicht.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s4">
                        <div class="card-deck">
                            <div class="card grey lighten-4">
                                <div class="card-content">
                                    <span class="card-title">Verbleibende Zeit</span>
                                    <p></p>
                                    <p>Heute: <?= $_SESSION['hours_left_today'] ?> Stunden</p>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col s4">
                    <div class="card-deck">
                        <div class="card hoverable red lighten-3" onclick="location.href='../../src/checkOut.php';"
                            style="cursor: pointer;">
                            <div class="card-content">
                                <span class="card-title">Check Out</span>
                                <p>Beende deine Schicht.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s2"></div>
    </div>
</div>