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
    - [ ] Clase de modelos para cada tabla
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
### 3. Desde terminal
Para esta opcion hay que tener php en el path 

Y ejecutar este comando desde donde tengamos el archivo index.php
```php
php -S localhost:<port>
```
En mi caso, en la carpeta *app/* y el puerto *80* por defecto para *http*
```bash
D:/dev/ecomueble/app > php -S localhost:80
```
---

## Base de Datos
Para lanzar la base de datos necesitaremos primero crearla en local.  
En MySQL importamos en la BD *ecomueble* el archivo de sql *ecomueble_imagenes.sql*  
Los cambios que hagamos en la BD local no se guardaran.  
- [x] Base de datos de prueba
- [ ] Popular la BD con otro fichero SQL (Datos Falsos)
- [ ] Crear BD con un script PHP

## Branches

Uso de 2 branches principales
- master: donde va el codigo que funciona y listo para usar
- development: codigo que estemos desarrollando
- branch extra: con nuestro nombre por ejemplo, la podemos usar para cuando trabajemos en algo especifico, o estemos probando cosas

Una vez tengamos una feature desarrollada, podremos hacer un *pull request* y un *merge* a la branch de master

## Issues

Al crear *Issues* nuevas tenemos dos plantillas:
- Bug report: si se encuentra alguna parte de la aplicacion que no funcione
- Feature request: si se quiera una funcionalidad extra en alguna parte de la app
- Blank template: añadir issues restantes