
<nav>
<div class="container">
    <div class="row">
        <div class="col s2"></div>
        <div class="col s8">
            <div class="nav-wrapper">
                <a href="#" class="brand-logo">
                    <img id="logo" src="../dat/logo.png" alt="Logo" style="height: 50px; vertical-align: middle;">
                    Timetracker</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="../pages/dashboardPage.php">Dashboard</a></li>
                    <li><a href="../pages/overviewPage.php">Übersicht</a></li>
                    <li><a href="../pages/profilPage.php"
                           class="<?php if (isset($_SESSION['is_checked_in'])) {
                                    if ($_SESSION['is_checked_in'] === true) {
                                    echo 'green';
                                     } else {
                                        echo 'red';
                                    }
                                }?>">
                            <i class="material-icons">account_circle</i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col s2"></div>
    </div>
</div>
</nav>