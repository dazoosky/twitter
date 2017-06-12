<?php
session_start();
//require_once __DIR__ . '/src/UserExtended.php';
//require_once __DIR__ . '/src/Tweet.php';
//require_once __DIR__ . '/src/Comment.php';
require_once __DIR__ . '/connection.php';
function __autoload($classname) {
    $filename = './src/'.$classname.'.php';
    require_once ($filename);
}
include_once __DIR__ . '/header.php';

echo '<div class="container"><div class="container">';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset ($_GET['userId'])) {
        $userId = intval($_GET['userId']);
        $user = UserExtended::loadMoreAboutUser($conn, $userId);
        if ($user != null) {
            //var_dump($user);
            echo '<div class="panel panel-default"><div class="panel-body">';
            echo '<h2>Profil użytkownia: '.$user->getUsername().'</h2>';
            echo '</div><div class="panel-footer"><ul>';
            echo '<li>Więcej o użytkowniku:<br>'.$user->getAboutMe().'</li>';
            echo '<li>Wiek: '.$user->getAge().'</li>';
            echo '<li>Adres e-mail: '.$user->getEmail().'</li>';
            if (intval($_SESSION['userId']) != $user->getId()) {
            echo '<li><a href="sendMsg.php?sendTo='.$userId.'">Wyślij wiadomość do '.$user->getUsername().'</a></li>';
            }
            echo '</ul></div></div>';
            $commentCounter = Comment::countCommentsForAllPosts($conn);
            $alltweets = Tweet::loadTweetsByUserId($conn, intval($_GET['userId']));
            echo '<div class="panel panel-default"><div class="panel-body"><h2>Tweety tego użytkownika:</h2></div>';
            foreach ($alltweets as $tweet) {
                $userId = $tweet->getUserId();
                $user = User::loadUserById($conn, $userId);
                $username = $user->getUsername();
                echo '<div class="panel panel-default"><div class="panel-body">';
                echo $tweet->getText();
                echo '</div><div class="panel-footer"> by <a href="user.php?userId='.$userId.'">'.$username.'</a> on '.$tweet->getCreationdate().'</div>';
                echo '<div class="panel-footer"><a href="tweet.php?tweetId='.$tweet->getId().'">'.$commentCounter[$tweet->getId()].' Komentarzy</a></div></div>';
            }
        
        }
        else {
            echo 'Błedne ID użytkownika <br><a href="index.php">Wróc na stronę główną</a>';
        }
    }
}
echo '</div></div>';
include __DIR__ . '/footer.php';