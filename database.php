<?php
// used to connect to the database
$host = "localhost";
$db_name = "mybd";
$username = "rocio";
$password = "123456";
 
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}
 
// to handle connection error
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}
?>