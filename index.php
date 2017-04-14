<?php
session_start();
include __DIR__ . '/header.php';
if(!isset($_SESSION['userId'])) {
    //header('Location: login.php');
    include __DIR__ . '/login.php';
} else {
    include __DIR__ . '/homepage.php';
    /*echo 'Jesteś zalogowany<br>';
    echo $_SESSION['userId'];
    echo '<br>';
    echo "<a href='logout.php'>Wyloguj</a>";*/
}
include __DIR__ . '/footer.php';