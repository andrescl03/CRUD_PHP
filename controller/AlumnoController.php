<?php
session_start();


    require_once '../conexion.php';
    
if(isset($_POST['fn_eliminar'])){
    
  $id_alumno =  (int)$_POST['id_alu'];
  $SQLELIMINAR = "delete from TB_ALUMNO where ID_ALU =  $id_alumno ;";
  $resulDelete = mysqli_query($db, $SQLELIMINAR);
  
}


if(isset($_POST['registrarAlumno'])){
     
    $NOM_ALU = isset($_POST['NOM_ALU']) ? $_POST['NOM_ALU']: false;
    $COR_ALU = isset($_POST['COR_ALU']) ? $_POST['COR_ALU']: false;
    $SEX_ALU = isset($_POST['SEX_ALU']) ? (int) $_POST['SEX_ALU'] : false;
    $FEC_ALU = isset($_POST['FEC_ALU']) ? $_POST['FEC_ALU'] : false;
    $PAS_ALU = isset($_POST['PAS_ALU']) ? $_POST['PAS_ALU'] : false;
     $DIS_ALU =isset($_POST['DISTRITO']) ? (int)  $_POST['DISTRITO'] : false;
     $IMG_ALU = isset($_FILES['IMG_ALU']) ?  $_FILES['IMG_ALU'] : false;
     
     
      $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
      $limite_kb = 16384;
    
      
      
        $errores = array();
    $valorFecha = explode('-', $FEC_ALU);
    $data ;
    if (in_array($_FILES['IMG_ALU']['type'], $permitidos) && $_FILES['IMG_ALU']['size'] <= $limite_kb * 1024)
    {
         $imagen_temporal = $_FILES['IMG_ALU']['tmp_name'];
         $tipo = $_FILES['IMG_ALU']['type'];
        $data=file_get_contents($imagen_temporal);
        $data = mysqli_real_escape_string($db,$data);
          
   

    }
    else{
        $errores['IMG_ALU'] = 'Suba otra imagen';
    }
    
    if(!empty($NOM_ALU) && !preg_match("/[0-9]/",$NOM_ALU) && !is_numeric($NOM_ALU)){
        $NOMBRE_VALIDADO= true;
    }
    else{
        $errores['NOM_ALU'] = 'El nombre no es valido';
    }
    if(!empty($COR_ALU) && filter_var($COR_ALU, FILTER_VALIDATE_EMAIL)){
        $CORREO_VALIDADO = true;
    }
    else{
        $errores['COR_ALU'] = 'El correo no es valido';
    }
    
    if(is_numeric($SEX_ALU)){
        $SEXO_VALIDADO= true;
    }
    else{
        $errores["SEX_ALU"] ="El sexo no es valido";
    }
    
    if(!empty($PAS_ALU)){
     $PASSWORD_VALIDADO= true;
    }
    else{
           $errores['PAS_ALU'] ="La contraseña está vacía";
    }
    if($DIS_ALU>0){
        $DISTRITO_VALIDADO = true;
    }
    else{
        $errores['DIS_ALU'] = "Seleccione un distrito, por favor";
    }
    
    if($SEX_ALU>=0){
        $SEXO_VALIDADO = true;
    }
    else{
        $errores['SEX_ALU'] ="Por favor, seleccione un sexo";
    }
    
    
  if(count($valorFecha) == 3 && checkdate($valorFecha[1], $valorFecha[2], $valorFecha[0]))
  {
      $FECHA_VALIDADA = true;
  }
  else{
      $errores['FEC_ALU'] = 'Seleccione una fecha';
  }
  
    if(count($errores) == 0){
         $PASSWORD_SEGURA = password_hash($PAS_ALU, PASSWORD_BCRYPT, ['cost' => 4]);
         
    if( strtolower($_POST['registrarAlumno'])=='registrar'){             
   $SQL = "insert into tb_alumno values (null, '$NOM_ALU' , '$COR_ALU' , $SEX_ALU, '$FEC_ALU','$PASSWORD_SEGURA','$data',$DIS_ALU)";
       $guardar = mysqli_query($db, $SQL);
    }
    if(strtolower($_POST['registrarAlumno']) =='editar'){  
     $id=  (int)$_POST['ID_ALU'];
     
    $SQL = "update  tb_alumno set  NOM_ALU = '$NOM_ALU' , COR_ALU = '$COR_ALU' , SEX_ALU = $SEX_ALU, FEC_NAC_ALU = '$FEC_ALU', PAS_ALU = '$PASSWORD_SEGURA', IMG_ALU = '$data',ID_DIS = $DIS_ALU where ID_ALU = $id; ";
   $guardarEditado = mysqli_query($db, $SQL);

    }

   if(isset($guardar)){
       $_SESSION['completado'] = "<div class='alert alert-success'>Se registro correctamente!</div>";
   }
   if(isset($guardarEditado)){
              $_SESSION['completado'] = "<div class='alert alert-warning'>Se edito correctamente!</div>";
   }
   else{
      $_SESSION['errores']['general'] ="Fallo al registrar el alumno";
   }
    }
    
    else{
        $_SESSION['errores'] = $errores;
    }
    
    
}

 
header('location: ../index.php');
 
?>