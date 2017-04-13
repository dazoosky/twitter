<?php
require __DIR__ . '/../src/User.php';

$user1 = User::loadUserById($conn, 1);
var_dump($user1);


