<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoList = $pdo->query('SELECT * FROM videos;')->fetchAll(\PDO::FETCH_ASSOC);

// \PDO::FETCH_ASSOC -> Vai transformar os videos em um array associativo

?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/flexbox.css">
    <title>Kintus Videos</title>
    <link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon">
</head>

<body>

    <header>

        <nav class="cabecalho">
            <a class="logo" href="/"></a>

            <div class="cabecalho__icones">
                <a href="./pages/about.html" class="cabecalho__about"></a>
                <a href="./pages/enviar-video.html" class="cabecalho__videos"></a>
                <a href="./pages/login.html" class="cabecalho__sair"></a>
            </div>
        </nav>

    </header>

    <ul class="videos__container" alt="videos">

        <?php foreach($videoList as $video): ?>
                    
            <?php 
                //se url começa com http
                if(!str_starts_with($video['url'], 'http')) 
                    {
                        $video['url'] = 'https://www.youtube.com/embed/PoMo_Q1Z6fQ?si=-y5yZmT58mXm9u7A';    
                    }
            ?>
            
            <li class="videos__item">
                <div class="video">
                    <iframe width="100%" height="72%" src="<?php echo $video['url']; ?>"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="descricao-video">
                    <img src="./img/logo.png" alt="logo canal">
                    <h3><?php echo $video['title']; ?></h3>
                    <div class="acoes-video">
                        <a class="botao" 
                            href="/formulario.php?id=<?php echo $video['id']; ?>">
                            Editar
                        </a>
                        <a class="botao" 
                            href="/remover-video.php?id=<?php echo $video['id']; ?>">
                            Excluir
                        </a>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>