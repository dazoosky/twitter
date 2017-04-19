<?php
session_start();
require __DIR__ . '/src/Comment.php';
require __DIR__ . '/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);
    $message = '';
    if (isset($_POST['commentText']) && isset($_POST['tweetId'])) {
        if (strlen($_POST['commentText']) <= 120) {
            $newComment = new Comment;
            $newComment->setContent($_POST['commentText']);
            $newComment->setTweetId($_POST['tweetId']);
            $newComment->setAuthorId($_SESSION['userId']);
            $result = $newComment->saveToDB($conn);
            if ($result == true) {
                $_SESSION['msgForNewComment'] = "Dodano komentarz";
                $_SESSION['SuccessForNewComment'] = true;
                header ("Location: tweet.php?tweetId=".$_POST['tweetId']);
            }
            else {
                $_SESSION['msgForNewComment'] = "Coś jest nie tak z Twoim komentarzem :(";
                $_SESSION['SuccessForNewComment'] = false;
                header ("Location: tweet.php?tweetId=".$_POST['tweetId']);
                
            }   
        }
    }
    else {
        $_SESSION['msgForNewComment'] = "Coś jest nie tak z Twoim komentarzem :(";
        header ("Location: tweet.php?tweetId=".$_POST['tweetId']);
        $_SESSION['SuccessForNewComment'] = false;
    }
}