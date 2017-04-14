<?php
require __DIR__ . '/../src/Tweet.php';
require __DIR__ . '/../connection.php';


$load = Tweet::loadTweetById($conn, 1);

var_dump($load);

$load->setText("Lorem ipsum ipsum lorem dolores majonez");
$load->saveToDB($conn);

$alltweets = Tweet::loadAllTweets($conn);
var_dump($alltweets);