# Ecomueble - AW - Curso 19/20
Proyecto de Aplicaciones Web realizado con PHP

## Estructura del Proyecto
- Todo lo relacionado con la aplicacion esta dentro de la subcarpeta *app/*
```
├───app
|   |   bd.php
│   │   config.php
│   │   index.php
│   │   routes.php
│   ├───controllers  
│   ├───models   
│   ├───views  
│   ├───css  
│   ├───img   
│   └───common  
```
Los ficheros que nos interesan son *index.php* y *routes.php*  

*index.php*
```php
<?php
require_once('config.php');
require('routes.php');
?>
```
*routes.php*
```php
<?php
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/':
        require __DIR__.
        '/views/home.php';
        break;
    case '/about':
        require __DIR__.
        '/views/about.php';
        break;

    ...

    default:
        http_response_code(404);
        require __DIR__.
        '/views/404.php';
        break;
} 
?>
```
Estos 2 scripts redirigen las peticiones realizadas hacia las vistas,  
si queremos añadir mas vistas vale con añadir un case a las rutas
### Ejemplo de ruta
>Queremos añadir la vista del perfil  
añadimos un nuevo *case*
>```php 
>   case '/perfil':
>       require __DIR__.
>       '/views/perfil.php';
>       break;  
>```
>Y al ir a http://localhost/perfil  
Se nos abriria la vista del perfil  

---

## Subcarpetas
Ademas tenemos 3 carpetas donde las funcionalidades principales van
- controllers
    - Los archivos dentro de controllers se comunican con los modelos y devuelven los datos a la vista
- models
    - El modelo se comunica con la base de datos y manipula los datos para devolverselos formateados a el controlador
- views
    - La vista simplemente genera codigo html segun lo que el controlador le pase

## Como correr la aplicacion
### 1. Extension de PHP Server para VSCode (sin XAMPP)
- Para esto necesitaremos descargar la extension en VSCODE  
- Añadir PHP al path, para poder ejecutar comandos de php desde la terminal
- Una vez tengamos todo hecho, podremos abrir la carpeta *app/* con VSCode
- Dandole a *F1* o con *click der* buscamos **PHP Server: Serve Project** y listo

---
### 2. Cambiar *httpd.conf* de Apache
- Abrimos el archivo desde el panel de control de *XAMPP*
- Una vez dentro tenemos que comentar 2 lineas:
    - ```#DocumentRoot "C:/xampp/htdocs"```
    - ```#<Directory "C:/xampp/htdocs">```  
- Y añadir estas dos
    - ```DocumentRoot "C:/xampp/htdocs/ecomueble/app"```
    - ```<Directory "C:/xampp/htdocs/ecomueble/app">```  

Al correr *Apache* ya funcionara nuestra app

---
### 3. Archivo *.htacces*
Esta ultima opcion es por si no queremos hacer cambios a la configuracion de *Apache* que viene por defecto  

- Para esta forma, solamente tendremos que colocar el archivo
[.htacces](https://github.com/GuillermoOvejeroSanchez/ecomueble/blob/master/.htaccess) dentro de htdocs  
`C:/xampp/htdocs/.htacces`

Con esto ya funcionaria la app al correr *Apache*

---

