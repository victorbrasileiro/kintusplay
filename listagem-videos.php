<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoList = $pdo->query('SELECT * FROM videos;')->fetchAll(\PDO::FETCH_ASSOC);

// \PDO::FETCH_ASSOC -> Vai transformar os videos em um array associativo

?>
<?php require_once 'inicio-html.php' ; ?>
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
                    <div class="icon-video">
                        <img src="./img/logo.png" alt="logo canal">
                        <h3><?php echo $video['title']; ?></h3>
                    </div>
                    <div class="acoes-video">
                        <a class="botao" 
                            href="/editar-video?id=<?php echo $video['id']; ?>">
                            Editar
                        </a>
                        <a class="botao" 
                            href="/remover-video?id=<?php echo $video['id']; ?>">
                            Excluir
                        </a>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php require_once 'fim-html.php'; 
