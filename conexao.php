<?php

// Carrega as variáveis do .env
$env = parse_ini_file(__DIR__ . '/.env');

$host = $env['DB_HOST'];
$user = $env['DB_USER'];
$pass = $env['DB_PASS'];
$dbName = $env['DB_NAME'];
$charset = $env['DB_CHARSET'];

try{
    $conn = new PDO("mysql:host=$host;dbname=$dbName;charset=$charset", $user, $pass);
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
    exit();
}
