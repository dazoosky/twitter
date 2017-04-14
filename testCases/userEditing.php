<?php
require __DIR__ . '/../src/User.php';
require __DIR__ . '/../src/UserExtended.php';
require __DIR__ . '/../connection.php';

$user1 = UserExtended::loadMoreAboutUser($conn, 2);
var_dump($user1);


