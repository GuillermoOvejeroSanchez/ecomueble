<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/':
        require __DIR__.
        '/views/home.php';
        break;
    case '/index.php':
        require __DIR__.
        '/views/home.php';
        break;
    case '/about':
        require __DIR__.
        '/views/about.php';
        break;
    case '/catalogo':
        require __DIR__.
        '/views/catalogo.php';
        break;
    case '/chat':
        require __DIR__.
        '/views/chat.php';
        break;
    case '/login':
        require __DIR__.
        '/views/login.php';
        break;
    case '/registrar':
        require __DIR__.
        '/views/registrar.php';
        break;
    case '/perfil':
        require __DIR__.
        '/views/perfil.php';
        break;
    default:
        http_response_code(404);
        require __DIR__.
        '/views/404.php';
        break;

} 
?>