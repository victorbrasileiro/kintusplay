<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$video = [
    'url' => '',
    'title' => '',
];
if ($id !== false && $id !== null) {
    $statement = $pdo->prepare('SELECT * FROM videos WHERE id = ?;');
    $statement->bindValue(1, $id, PDO::PARAM_INT);
    $statement->execute();
    $video = $statement->fetch(\PDO::FETCH_ASSOC);
}

?>
<?php require_once 'inicio-html.php'; ?>
    <main class="container">
        <div class="container__enviar-video">
            <form class="container__formulario"
                method="post">
                <div class="formulario__titulo">
                    <img src="/img/titulo-novo-video.png" alt="logo titulo enviar video">
                </div>
                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="url">Insira o link</label>
                    <input name="url" 
                           value="<?php echo $video['url']; ?>"
                           class="campo__escrita-video" 
                           required
                           placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" 
                           id='url' />
                </div>


                    <div class="formulario__campo">
                        <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                        <input name="titulo"
                            value="<?php echo $video['title']; ?>" 
                            class="campo__escrita-video" 
                            required 
                            placeholder="Neste campo, dê o nome do vídeo"
                            id='titulo' />
                    </div>

                    <input class="formulario__botao" type="submit" value="Enviar" />
            </form>
        </div>
    </main> 
<?php require_once 'fim-html.php'; ?>