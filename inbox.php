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
                <h2>Inbox</h2>
            </div>
            <div class="panel-footer">
                <table class="table table-striped table-hover ">
                    <thead>
                      <tr>
                        <th>Send by</th>
                        <th>on</th>
                        <th>Content</th>
                        <th>Did I see it?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $allMsg = Message::loadMsgsByReceiver($conn, $_SESSION['userId']);
                        if ($allMsg !== false) {
                            foreach ($allMsg as $msg) {
                                if ($msg->getReadStatus() == false) {
                                    $readStatus = 'Nope';
                                }
                                else {
                                    $readStatus = 'Yep';
                                }
                                echo '<tr>';
                                echo '<td>'.UserExtended::loadUserById($conn, $msg->getSenderId())->getUsername().'</td>';
                                echo '<td>'.$msg->getSentDate().'</td>';
                                echo '<td>';
                                $msgcontent=$msg->getContent();
                                if (strlen($msgcontent)>28) {
                                    echo '<a href="showMsg.php?msgId='.$msg->getId().'">'.substr($msgcontent,0,28).'...</a>';
                                }
                                else {
                                    echo '<a href="showMsg.php?msgId='.$msg->getId().'">'.$msgcontent.'...</a>';
                                }
                                echo '</td>';
                                echo '<td>'.$readStatus.'</td></tr>';
                            }
                        }
                        else {
                            echo '<tr><td>No messages to show<td></tr>';
                        }    
                        ?>
                        
                    </tbody>
                </table>
            </div>
    </div>
</div>

    
    
    <?php
include __DIR__ . '/footer.php';
