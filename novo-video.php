<?php 

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false) {
    header('Location: /?erro=0'); // Redireciona para a página inicial com um parâmetro indicando falha.
    exit(); // Encerra o script.
}

$titulo = filter_input(INPUT_POST, 'titulo');
if ($titulo === false) {
    header('Location: /?erro=0'); 
    exit(); 
}

// Prepara uma instrução SQL
$sql = 'INSERT INTO videos (url, title) VALUES (?, ?)';
$statement = $pdo->prepare($sql); 

// Associa os valores da URL e do título aos respectivos placeholders na instrução SQL preparada.
$statement->bindValue(1, $url); // Associa a URL ao primeiro placeholder (?)
$statement->bindValue(2, $titulo); // Associa o título ao segundo placeholder (?)

// Executa a instrução SQL. Se a execução falhar, redireciona para a página inicial com uma indicação de falha.
// Caso contrário, redireciona para a página inicial com uma indicação de sucesso.
if ($statement->execute() === false) {
    header('Location: /?erro=0'); 
} else {
    header('Location: /?sucesso=1');
}

