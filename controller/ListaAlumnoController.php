<?php

require_once '../conexion.php';
 

//Call sp_listaAlumno()
//SELECT * FROM TB_ALUMNO T1  INNER JOIN TB_DISTRITO T2 ON T1.ID_DIS = T2.ID_DIS

$SQL = "CALL sp_listaAlumno()";
$resultado = mysqli_query($db, $SQL);

$entidadAlumno = null;
$entidadDistrito = null;
 $resultadoListaAlumno = array();
 header ('Content-type: image/jpg');

while($row = mysqli_fetch_array($resultado)){
    $entidadAlumno = new stdClass();
    $entidadDistrito = new stdClass();

    $ID_ALU = $row['ID_ALU'];
    $NOM_ALU = $row['NOM_ALU'];
    $COR_ALU = $row['COR_ALU'];
    $SEX_ALU = $row['SEX_ALU'];
    $FEC_ALU  = $row['FEC_NAC_ALU'];
    $PAS_ALU = $row['PAS_ALU'];
    $ID_DIS = $row['ID_DIS'];
    $NOM_DIS = $row['NOM_DIS'];
    $IMG_ALU = $row['IMG_ALU'];
    $entidadAlumno->id_alumno = $ID_ALU;
    $entidadAlumno->nombre_alumno = $NOM_ALU;
    $entidadAlumno->correo_alumno = $COR_ALU;
    $entidadAlumno->sexo_alumno = $SEX_ALU;
    $entidadAlumno->fecha_alumno = $FEC_ALU;
     $entidadAlumno->pass_alumno = $PAS_ALU;
     $entidadAlumno->imagen_alumno = base64_encode($row['IMG_ALU']);
     $entidadDistrito->id_distrito = $ID_DIS;
     $entidadDistrito->nombre_distrito =$NOM_DIS;
     
     $entidadAlumno->Distrito = $entidadDistrito;
     array_push($resultadoListaAlumno, $entidadAlumno);
     
}  
header('Content-type: application/json; charset=utf-8');
 
echo json_encode($resultadoListaAlumno);

?>