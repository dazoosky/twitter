<?php
session_start();
require_once __DIR__ . '/connection.php';
function __autoload($classname) {
    $filename = './src/'.$classname.'.php';
    require_once ($filename);
}
include_once __DIR__ . '/header.php';

echo '<div class="container"><div class="container">';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset ($_SESSION['userId'])) {
        $userId = intval($_SESSION['userId']);
        $user = UserExtended::loadMoreAboutUser($conn, $userId);
        if ($user != null) {
            //var_dump($user);
            echo '<div class="panel panel-default"><div class="panel-body">';
            echo '<h2>Moj profil:</h2>';
            echo '</div><div class="panel-footer">';
            ?>
            <form action="updateUser.php" method="post">
                O mnie:<br>
                <textarea name="about" id="about" cols="50" rows="2"><?php echo $user->getAboutMe()?></textarea><br>
                Wiek:<br>
                <input type="number" name="age" id="age" min="0" step="1" value="<?php echo $user->getAge() ?>"></input><br>
                Email:<br>
                <input type="email" name="email" id="email" value="<?php echo $user->getEmail() ?>"></input><br><br>
                <b><input type="checkbox" name="changePassword" id="changePassword"></checkbox>Zmiana hasła:</b><br>
                Stare hasło:<input class="password" readonly="readonly" type="password" name="oldPassword" id="oldPassword"></input><br>
                Nowe hasło:<input class="password" readonly="readonly" type="password" name="newPassword1" id="newPassword1"></input><br>
                Potw. nowe hasło:<input class="password" readonly="readonly" type="password" name="newPassword2" id="newPassword2"></input><br>
                <input type="submit" value="Zapisz!"></input>
                
            </form>
            
<?php            
//            echo '<li>Więcej o użytkowniku:<br>'.$user->getAboutMe().'</li>';
//            echo '<li>Wiek: '.$user->getAge().'</li>';
//            echo '<li>Adres e-mail: '.$user->getEmail().'</li>';
//            if (intval($_SESSION['userId']) != $user->getId()) {
//            echo '<li><a href="sendMsg.php?sendTo='.$userId.'">Wyślij wiadomość do '.$user->getUsername().'</a></li>';
//            }
            echo '</ul></div></div>';
            $commentCounter = Comment::countCommentsForAllPosts($conn);
            $alltweets = Tweet::loadTweetsByUserId($conn, intval($_SESSION['userId']));
            echo '<div class="panel panel-default"><div class="panel-body"><h2>My posts:</h2></div>';
            if (isset($tweet)) {
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
                echo '<div class="panel panel-default"><div class="panel-body">';
                echo '</div></div>';
            }
        
        }
        else {
            echo 'Błedne ID użytkownika <br><a href="index.php">Wróc na stronę główną</a>';
        }
    }
}
echo '</div></div>';
include __DIR__ . '/footer.php';
?>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="js/disablePassForm.js"></script>