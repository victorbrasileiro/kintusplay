<?php

declare(strict_types=1); // Ativa a tipagem estrita para aumentar a segurança e previsibilidade do código.

// Verifica se o 'PATH_INFO' não existe ou se o caminho é a raiz ('/')
if (!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER['PATH_INFO'] === '/') {
    require_once 'listagem-videos.php'; // Inclui o script que lista todos os vídeos.
} 
// Verifica se o 'PATH_INFO' é '/novo-video'
elseif ($_SERVER['PATH_INFO'] === '/novo-video') {
    // Verifica se o método de requisição é 'GET'
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once 'formulario.php'; // Inclui o formulário para adicionar um novo vídeo.
    } 
    // Verifica se o método de requisição é 'POST'
    elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once 'novo-video.php'; // Inclui o script que processa a adição de um novo vídeo.
    }
} elseif ($_SERVER['PATH_INFO'] === '/editar-video') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once 'formulario.php';
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once 'editar-video.php';
    }
} elseif ($_SERVER['PATH_INFO'] === '/remover-video') {
    require_once 'remover-video.php';
}
