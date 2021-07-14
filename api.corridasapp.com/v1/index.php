<?php
require 'controladores/corridas.php';
require 'controladores/busline.php';
require 'controladores/boletos.php';
require 'controladores/admin.php';
require 'controladores/usuarios.php';
require 'vistas/VistaXML.php';
require 'vistas/VistaJson.php';
require 'utilidades/ConexionBD.php';

require 'utilidades/ExcepcionApi.php';
// Constantes de estado
const ESTADO_URL_INCORRECTA = 2;
const ESTADO_EXISTENCIA_RECURSO = 3;
const ESTADO_METODO_NO_PERMITIDO = 4;
$vista = new VistaJson();

set_exception_handler(function ($exception) use ($vista) {
    $cuerpo = array(
       // "estado" => $exception->estado,
        "mensaje" => $exception->getMessage()
    );
    if ($exception->getCode()) {
        $vista->estado = $exception->getCode();
    } else {
        $vista->estado = 500;
    }

    $vista->imprimir($cuerpo);
}
);
// Extraer segmento de la url
 if (isset($_GET['PATH_INFO'])){
    $peticion = explode('/', $_GET['PATH_INFO']);
 }else{
    throw new ExcepcionApi(ESTADO_URL_INCORRECTA, utf8_encode("No se reconoce la petición"));
 }
// Obtener recurso
$recurso = array_shift($peticion);
$recursos_existentes = array('admin', 'boletos','busline', 'corridas','usuarios','boletos' );

// Comprobar si existe el recurso
if (!in_array($recurso, $recursos_existentes)) {
    // Respuesta error
   }

   $metodo = strtolower($_SERVER['REQUEST_METHOD']);



// Filtrar método
switch ($metodo) {
    case 'get':
    case 'post':
    case 'put':
    case 'delete':
        if (method_exists($recurso, $metodo)) {
            $respuesta = call_user_func(array($recurso, $metodo), $peticion);
            $vista->imprimir($respuesta);
            break;
        }
    default:
        // Método no aceptado
        $vista->estado = 405;
        $cuerpo = [
            "estado" => ESTADO_METODO_NO_PERMITIDO,
            "mensaje" => utf8_encode("Método no permitido")
        ];
        $vista->imprimir($cuerpo);
}
