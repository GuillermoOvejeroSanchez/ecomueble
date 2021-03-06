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
    //Regex match (Expresion Regular) /catalogo?categoria=categoriaPorGET /catalogo?categoria=
    case preg_match('(/catalogo\?categoria=\w+)', $request, $matches)? true : false:
            require __DIR__.
            '/views/catalogo.php';
        break;
    //Regex match (Expresion Regular) match -> /articulo?id=123 !match-> /articulo?id=
    case preg_match('((/articulo\?id)=\d+)', $request, $matches)? true : false:
        require __DIR__.
        '/views/articulo.php';
        break;
    case preg_match('((/usuario\?id)=\d+)', $request, $matches)? true : false:
        require __DIR__.
        '/views/usuario.php';
        break;
    case '/chat':
        require __DIR__.
        '/views/chat.php';
        break;
    case '/login':
        require __DIR__.
        '/views/login.php';
        break;
    case '/logout':
        require __DIR__.
        '/views/logout.php';
        break;
    case '/registrar':
        require __DIR__.
        '/views/registrar.php';
        break;
    case '/perfil':
        require __DIR__.
        '/views/perfil.php';
        break;
    case preg_match('((/perfil\?upload)=\d+)', $request, $matches)? true : false:
        require __DIR__.
        '/views/perfil.php';
        break;
    case '/subir':
        require __DIR__.
        '/views/subir.php';
        break;
    case '/status':
        require __DIR__.
        '/status_redirect.php';
        break;
    case '/editar':
        require __DIR__.
        '/views/editar.php';
        break;
    case '/admin':
        require __DIR__.
        '/views/admin.php';
        break;
    case preg_match('((/editarProducto\?id)=\d+)', $request, $matches)? true : false:
        require __DIR__.
        '/views/editarProducto.php';
        break;
    default:
        http_response_code(404);
        require __DIR__.
        '/views/404.php';
        break;

} 