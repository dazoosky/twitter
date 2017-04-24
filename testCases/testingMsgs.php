<?php
require __DIR__ . '/../src/Message.php';
require __DIR__ . '/../connection.php';

/*
$msg = new Message();
$msg->setSenderId(2);
$msg->setRecieverId(1);
$msg->setContent('New msg no. 2');
$msg->saveToDB($conn);
*/
$msg = Message::loadMsgById($conn, 2);
var_dump($msg);

echo Message::countUnreaded($conn, 1);