<?php 

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

// Obtém o valor do parâmetro 'id' da URL através do método GET. 
// Esse 'id' é o identificador do vídeo que será deletado do banco de dados.
$id = $_GET['id'];

// Define a instrução SQL para deletar um registro da tabela 'videos' 
// onde o 'id' corresponde ao valor recebido pelo método GET.
$sql = 'DELETE FROM videos WHERE id = ?';

// Prepara a instrução SQL para ser executada, prevenindo ataques de SQL injection.
$statement = $pdo->prepare($sql);

// Associa o valor do 'id' recebido à primeira posição (placeholder) da instrução SQL preparada.
$statement->bindValue(1, $id);

if ($statement->execute() === false) {
    header('Location: /?erro=0');
} else {
    header('Location: /?sucesso=1');
}

