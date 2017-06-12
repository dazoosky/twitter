<?php
session_start();
if (!isset ($_SESSION['userId'])) {
    header('Location: index.php'); 
}
//require_once __DIR__ . '/src/User.php';
//require_once __DIR__ . '/src/Message.php';
require_once __DIR__ . '/connection.php';
function __autoload($classname) {
    $filename = './src/'.$classname.'.php';
    require_once ($filename);
}
include __DIR__ . '/header.php';
$msgToShow = Message::loadMsgById($conn, $_GET['msgId']);
if ($msgToShow->getReceiverId() != intval($_SESSION['userId'])) { //secure for unautorized access to msg
    echo '<div class="container"><div class="container">'."You're not receiver nor sender of "
            . "this message. Please log in".'</div></div>';
    return false;
}
?>
<div class="container">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php echo 'User '.User::loadUserById($conn, $msgToShow->getSenderId())->getUsername().' wrote:';?>
            </div>
            <div class="panel-footer">
                <?php echo $msgToShow->getContent(); ?>
                
            </div>
            <div class="panel-footer">
                <?php echo 'Sent on: '.$msgToShow->getSentDate();
                
                if ($msgToShow->getReadStatus() == 0) {
                    $msgToShow->setReadStatus(1);
                $msgToShow->saveToDB($conn);
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
include __DIR__ . '/footer.php';