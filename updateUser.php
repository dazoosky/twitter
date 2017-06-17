<?php
session_start();
require __DIR__ . '/connection.php';
function __autoload($classname) {
    $filename = './src/'.$classname.'.php';
    require_once ($filename);
}
function sthWentWrong($error) {
    header('Location: userpanel.php');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = intval($_SESSION['userId']);
    $about = $_POST['about'];
    $age = intval($_POST['age']);
    $email = $_POST['email'];
    $passOld = $_POST['oldPassword'];
    $passNew1 = $_POST['newPassword1'];
    $passNew2 = $_POST['newPassword2'];
    if (isset($_POST['changePassword'])) {
        $checkbox = true;
    }
    else {$checkbox = false; }
//    var_dump($_POST);
    $userDB = UserExtended::loadMoreAboutUser($conn, $userId);
    $userOldPass = User::loadUserById($conn, $userId)->getHashPass();
//    var_dump($userOldPass);
//    var_dump($userDB);
    if ($about != $userDB->getAboutMe()) {
        if (is_string($about)) {
            $userDB->setAboutMe($about);
        }
    }
    if ($age != intval($userDB->getAge())) {
        if (is_int($age) && $age > 0 && $age <100) {
            $userDB->setAge($age);
        }
    }
    if ($email != $userDB->getEmail()){
        if (is_string($email) && preg_match('~.+@.+\..+~', $email) == 1) {
            $userDB->setEmail($email);
        } 
    }

    if ($checkbox == true) {
        if (password_verify($passOld, $userOldPass)) {
            if ($passNew1 != '' && $passNew1 === $passNew2) {
                $userDB->setPassword($passNew1);
            }
        }
    }
    var_dump($userDB);
//    var_dump($userDB->saveToDB($conn));
    $userDB->saveToDB($conn);
//    header("Location: userpanel.php ");
}
