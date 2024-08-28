<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
// Inicializa um array para armazenar os dados do vídeo, definindo valores padrão para 'url' e 'title'.
$video = [
    'url' => '',
    'title' => '',
];
// Verifica se o ID é válido (não é falso e não é nulo). Isso garante que só tentemos buscar um vídeo se um ID válido for fornecido.
if ($id !== false && $id !== null) {
    $statement = $pdo->prepare('SELECT * FROM videos WHERE id = ?;');
    // Associa o valor do ID à consulta SQL preparada, especificando que é um parâmetro do tipo inteiro.
    $statement->bindValue(1, $id, PDO::PARAM_INT);
    // Executa a consulta preparada.
    $statement->execute();
    // Obtém o resultado da consulta como um array associativo. O array contém as colunas 'url' e 'title' do vídeo correspondente ao ID fornecido.
    $video = $statement->fetch(\PDO::FETCH_ASSOC);
}

?>
<?php require_once 'inicio-html.php'; ?>
<main class="container">
    <div class="container__enviar-video">
        <!-- Formulário para enviar ou editar um vídeo -->
        <form class="container__formulario"
            method="post">
            <div class="formulario__titulo">
                <img src="/img/titulo-novo-video.png" alt="logo titulo enviar video">
            </div>
            <div class="formulario__campo">
                <label class="campo__etiqueta" for="url">Insira o link</label>
                <!-- Preenche o campo 'url' com o valor atual do vídeo se estiver disponível -->
                <input name="url"
                    value="<?php echo $video['url']; ?>"
                    class="campo__escrita-video"
                    required
                    placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g"
                    id='url' />
            </div>


            <div class="formulario__campo">
                <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                <!-- Preenche o campo 'title' com o valor atual do vídeo se estiver disponível -->
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