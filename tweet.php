<?php
session_start();
include __DIR__ . '/header.php';
//require_once __DIR__ . '/src/UserExtended.php';
//require_once __DIR__ . '/src/Tweet.php';
//require_once __DIR__ . '/src/Comment.php';
require_once __DIR__ . '/connection.php';
function __autoload($classname) {
    $filename = './src/'.$classname.'.php';
    require_once ($filename);
}

if (isset($_SESSION['msgForNewComment']) && $_SESSION['msgForNewComment'] != '') {
    if ($_SESSION['SuccessForNewComment'] == true) {
        echo '<div class="container"><div class="container">';
        echo '<div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>'.$_SESSION['msgForNewComment'].'</strong></div>';
        echo '</div></div>';
        unset ($_SESSION['msgForNewComment']);
        unset ($_SESSION['SuccessForNewComment']);
    }
    else {
        echo '<div class="container"><div class="container">';
        echo '<div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>'.$_SESSION['msgForNewComment'].'</strong></div>';
        echo '</div></div>';
        unset ($_SESSION['msgForNewComment']);
        unset ($_SESSION['SuccessForNewComment']);
    }
}


echo '<div class="container"><div class="container">';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset ($_GET['tweetId'])) {
        $tweetId = intval($_GET['tweetId']);
        $tweet = Tweet::loadTweetById($conn, $tweetId);
        $allComments = Comment::loadCommentsByTweetId($conn, $tweetId);
        if ($tweet != null) {
            $author = User::loadUserById($conn, $tweet->getUserId());
            $authorName = $author->getUsername();
            echo '<div class="panel panel-default"><div class="panel-body">';
            echo '<h2>'.$authorName.' said:</h2>';
            echo '</div><div class="panel-footer"><h3>';
            echo $tweet->getText();
            echo '</h3></div><div class="panel-footer">on '.$tweet->getCreationdate();
            echo '</div></div>';
            
            if ($allComments != null) {
                echo '<div class="panel panel-default"><div class="panel-body"><h2>Comments:</h2></div>';
                foreach ($allComments as $comment) {
                    $commentAuthor = User::loadUserById($conn, $comment->getAuthorId());
                    echo '<div class="panel-footer"><b>';
                    echo '<a href="user.php?userId='.$commentAuthor->getId().'">';
                    echo $commentAuthor->getUsername().'</a></b> comment:<br><p class="lead">'.$comment->getContent().'</p><br>on '.$comment->getCreateDate();
                    echo '</div>';
                    }
            }
            else {
                echo '<div class="panel panel-default"><div class="panel-body"><h3>No comments yet.</h3></div></div>';
            }
            ?>  
                    </div><br>
                    <div class="panel panel-default">
                    <form class="form-horizontal" action="addComment.php" method="POST">
                    <fieldset>
                    <div class="form-group">
                    <input type="hidden" name="tweetId" value="<?php echo $tweetId?>" />    
                    <label for="commentText" class="col-lg-2 control-label">Your comment:</label>
                    <div class="col-lg-10">
                    <textarea class="form-control" rows="2" name="commentText" id="commentText" maxlength="60"></textarea>
                    <span class="help-block">Max lenght 60 chars.</span>
                    <button type="submit" class="btn btn-primary">Add!</button>
                    </div>                    
                    </div>
                    </fieldset>
                    </form></div>
                <?php
            echo '<div>';
        }
        else {
            echo 'Błedne ID postu <br><a href="index.php">Wróc na stronę główną</a>';
        }
    }
}
echo '</div></div>';
include __DIR__ . '/footer.php';
