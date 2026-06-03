<?php
session_start();
include_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['url'];
    $title = $_POST['title'];

    $stmt = $conn->prepare("INSERT INTO videos (url, title) VALUES (:url, :title)");
    $stmt->bindParam(':url', $url);
    $stmt->bindParam(':title', $title);
    $stmt->execute();

    header('Location: index.php');
    exit();
}