<?php
session_start();
require __DIR__ . '/connection.php';
function __autoload($classname) {
    $filename = './src/'.$classname.'.php';
    require_once ($filename);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //var_dump($_POST);
    $message = '';
    if (isset($_POST['tweetText']) && isset($_SESSION['userId'])) {
        if (strlen($_POST['tweetText']) <= 255) {
            $newTweet = new Tweet;
            $newTweet->setText($_POST['tweetText']);
            $newTweet->setUserId($_SESSION['userId']);
            $result = $newTweet->saveToDB($conn);
            if ($result == true) {
                $_SESSION['msgForNewTweet'] = "Dodano post!";
                $_SESSION['SuccessForNewTweet'] = true;
                header ("Location: index.php");
            }
            else {
                $_SESSION['msgForNewTweet'] = "Coś jest nie tak z Twoim nowym Tweetem :(";
                $_SESSION['SuccessForNewTweet'] = false;
                header ("Location: index.php");
                
            }   
        }
    }
    else {
        $_SESSION['msgForNewTweet'] = "Coś jest nie tak z Twoim nowym Tweetem :(";
        $_SESSION['SuccessForNewTweet'] = false;
        header ("Location: index.php");
    }
}