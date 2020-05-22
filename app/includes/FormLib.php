<?php

/**
 * Funciones genéricas para la gestión de formularios.
 */

/**
 * @var string Cadena utilizada como valor del atributo "id" de la etiqueta &lt;form&gt; asociada al formulario y 
 * como parámetro a comprobar para verificar que el usuario ha enviado el formulario.
 */
//private $formId;

/**
 * @var string URL asociada al atributo "action" de la etiqueta &lt;form&gt; del fomrulario y que procesará el 
 * envío del formulario.
 */
//private $action;
//private $enctype;
/**
 * Crea un nuevo formulario.
 *
 * Posibles opciones:
 * <table>
 *   <thead>
 *     <tr>
 *       <th>Opción</th>
 *       <th>Valor por defecto</th>
 *       <th>Descripción</th>
 *     </tr>
 *   </thead>
 *   <tbody>
 *     <tr>
 *       <td>action</td>
 *       <td><code>$_SERVER['PHP_SELF']</code></td>       
 *       <td>URL asociada al atributo "action" de la etiqueta &lt;form&gt; del fomrulario y que procesará
 *           el envío del formulario.</td>
*     </tr>
*   </tbody>
* </table>

* @param string $formId    Cadena utilizada como valor del atributo "id" de la etiqueta &lt;form&gt; asociada al
*                          formulario y como parámetro a comprobar para verificar que el usuario ha enviado el formulario.
*
* @param array $opciones (ver más arriba).
*/
function formulario($formId, $opciones = array() )
{

    $opcionesPorDefecto = array( 'action' => null, 'enctype' => null);
    $opciones = array_merge($opcionesPorDefecto, $opciones);

    $action   = $opciones['action'];
    $enctype = $opciones['enctype'];
    if ( !$action ) {
        $action = htmlentities($_SERVER['PHP_SELF']);
    }

    /**
    * Se encarga de orquestar todo el proceso de gestión de un formulario.
    */
    if (!formularioEnviado($_POST, $formId) ) {
        echo generaFormulario($formId, $action, $enctype); 
    } else {
        if($formId == "formRegistro") {    
            $result = procesaFormularioReg($_POST);    
            if (is_array($result)) {
                echo generaFormulario($formId, $action, $enctype, $result, $_POST);                
            } else {
                ?>
                <script type="text/javascript">
                window.location.href = "<?php echo $result;?>";
                </script>
                <?php
                exit();
            }
        }
        
        elseif($formId == "loginForm") {
            $result = procesaFormularioLogin($_POST);    
            if (is_array($result)) {
                echo generaFormulario($formId, $action, $enctype, $result, $_POST);                
            } else {
                ?>
                <script type="text/javascript">
                window.location.href = "<?php echo $result;?>";
                </script>
                <?php
                exit();
            }
        }
    } 
}

/**
 * Procesa los datos del formulario.
 *
 * @param string[] $datos Datos enviado por el usuario (normalmente <code>$_POST</code>).
 *
 * @return string|string[] Devuelve el resultado del procesamiento del formulario, normalmente una URL a la que
 * se desea que se redirija al usuario, o un array con los errores que ha habido durante el procesamiento del formulario.
 */
function procesaFormulario($datos)
{
    return array();
}

/**
 * Función que verifica si el usuario ha enviado el formulario.
 * Comprueba si existe el parámetro <code>$formId</code> en <code>$params</code>.
 *
 * @param string[] $params Array que contiene los datos recibidos en el envío formulario.
 *
 * @return boolean Devuelve <code>true</code> si <code>$formId</code> existe como clave en <code>$params</code>
 */
function formularioEnviado(&$params, $formId)
{
    return isset($params['action']) && $params['action'] == $formId;
} 

/**
 * Función que genera el HTML necesario para el formulario.
 *
 * @param string[] $errores (opcional) Array con los mensajes de error de validación y/o procesamiento del formulario.
 *
 * @param string[] $datos (opcional) Array con los valores por defecto de los campos del formulario.
 *
 * @return string HTML asociado al formulario.
 */
function generaFormulario($formId, $action, $enctype = null, $errores = array(), &$datos = array())
{

    $html = generaListaErrores($errores);

    if($enctype !== null)
        $html .= '<form method="POST" action="'.$action.'" enctype="'.$enctype.'" id="'.$formId.'" >';
    else
        $html .= '<form method="POST" action="'.$action.'" id="'.$formId.'" >';

    $html .= '<input type="hidden" name="action" value="'.$formId.'" />';

    $html .= generaCamposFormulario($datos);
    $html .= '</form>';
    return $html;
}

/**
 * Genera la lista de mensajes de error a incluir en el formulario.
 *
 * @param string[] $errores (opcional) Array con los mensajes de error de validación y/o procesamiento del formulario.
 *
 * @return string El HTML asociado a los mensajes de error.
 */
function generaListaErrores($errores){
    $html='';
    $numErrores = count($errores);
    $html .= "<div class='cajita'>";
    if (  $numErrores == 1 ) {
        $html .= "<ul><li>".$errores[0]."</li></ul>";
    } else if ( $numErrores > 1 ) {
        $html .= "<ul><li>";
        $html .= implode("</li><li>", $errores);
        $html .= "</li></ul>";
    }
    $html .="</div>";
    return $html;
}
