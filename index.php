<?php
session_start();
include_once 'conexao.php';

$stmt = $conn->prepare("SELECT * FROM videos");
$stmt->execute();
$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/flexbox.css">
    <title>AluraPlay</title>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
</head>

<body>

    <header>

        <nav class="cabecalho">
            <a class="logo" href="./index.php"></a>

            <div class="cabecalho__icones">
                <a href="./pages/enviar-video.html" class="cabecalho__videos"></a>
                <a href="./pages/login.html" class="cabecalho__sair">Sair</a>
            </div>
        </nav>

    </header>

    <ul class="videos__container" alt="videos alura">

        <?php foreach ($videos as $video) { ?>
        <?php if (empty($video['url']) || empty($video['title'])) {
            continue; // Pula para a próxima iteração se a URL ou o título estiverem vazios
        } ?>
            <li class="videos__item">
                <iframe width="100%" height="72%" src="<?= $video['url']; ?>"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
                <div class="descricao-video">
                    <img src="./img/logo.png" alt="logo canal alura">
                    <h3><?php echo $video['title']; ?></h3>
                    <div class="acoes-video">
                        <a href="./pages/enviar-video.html">Editar</a>
                        <a href="./remover-video.php?id=<?php echo $video['id']; ?>">Excluir</a>
                    </div>
                </div>
            </li>
        <?php } ?>

    </ul>
</body>

</html>