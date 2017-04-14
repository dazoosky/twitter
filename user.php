<?php
include __DIR__ . '/header.php';
require_once __DIR__ . '/src/UserExtended.php';
require_once __DIR__ . '/connection.php';

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
            echo '<li><a href="sendMsg.php?sentTo='.$userId.'">Wyślij wiadomość do '.$user->getUsername().'</a></li></ul></div></div>';
        }
        else {
            echo 'Błedne ID użytkownika <br><a href="index.php">Wróc na stronę główną</a>';
        }
    }
}
echo '</div></div>';
include __DIR__ . '/footer.php';