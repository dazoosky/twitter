<?php
session_start();
if(isset($_SESSION['userId'])) {
    header('Location: index.php');
}
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userName = trim($_POST['username']);
    $userEmail = trim($_POST['email']);
    $userPassword = trim($_POST['password']);
    
    require_once __DIR__ . '/src/User.php';
    require_once __DIR__ . '/connection.php';
    
    $newUser = new User();
    $newUser->setUsername($userName);
    $newUser->setEmail($userEmail);
    $newUser->setPassword($userPassword);
    $result = $newUser->saveToDB($conn);
    if($result) {
        header('Location: index.php');
    } else {
        echo 'Nieprawidłowe dane do rejestracji';
    }
    
}
?>

<form method="POST">
    username
    <input type="text" name="username">
    <br>
    e-mail
    <input type="text" name="email">
    <br>
    password
    <input type="password" name="password">
    <br>
    <input type="submit" value="Register">
</form>