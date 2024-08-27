<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

// Executa uma consulta SQL para selecionar todos os registros da tabela 'videos'.
// O método `fetchAll(\PDO::FETCH_ASSOC)` transforma os resultados da consulta em um array associativo.
$videoList = $pdo->query('SELECT * FROM videos;')->fetchAll(\PDO::FETCH_ASSOC);

// \PDO::FETCH_ASSOC -> Vai transformar os videos em um array associativo

?>
<?php require_once 'inicio-html.php' ; ?>
    <!-- Início da lista de vídeos -->
    <ul class="videos__container" alt="videos">
        <?php foreach($videoList as $video): // Itera sobre cada vídeo na lista de vídeos. ?>
            <?php 
                // Verifica se a URL do vídeo não começa com "http".
                // Isso garante que a URL seja um link completo e válido para o vídeo.
                if(!str_starts_with($video['url'], 'http')) 
                    {
                        $video['url'] = 'https://www.youtube.com/embed/PoMo_Q1Z6fQ?si=-y5yZmT58mXm9u7A';    
                    }
            ?>
            <!-- Exibição de cada item de vídeo na lista -->
            <li class="videos__item">
                <div class="video">
                    <!-- Exibe o vídeo em um iframe usando a URL do vídeo -->
                    <iframe width="100%" height="72%" src="<?php echo $video['url']; ?>"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="descricao-video">
                    <div class="icon-video">
                        <img src="./img/logo.png" alt="logo canal">
                        <h3><?php echo $video['title']; // Exibe o título do vídeo ?></h3>
                    </div>
                    <div class="acoes-video">
                        <!-- Botão para editar o vídeo, passando o ID do vídeo na URL para ser editado -->
                        <a class="botao" 
                            href="/editar-video?id=<?php echo $video['id']; ?>">
                            Editar
                        </a>
                        <!-- Botão para excluir o vídeo, passando o ID do vídeo na URL para ser removido -->
                        <a class="botao" 
                            href="/remover-video?id=<?php echo $video['id']; ?>">
                            Excluir
                        </a>
                    </div>
                </div>
            </li>
        <?php endforeach; // Fim do loop foreach ?>
    </ul>
<?php require_once 'fim-html.php'; 
