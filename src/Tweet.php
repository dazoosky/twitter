<?php
require_once __DIR__ . '/../connection.php';

class Tweet {
    private $id;
    private $userId;
    private $text;
    private $creationdate;
    
    public function __construct() {
        $this->id = -1;
        $this->userId = null;
        $this->text = null;
        $this->creationdate = null;
    }
    
    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function setCreationdate($creationdate) {
        $this->creationdate = $creationdate;
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getText() {
        return $this->text;
    }

    public function getCreationdate() {
        return $this->creationdate;
    }
    
    public function saveToDB(PDO $conn) {
        if($this->id == -1) {
            $userId = $_SESSION['userId'];
            $stmt = $conn->prepare('INSERT INTO Tweets(userId, text, creationDate) '
                    . 'VALUES (:userId, :test, NOW())');
            
            $result = $stmt->execute([ 
                'userId' => $userId, 
                'text'=> $this->text]);
            
            if ($result !== false) {
                $this->id = $conn->lastInsertId();
                return true;
            }
        } else {
            $stmt = $conn->prepare('UPDATE Tweets '
                    . 'SET text = :text, '
                    . 'creationDate=NOW() WHERE id=:id');
            
            $result = $stmt->execute([ 
                'id' => $this->id, 
                'text' => $this->text]);
            
            return $result;
        }
        
        return false;
    }
    
    static public function loadTweetById(PDO $conn, $id) {
        $stmt = $conn->prepare('SELECT * FROM Tweets WHERE id=:id');
        $result = $stmt->execute(['id' => $id]);
        
        if ($result === true && $stmt->rowCount() == 1) {
            $row = $stmt->fetch();
            
            $loadedTweet = new Tweet();
            $loadedTweet->id = $row['id'];
            $loadedTweet->setText($row['text']);
            $loadedTweet->setCreationdate($row['creationDate']);           
            return $loadedTweet;
        }
    }
    static public function loadTweetsByUserId(PDO $conn, $userId) {
        $result = $conn->query('SELECT * FROM Tweets');
        $array = [];
                
        if ($result != false && $result->rowCount() > 0) {
            $allTweets = $result->fetchAll();
            foreach ($allTweets as $row) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->setText($row['text']);
                $loadedTweet->setCreationdate($row['creationDate']);
                
                $array[] = $loadedTweet;
            }
            return $array;
        }
        else {
            return false;
        }
    }
    static public function loadAllTweets(PDO $conn) {
        $result = $conn->query('SELECT * FROM `Tweets`');
        return $result;
    }

    
    
    
}