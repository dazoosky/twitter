<?php
session_start();
if(isset($_SESSION['userId'])) {
    unset($_SESSION['userId']);
    unset($_SESSION['username']);
    header('Location: login.php');
}