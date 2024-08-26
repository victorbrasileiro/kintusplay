<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$video = [
    'url' => '',
    'title' => '',
];
if ($id !== false) {
    $statement = $pdo->prepare('SELECT * FROM videos WHERE id = ?;');
    $statement->bindValue(1, $id, PDO::PARAM_INT);
    $statement->execute();
    $video = $statement->fetch(\PDO::FETCH_ASSOC);
}

?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/estilos-form.css">
    <link rel="stylesheet" href="../css/flexbox.css">
    <title>Kintus Videos</title>
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
</head>

<body>

    <!-- Cabecalho -->
    <header>

        <nav class="cabecalho">
            <a class="logo" href="../index.php"></a>

            <div class="cabecalho__icones">
                <a href="../pages/about.html" class="cabecalho__about"></a>
                <a href="../pages/enviar-video.html" class="cabecalho__videos"></a>
                <a href="../pages/login.html" class="cabecalho__sair"></a>
            </div>
        </nav>

    </header>

    <main class="container">

        <div class="container__login">
            <form class="container__formulario" 
                action="<?php echo $id !== false ? '/editar-video.php?id=' . $id : '/novo-video.php';?>" 
                method="post">
                <h2 class="formulario__titulo">Envie um Vídeo</h3>
                    <div class="formulario__campo">
                        <label class="campo__etiqueta" for="url">Insira o Link</label>
                        <input name="url" 
                            value="<?php echo $video['url']; ?>"
                            class="campo__escrita" 
                            required
                            placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" 
                            id='url' />
                    </div>


                    <div class="formulario__campo">
                        <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                        <input name="titulo"
                            value="<?php echo $video['title']; ?>" 
                            class="campo__escrita" 
                            required 
                            placeholder="Neste campo, dê o nome do vídeo"
                            id='titulo' />
                    </div>

                    <input class="formulario__botao" type="submit" value="Enviar" />
            </form>
        </div>

    </main>

</body>

</html>