<?php


function mostrarError($errores, $campo){
    $alerta = '';
    
    if(isset($errores[$campo]) && !empty($campo)){
   $alerta ="<div class='alert alert-danger'>$errores[$campo]</div>";
}
return $alerta;

    }
    
    function borrarErrores(){
        $borrado = false;
        if(isset($_SESSION['errores'])){
            $_SESSION['errores'] = null;
            $borrado = session_unset();
        }
        if(isset($_SESSION['completado'])){
            $_SESSION['completado'] = null;
            $borrado = session_unset();
        }
        return $borrado;
    }
?>