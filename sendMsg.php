<?php
session_start();
if (!isset ($_SESSION['userId'])) {
    header('Location: index.php'); 
}
require_once __DIR__ . '/src/User.php';
require_once __DIR__ . '/src/Message.php';
require_once __DIR__ . '/connection.php';
include __DIR__ . '/header.php';
    $allUsers = User::loadAllUsers($conn);
    $me = User::loadUserById($conn, $_SESSION['userId']);
    $counter = 0;
    foreach ($allUsers as $user) { //delete logged in user from userlist for select
        
        if ($user->getId() == intval($_SESSION['userId'])) {
            unset ($allUsers[$counter]);
        }
        $counter++;
    }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['text'] != '') {
        $newMsg = new Message;
        $newMsg->setSenderId($_SESSION['userId']);
        $newMsg->setReceiverId($_POST['receiver']);
        $newMsg->setContent($_POST['text']);
        $result = $newMsg->saveToDB($conn);
        if ($result) {
            $_SESSION['msgForNewMsg'] = "Message sent!";
            $_SESSION['SuccessForNewMsg'] = true;
        }
        else {
            $_SESSION['msgForNewMsg'] = "Message cannot be sent :(";
            $_SESSION['SuccessForNewMsg'] = false;
        }
    }    
    else {
        $_SESSION['msgForNewMsg'] = "Message cannot be empty!";
        $_SESSION['SuccessForNewMsg'] = false;
    }
    if (isset($_SESSION['msgForNewMsg']) && ($_SESSION['msgForNewMsg'] != '')) {
        if ($_SESSION['SuccessForNewMsg'] == true) {
            echo '<div class="container"><div class="container">';
            echo '<div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>'.$_SESSION['msgForNewMsg'].'</strong></div>';
            echo '</div></div>';
            unset ($_SESSION['msgForNewMsg']);
            unset ($_SESSION['SuccessForNewMsg']);
        }
        else {
            echo '<div class="container"><div class="container">';
            echo '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>'.$_SESSION['msgForNewMsg'].'</strong></div>';
            echo '</div></div>';
            unset ($_SESSION['msgForNewMsg']);
            unset ($_SESSION['SuccessForNewMsg']);
        }
    }   
}

?>:
    <div class="container">
        <div class="container">
            <div class="panel panel-default">
                <form class="form-horizontal" action="sendMsg.php" method="POST">
                    <fieldset>
                        <legend>New Message</legend>
                        <div class="form-group">
                            <label for="receiver" class="col-lg-2 control-label">Choose user</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="select" name="receiver">
                                        <?php
                                        if (isset ($_GET['sendTo'])) {
                                            $receiverId = intval($_GET['sendTo']);
                                            $username = User::loadUserById($conn, $receiverId);
                                            echo '<option value="'.$receiverId.'">'.$username->getUsername().'</option>';
                                        }
                                        else {    
                                            foreach ($allUsers as $user) {
                                            echo '<option value="'.$user->getId().'">'.$user->getUsername().'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            <label for="textArea" class="col-lg-2 control-label">Write message:</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" rows="2" id="textArea" name="text"></textarea>
                                <span class="help-block">Max 255</span>
                            </div>
                            <div class="col-lg-10 col-lg-offset-2">
                              <button type="submit" class="btn btn-primary">Send!</button>
                            </div>
                        </div>
                    </fieldset>

            </div>    
        </div>
    </div>