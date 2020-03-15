# Ecomueble - AW - Curso 19/20
Proyecto de Aplicaciones Web realizado con PHP

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