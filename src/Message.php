<?php
require_once __DIR__ . '/../connection.php';



class Message {
    private $id;
    private $senderId;
    private $receiverId;
    private $content;
    private $sentDate;
    private $readStatus;
    
    public function __construct($id = 0) {
        if ($id > 0) {
            $this -> id = $id;
        }
        else {
            $this -> id = -1;
        }
        $this->senderId = null;
        $this->receiverId = null;
        $this->content = null;
        $this->sentDate = null;
        $this->readStatus = null;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getSenderId() {
        return $this->senderId;
    }

    public function getReceiverId() {
        return $this->receiverId;
    }

    public function getContent() {
        return $this->content;
    }

    public function getSentDate() {
        return $this->sentDate;
    }

    public function getReadStatus() {
        return $this->readStatus;
    }

    public function setSenderId($senderId) {
        $this->senderId = $senderId;
    }

    public function setReceiverId($receiverId) {
        $this->receiverId = $receiverId;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setSentDate($sentDate) {
        $this->sentDate = $sentDate;
    }

    public function setReadStatus($readStatus) {
        $this->readStatus = $readStatus;
    }
    
    public function saveToDB(PDO $conn) {
        if ($this->id == -1) {
            $stmt = $conn->prepare('INSERT INTO Msgs VALUES (null, :senderId, :receiverId, :content, NOW(), 0)');
            $result = $stmt->execute([
                'senderId' => $this->senderId,
                'receiverId' => $this->receiverId,
                'content' => $this->content,
                ]);
            if ($result !== false) {
                $this->id = $conn->lastInsertId();
            }
        }
        else {
            $stmt = $conn->prepare('UPDATE Msgs SET senderId = :senderId, receiverId = :receiverId, content = :content, readStatus = :readStatus');
            $result = $stmt->execute([
                'senderId' => $this->senderId,
                'receiverId' => $this->receiverId,
                'content' => $this->content,
                'readStatus' => $this->status
            ]);
            return $result;
        }
        return false;
    }
    
    static public function loadMsgsBySender(PDO $conn, $senderId) {
        $result = $conn->query('SELECT * FROM Msgs WHERE senderId = '.$senderId.' ORDER BY sentDate DESC');
        $array = [];
        if ($result != false && $result->rowCount() > 0) {
            $allMsgs = $result ->fetchAll();
            foreach ($allMsgs as $msg) {
                $loadedMsg = new Message($msg['id']);
                $loadedMsg->setSenderId($msg['senderId']);
                $loadedMsg->setReceiverId($msg['receiverId']);
                $loadedMsg->setContent($msg['content']);
                $loadedMsg->setSentDate($msg['sentDate']);
                $loadedMsg->setReadStatus($msg['readStatus']);
                $array[] = $loadedMsg;
            }
            return $array;
        }
        else {
            return false;
        }
    }
    
    static public function loadMsgsByReceiver(PDO $conn, $receiverId) {
        $result = $conn->query('SELECT * FROM Msgs WHERE receiverId = '.$receiverId.' ORDER BY sentDate DESC');
        $array = [];
        if ($result != false && $result->rowCount() > 0) {
            $allMsgs = $result ->fetchAll();
            foreach ($allMsgs as $msg) {
                $loadedMsg = new Message($msg['id']);
                $loadedMsg->setSenderId($msg['senderId']);
                $loadedMsg->setReceiverId($msg['receiverId']);
                $loadedMsg->setContent($msg['content']);
                $loadedMsg->setSentDate($msg['sentDate']);
                $loadedMsg->setReadStatus($msg['readStatus']);
                $array[] = $loadedMsg;
            }
            return $array;
        }
        else {
            return false;
        }
    }
    
    static public function loadMsgById(PDO $conn, $id) {
        $stmt = $conn->query('SELECT * FROM Msgs WHERE id = '.$id);
        $msg = $stmt->fetch();
        $loadedMsg = new Message($msg['id']);
        $loadedMsg->setSenderId($msg['senderId']);
        $loadedMsg->setReceiverId($msg['receiverId']);
        $loadedMsg->setContent($msg['content']);
        $loadedMsg->setSentDate($msg['sentDate']);
        $loadedMsg->setReadStatus($msg['readStatus']);
        return $loadedMsg;
    }
    
    static public function updateReadStatus(PDO $conn, $id) {
        $result = $conn->query('UPDATE Msgs SET readStatus = 1 WHERE id = '.$id);
        if ($result !== false) {
            return true;
        }
        else {
            return false;
        }
    }
    
    static public function countUnreaded(PDO $conn, $receiverId) {
        $stmt = $conn->query('SELECT COUNT(*) FROM `Msgs` WHERE receiverId = '.$receiverId.' AND readStatus = 0');
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    }
    
}
