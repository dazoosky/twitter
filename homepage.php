<?php
require_once __DIR__ . '/src/Tweet.php';
require_once __DIR__ . '/src/User.php';
require_once __DIR__ . '/src/Comment.php';
require_once __DIR__ . '/connection.php';
$username = User::loadUserById($conn, $_SESSION['userId']);
$username = $username->getUsername();
?>

<div class="jumbotron">
    <h2><?php echo $username ?>, welcome to MyTweeter!</h2>
</div>
<div class="container">
    <div class="container">
        <?php
        if (isset($_SESSION['msgForNewTweet']) && $_SESSION['msgForNewTweet'] != '') {
            if ($_SESSION['SuccessForNewTweet'] == true) {
                echo '<div class="container"><div class="container">';
                echo '<div class="alert alert-dismissible alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>'.$_SESSION['msgForNewTweet'].'</strong></div>';
                echo '</div></div>';
                unset ($_SESSION['msgForNewTweet']);
                unset ($_SESSION['SuccessForNewTweet']);
            }
            else {
                echo '<div class="container"><div class="container">';
                echo '<div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>'.$_SESSION['msgForNewTweet'].'</strong></div>';
                echo '</div></div>';
                unset ($_SESSION['msgForNewTweet']);
                unset ($_SESSION['SuccessForNewTweet']);
            }
        }
        $commentCounter = Comment::countCommentsForAllPosts($conn);
        $alltweets = Tweet::loadAllTweets($conn);
        ?>
            <div class="panel panel-default">
                <form class="form-horizontal" action="addTweet.php" method="POST">
                    <fieldset>
                        <div class="form-group">
                            <label for="tweetText" class="col-lg-2 control-label"><h2>What's up?</h2></label>
                            <div class="col-lg-10">
                                <textarea class="form-control" rows="3" name="tweetText" id="tweetText" maxlength="255"></textarea>
                                <span class="help-block">Max lenght 255 chars.</span>
                                <button type="submit" class="btn btn-primary">Add my tweet!</button>
                            </div>                    
                        </div>
                    </fieldset>
                </form>
            </div>
        <?php
        foreach ($alltweets as $tweet) {
            $userId = $tweet->getUserId();
            $user = User::loadUserById($conn, $userId);
            $username = $user->getUsername();
            echo '<div class="panel panel-default"><div class="panel-body">';
            echo $tweet->getText();
            echo '</div><div class="panel-footer"> by <a href="user.php?userId='.$userId.'">'.$username.'</a> on '.$tweet->getCreationdate().'</div>';
            echo '<div class="panel-footer"><a href="tweet.php?tweetId='.$tweet->getId().'">'.$commentCounter[$tweet->getId()].' Komentarzy</a></div></div>';
        }
        ?>
        
    </div>
     
</div>