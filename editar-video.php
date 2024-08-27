<?php 

// Define o caminho para o banco de dados SQLite.
$dbPath = __DIR__ . '/banco.sqlite';

// Cria uma nova conexão PDO com o banco de dados SQLite.
$pdo = new PDO("sqlite:$dbPath");

// Obtém o 'id' passado como parâmetro via GET e valida se é um inteiro. 
// Se não for um inteiro válido ou estiver ausente, redireciona o usuário e encerra o script.
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false || $id === null) {
    header('Location: /?sucesso=0');
    exit(); 
}   

// Obtém a URL passada via POST e valida se é uma URL válida. 
// Se a URL não for válida, redireciona o usuário e encerra o script.
$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false) {
    header('Location: /?sucesso=0'); 
    exit(); 
}

$titulo = filter_input(INPUT_POST, 'titulo');
if ($titulo === false) {
    header('Location: /?sucesso=0'); 
    exit(); 
}

// Prepara uma instrução SQL para atualizar os valores de 'url' e 'title' de um vídeo específico (baseado no 'id').
$sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id;';
$statement = $pdo->prepare($sql);

$statement->bindValue(':url', $url); 
$statement->bindValue(':title', $titulo); 
$statement->bindValue(':id', $id, PDO::PARAM_INT); 

if ($statement->execute() === false) {
    header('Location: /?erro=0');
} else {
    header('Location: /?sucesso=1');
}

