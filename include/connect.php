<?php
$db_driver="mysql";
$host = "127.0.0.1";
$database = "library";
$dsn = "$db_driver:host=$host; dbname=$database";
$username = "root";
$password = "";
try{
    $dbh = new PDO ($dsn, $username, $password);
}
catch (PDOException $e){
    echo "<br>Error!".$e->getMessage();
}