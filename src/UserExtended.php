<?php
require_once __DIR__ . '/User.php';
require __DIR__ . '/../connection.php';


class UserExtended extends User {
    
    private $aboutMe;
    private $age;
    private $newUser;
    
    public function __construct($userId) {
        $this->id = $userId;
        $this->aboutMe = '';
        $this->age = '';
    }
    public function getAboutMe() {
        return $this->aboutMe;
    }

    public function getAge() {
        return $this->age;
    }

    public function setAboutMe($aboutMe) {
        $this->aboutMe = $aboutMe;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function setNewUser($bool) {
        $this->newUser = $bool;
    }
    public function getNewUser() {
        return $this->newUser;
    }
        
    
    static public function loadMoreAboutUser(PDO $conn, $id) {
        $stmt = $conn->prepare('SELECT Users.id, Users.username, Users.email, UsersInfo.aboutMe, UsersInfo.age, UsersInfo.userId FROM Users JOIN UsersInfo ON Users.id = UsersInfo.userId WHERE Users.id = :id');
        $result = $stmt->execute(['id' => $id]);
        if ($result === true && $stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            //var_dump($row);
            $loadedUserDetails = new UserExtended($id);
            $loadedUserDetails->setUsername($row['username']);
            $loadedUserDetails->setEmail($row['email']);
            $loadedUserDetails->setAboutMe($row['aboutMe']);
            $loadedUserDetails->setAge($row['age']);
            $loadedUserDetails->setHashPass($row['hash_pass']);
            $loadedUserDetails->setNewUser(false);
            return $loadedUserDetails;
        }
        else {
            $loadedUser = User::loadUserById($conn, $id);
            $loadedUserDetails = new UserExtended($id);
            $loadedUserDetails->setUsername($loadedUser->getUsername());
            $loadedUserDetails->setEmail($loadedUser->getEmail());
            $loadedUserDetails->setAboutMe('Brak dodatkowych informacji');
            $loadedUserDetails->setAge('Nieznany');
            $loadedUserDetails->setHashPass($loadedUser->getHashPass());
            $loadedUserDetails->setNewUser(true);
            return $loadedUserDetails;
        }
    }
    public function saveToDB(PDO $conn) {
        if($this->newUser == true) {
            $stmt = $conn->prepare('INSERT INTO UsersInfo(aboutMe, age) '
                    . 'VALUES (:aboutMe, :age); UPDATE Users '
                    . 'SET username=:username, '
                    . 'email=:email, '
                    . 'hash_pass=:hash_pass '
                    . 'WHERE id=:id');
            
            $result = $stmt->execute([ 
                'aboutMe' => $this->aboutMe, 
                'age'=> $this->age, 
                'username' => $this->getUsername(),
                'email' => $this->getEmail(),
                'hash_pass' => $this->getHashPass(),
                'id' => $this->id ]);
            
            if ($result !== false) {
                
                //$this->id = $conn->lastInsertId();
                return true;
            }
        } 
        else {
            $stmt = $conn->prepare('UPDATE Users '
                    . 'SET username=:username, '
                    . 'email=:email, '
                    . 'hash_pass=:hash_pass '
                    . 'WHERE id=:id; UPDATE UsersInfo '
                    . 'SET aboutMe=:aboutMe, '
                    . 'age=:age WHERE userId=:id');
            
            $result = $stmt->execute([ 
                'username' => $this->username, 
                'email' => $this->email,
                'hash_pass' => $this->hashPass, 
                'id' => $this->id,
                'aboutMe' => $this->aboutMe,
                'age' => $this->age]);
            
            return $result;
        }
        
        return false;
    }
}


