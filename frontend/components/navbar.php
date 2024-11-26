<?php
include "..\components\header.php";
?>

<nav class="nav-extended">
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">Timetracking</a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="#test1">Test1</a></li>
            <li><a href="#about-us">Über uns</a></li>
            <li><a href="#github">GitHub</a></li>
        </ul>
    </div>
    <div class="nav-content">
        <ul class="tabs tabs-transparent center-align"> <li class="tab"><a href="#home">Startseite</a></li>
            <li class="tab"><a href="#timetracking">Zeiterfassung</a></li>
            <li class="tab"><a href="#test">Test</a></li>
            <li class="tab"><a href="#logout">Abmelden</a></li>
        </ul>
    </div>
</nav>

<ul class="sidenav" id="mobile-demo">
    <li><a href="#test1">Test1</a></li>
    <li><a href="#about-us">Über uns</a></li>
    <li><a href="https://github.com/plaxxo/timetrackerV2">GitHub</a></li>
</ul>
