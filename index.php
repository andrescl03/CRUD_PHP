<?php
session_start(); ?>  
<?php require_once './includes/cabecera.php';?>
 <?php require_once 'helpers.php';?>       

<div class="container-fluid">
    <center><h1 class="text-info font-weight-bold">Registro de Alumno</h1></center>
    <div class="row">  
        
        <div class="col-3">
        <div class="card border-success">
            <div class="card-header bg-primary">
                <center>  <label class="font-weight-bold"> Formulario de Alumnos</label></center> 
            </div>
            <form action="controller/AlumnoController.php" method="POST" enctype="multipart/form-data">
            <div class="card-body ">
               
            
                    <div class="form-group">
                        
                        <?php 
                    echo   $cadena =  isset($_SESSION['completado'])? $_SESSION['completado']  :  '';  ?>
                      
                        <label class="font-weight-bold" for="NOM_ALU">Nombre completo</label>
                        <input type="text" class="form-control" placeholder="Ingrese el nombre..." name="NOM_ALU"/>
                        <input type="hidden" name="ID_ALU"/>
                            <?php 
                       echo    $cadenaNombre =  isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'NOM_ALU') : '' ;      
                          ?>
                    </div>
                            <div class="form-group">
                         <label class="font-weight-bold" for="COR_ALU">Correo</label>
                        <input autocomplete="new-email" type="email" class="form-control" placeholder="Ingrese el correo..." name="COR_ALU"/>
                        <?php              
                       echo   $cadenaEmail =  isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'COR_ALU') : '' ;
                        ?>
                          </div>
                                       
                            <div class="form-group">
                        <label class="font-weight-bold" for="SEX_ALU">Sexo</label>
                        <select name="SEX_ALU" class="form-control">
                            <option value="-1">[Seleccione]</option>
                            <option value="0">Masculino</option>
                               <option value="1">Femenino</option>
                        </select>
                        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], "SEX_ALU") : '' ;?>
                    </div>
                            
                      <div class="form-group">
                        <label class="font-weight-bold" for="FEC_ALU">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" name="FEC_ALU"/>
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'FEC_ALU') : '' ?>
                      </div>
                    
                       <div class="form-group">
                        <label class="font-weight-bold" for="PAS_ALU">Password</label>
                        <input  autocomplete="new-password"  type="password" class="form-control" name="PAS_ALU"/>
                          <?php              
                       echo $cadenaPassword =  isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'PAS_ALU') : '' ;
                        ?>
                       </div>
              <div class="form-group">
                        <label class="font-weight-bold" for="Distrito">Distrito</label>
                        <select  name="DISTRITO" class="form-control">
                            
                            <option value="-1">[Seleccione]</option>
                        </select>
                         <?php              
                       echo $cadenaDistrito =  isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'DIS_ALU') : '' ;
                        ?>
                    </div>
                
                <div class="form-group">
                    <label>Imagen</label>
                    <input type="file"  class="form-control" name="IMG_ALU" value="Subir Imagen"/>
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'IMG_ALU') : '' ?>
                </div>
            </div>
            
            <div class="card-footer border-primary">
                <div class="form-group">
                    
                <input  type="submit" value="Registrar" class="form-control mt-auto bg-primary font-weight-bold" name="registrarAlumno"/>
                
            </div>
                </div>
                 </form>
        </div>
        </div>
        
        <div class="col-9">
            
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Sexo</th>
                        <th>Nacimiento</th>
                        <th>Distrito </th>
                        <th> </th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    
                </tbody>
            </table>
        </div>
    </div>
    
</div>
    
    
    <!--Pie de pagina-->
    <?php require_once './includes/pie.php';?>
    