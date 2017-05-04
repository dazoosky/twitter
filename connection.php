<?php
$servername = "localhost";
$username = "root";
$password = "coderslab";
$baseName = "tweeter";


try {
        $conn = new PDO("mysql:charset=utf8;dbname=$baseName", 
                $username, 
                $password/*, 
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING ]*/);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            echo "Email zajęty";
        } 
        else {
                echo 'Wystąpił błąd przy połączeniu do bazy danych: ' . $e->getMessage();
        }
}