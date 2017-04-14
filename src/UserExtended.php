<?php
require_once __DIR__ . '/User.php';
require __DIR__ . '/../connection.php';


class UserExtended extends User {
    
    private $aboutMe;
    private $age;
    
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
            return $loadedUserDetails;
        }
        else {
            $loadedUser = User::loadUserById($conn, $id);
            $loadedUserDetails = new UserExtended($id);
            $loadedUserDetails->setUsername($loadedUser->getUsername());
            $loadedUserDetails->setEmail($loadedUser->getEmail());
            $loadedUserDetails->setAboutMe('Brak dodatkowych informacji');
            $loadedUserDetails->setAge('Nieznany');
            return $loadedUserDetails;
        }
    }
}


