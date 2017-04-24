<?php
session_start();
include __DIR__ . '/header.php';
require_once __DIR__ . '/src/UserExtended.php';
require_once __DIR__ . '/src/Message.php';
require_once __DIR__ . '/connection.php';

?>
<div class="container">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <h2>Messages</h2>
            </div>
            <div class="panel-footer">
                <ul>
                    <li><a href="inbox.php">Inbox (<?php echo Message::countUnreaded($conn, $_SESSION['userId'])?>)</a></li>
                    <li><a href="outbox.php">Sent items</a></li>
                    <li><a href="sendMsg.php">New message</a></li>
                </ul>
            </div>
    </div>
</div>
<?php
include __DIR__ . '/footer.php';



