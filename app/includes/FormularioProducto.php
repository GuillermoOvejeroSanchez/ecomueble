<?php
    require_once __DIR__.'/Form.php';
    require_once __DIR__.'/Producto.php';
    require_once __DIR__.'/Categoria.php';

    class FormularioProducto extends Form{
        public function __construct(){
            parent::__construct('formProducto');
        }
        protected function generaCamposFormulario($form){
            $html=
            '<fieldset>
            <legend> Subir Producto </legend>
            <div><label>Nombre del producto: </label> <input type="text" name="nombre" /></div>
            <div><label>Descripción: </label> <input type="text" name="description" /></div>
            <div><label>Precio: </label> <input type="text" name="price" /><div>
            <div><label>Imagen del producto: </label> <input type="file" name="imagen" /></div>
            <label for="categoria">Elige una categoría:</label>
            <select id="categoria" name="categoria" form="product_form">
            <div class="b"><button type="submit" name="submit_subir">Subir Producto</button></div>
            ';
            return $html;
        }

        protected function procesaFormulario($form){
            
        }
    }

?>