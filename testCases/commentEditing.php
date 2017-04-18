
<?php
require __DIR__ . '/../src/Comment.php';
require __DIR__ . '/../connection.php';
/*
$comm1 = new Comment(0);
$comm1->setAuthorId(1);
$comm1->setTweetId(1);
$comm1->setContent('test comment 3');
var_dump($comm1);
//$comm1->saveToDB($conn);
*/
Comment::countCommentsForAllPosts($conn);