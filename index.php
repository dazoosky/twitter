<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Welcome to MyTweeter!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   
  </head>
  <body></body>
<?php
session_start();
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
?>

  </body>
</html>