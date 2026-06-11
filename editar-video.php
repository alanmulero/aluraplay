<?php
session_start();
require_once 'conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    echo "ID inválido.";
    exit();
}

// Verifica se o vídeo existe (útil para GET e validação)
$stmt = $conn->prepare("SELECT * FROM videos WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$video = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$video) {
    echo "Vídeo não encontrado.";
    exit();
}

// Se veio via POST, atualiza o registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $link = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
    $title = filter_input(INPUT_POST, 'title');

    if (!$link || !$title) {
        echo "Dados inválidos.";
        exit();
    }

    $update = $conn->prepare("UPDATE videos SET url = :url, title = :title WHERE id = :id");
    $update->bindParam(':url', $link);
    $update->bindParam(':title', $title);
    $update->bindParam(':id', $id, PDO::PARAM_INT);

    if ($update->execute()) {
        header('Location: index.php');
        exit();
    } else {
        echo "Erro ao atualizar o vídeo.";
        exit();
    }
}

