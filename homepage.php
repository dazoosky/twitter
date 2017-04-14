<?php

require_once __DIR__ . '/src/Tweet.php';
require_once __DIR__ . '/src/User.php';
require_once __DIR__ . '/connection.php';
?>

<div class="jumbotron">
<h2>Witaj na MyTweeter!</h2>
</div>
<div class="container">
    <div class="container">
        <?php 
        $alltweets = Tweet::loadAllTweets($conn);
        foreach ($alltweets as $tweet) {
            $userId = $tweet->getUserId();
            $user = User::loadUserById($conn, $userId);
            $username = $user->getUsername();
            echo '<div class="panel panel-default"><div class="panel-body">';
            echo $tweet->getText();
            echo '</div><div class="panel-footer"> by <a href="user.php?userId='.$userId.'">'.$username.'</a></div></div>';
        }
        ?>
        
    </div>
     
</div>