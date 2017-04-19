<?php
require_once __DIR__ . '/../connection.php';


class Comment {
    private $id;
    private $tweetId;
    private $authorId;
    private $content;
    private $createDate;
    
    public function __construct($id = 0) {
        if ($id > 0) {
            $this->id = $id;
        }
        else {
            $this->id = -1;
        }
        $this->tweetId = null;
        $this->authorId = null;
        $this->content = null;
        $this->createDate = null;
    }
    public function getId() {
        return $this->id;
    }

    public function getTweetId() {
        return $this->tweetId;
    }

    public function getAuthorId() {
        return $this->authorId;
    }

    public function getContent() {
        return $this->content;
    }

    public function getCreateDate() {
        return $this->createDate;
    }

    public function setTweetId($tweetId) {
        $this->tweetId = $tweetId;
    }

    public function setAuthorId($authorId) {
        $this->authorId = $authorId;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setCreateDate($createDate) {
        $this->createDate = $createDate;
    }

    public function saveToDB(PDO $conn) {
        if ($this->id == -1) {
            $stmt = $conn->prepare('INSERT INTO Comments (`id`, `tweetId`, `authorId`, `content`, `createDate`) VALUES (null, :tweetId, :authorId, :content, NOW())');
            $result = $stmt->execute(['tweetId' => $this->tweetId, 
                'authorId' => $this->authorId, 
                'content' => $this->content]);
            if ($result !== false) {
                $this->id = $conn->lastInsertId();
                return true;
            }
        }
        else {
            $stmt = $conn->prepare('UPDATE Comments SET content = :content WHERE id = :id');
            $result = $stmt->execute(['content'=>$this->content, 'id'=>$this->id]);
            return $result;
        }
        return false;
    }
    
    static public function loadCommentsByTweetId(PDO $conn, $tweetId) {
        $result = $conn->query('SELECT * FROM Comments WHERE tweetId = '.$tweetId.' ORDER BY createDate DESC');
        $array = [];
        if ($result != false && $result->rowCount() > 0) {
            $allComments = $result->fetchAll();
            foreach ($allComments as $row) {
                $loadedComment = new Comment($row['id']);
                $loadedComment->setAuthorId($row['authorId']);
                $loadedComment->setTweetId($row['tweetId']);
                $loadedComment->setContent($row['content']);
                $loadedComment->setCreateDate($row['createDate']);
                $array[]=$loadedComment;
            }
            return $array;
        }
        else {
            return false;
        }
    }
    static public function countCommentsForAllPosts(PDO $conn) {
        $counted = $conn->query('SELECT Tweets.id, COUNT(Comments.tweetId) AS comment_counter FROM Tweets LEFT JOIN Comments ON Tweets.id = Comments.tweetId GROUP BY Tweets.id');
        $result = $counted->fetchAll(PDO::FETCH_KEY_PAIR);
        return $result;
    }
    static public function countCommentsForSelectPost(PDO $conn, $tweetId) {
        $counted = $conn->query('SELECT tweetId, COUNT(*) AS comment_count FROM Comments WHERE tweetId = '.$tweetId);
        $result = $counted->fetch();
        var_dump($result);
        return $result;
    }
    
    
}
