<?php
require_once '../conexion.php';

$resultado = mysqli_query($db, "select * from tb_distrito");
$entidadDistrito = null;

$result_distrito = array();

while ($row = mysqli_fetch_array($resultado)) {
    $entidadDistrito = new stdClass();
    
    $ID_DIS  = $row['ID_DIS'];
   $NOM_DIS=  $row['NOM_DIS'];
    
   $entidadDistrito->id_distrito =  (int)$ID_DIS;
   $entidadDistrito ->nombre_distrito = $NOM_DIS;
   
   array_push($result_distrito, $entidadDistrito);
   
}
 
header('Content-type: application/json; charset=utf-8');
    echo json_encode($result_distrito);
?>