<?php

$host = 'localhost';
$user = 'alan';
$pass = 'Ala....';
$dbName = 'aluraplay';
$charset = 'utf8mb4';

try{
    $conn = new PDO("mysql:host=$host;dbname=$dbName;charset=$charset", $user, $pass);
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
    exit();
}
