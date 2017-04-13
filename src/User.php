<?php
require_once __DIR__ . '/../connection.php';

class User 
{
    private $id;
    private $username;
    private $email;
    private $hashPass;
    
    /*
     * store connection in class static attribute 
     * 
    static public $conn;
    
    static public function setConnection(PDO $conn) {
        self::$conn = $conn;
    }
    */
    
    public function __construct() {
        $this->id = -1;
        $this->username = '';
        $this->email = '';
        $this->hashPass = '';
    }
    
    public function getId() {
        return $this->id;
    }
    public function getUsername() {
        return $this->username;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getHashPass() {
        return $this->hashPass;
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setHashPass($hashPass) {
        $this->hashPass = $hashPass;
    }
    
    public function setPassword($password) {
        $this->hashPass = password_hash($password, PASSWORD_BCRYPT);
        
    }
    
    public function saveToDB(PDO $conn) {
        if($this->id == -1) {
            $stmt = $conn->prepare('INSERT INTO Users(username, email, hash_pass) '
                    . 'VALUES (:username, :email, :pass)');
            
            $result = $stmt->execute([ 
                'username' => $this->username, 
                'email'=> $this->email, 
                'pass' => $this->hashPass]);
            
            if ($result !== false) {
                $this->id = $conn->lastInsertId();
                return true;
            }
        } else {
            $stmt = $conn->prepare('UPDATE Users '
                    . 'SET username=:username, '
                    . 'email=:email, '
                    . 'hash_pass=:hash_pass '
                    . 'WHERE id=:id');
            
            $result = $stmt->execute([ 
                'username' => $this->username, 
                'email' => $this->email,
                'hash_pass' => $this->hashPass, 
                'id' => $this->id]);
            
            return $result;
        }
        
        return false;
    }
    
    static public function loadUserById(PDO $conn, $id) {
        $stmt = $conn->prepare('SELECT * FROM Users WHERE id=:id');
        $result = $stmt->execute(['id' => $id]);
        
        if ($result === true && $stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->setUsername($row['username']);
            $loadedUser->setHashPass($row['hash_pass']);
            $loadedUser->setEmail($row['email']);
            
            return $loadedUser;
        }
    }
    
    static public function loadAllUsers(PDO $conn) {
        $sql = "SELECT * FROM Users";
        $ret = [];
        
        $result = $conn->query($sql);
        if ($result !== false && $result->rowCount() != 0) {
            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->setUsername($row['username']);
                $loadedUser->setHashPass($row['hash_pass']);
                $loadedUser->setEmail($row['email']);
                
                $ret[] = $loadedUser;
            }
        }
        
        return $ret;
    }
    
    public function delete(PDO $conn) {
        if($this->id != -1) {
            
            $stmt = $conn->prepare('DELETE FROM Users WHERE id=:id');
            $result = $stmt->execute(['id' => $this->id]);
            
            if($result === true) {
                $this->id = -1;
                return true;
            }
            
            return false;
        }
        
        return true;
    }
    
    static public function loadUserByEmail(PDO $conn, $email) {
        $stmt = $conn->prepare('SELECT * FROM Users WHERE email=:email');
        $result = $stmt->execute(['email' => $email]);
        
        if ($result === true && $stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->setUsername($row['username']);
            $loadedUser->setHashPass($row['hash_pass']);
            $loadedUser->setEmail($row['email']);
            
            return $loadedUser;
        }
    }
    
    static public function login(PDO $conn, $email, $password) {
        $user = self::loadUserByEmail($conn, $email);
        
        if($user) {
            if(password_verify($password, $user->getHashPass())) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}