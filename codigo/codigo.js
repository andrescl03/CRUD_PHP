         var listaAlumno = [];

$(document).ready(function(){
     var data ;
    
  $.ajax({
       type: 'POST',
       dataType: 'json',
      url: "controller/DistritoController.php",
     data: data,
    success: function (data, textStatus, jqXHR) {
   
     
         $.each(data, function(index,item){
             $('<option/>').attr("value",item.id_distrito).text(item.nombre_distrito).appendTo("select[name=DISTRITO]");
         });
     }
        });
        
        
     $.ajax({
         type:'GET',
         dataType: 'json',
         url:"controller/ListaAlumnoController.php",
         data:data,
         success: function (data, textStatus, jqXHR) {
                 listaAlumno.push(data);
             $.each(data, function(index,item){
           
                     
                var sexoAlumno=  (item.sexo_alumno==0) ?  "Masculino": "femenino";
               
                 $('<tr>').append(
                         $('<td>').append(
                            $('<img>',{
                                src:  "data:image/jpeg;base64," + item.imagen_alumno,
                                width:"100px",
                                height:"100px"
                            }) ),
                                              $('<td>').text(item.nombre_alumno) ,
                                              $('<td>').text(item.correo_alumno) ,
                                              $('<td>').text(sexoAlumno),
                                              $('<td>').text(item.fecha_alumno),
                                              $('<td>').text(item.Distrito.nombre_distrito),
                                              $('<td>').append(
                                                      $('<input>',{
                                                        class : 'btn btn-warning',
                                                        type:'button',
                                                        value:'Editar',
                                                        onclick:`fn_editarAlumno(${item.id_alumno})`})
                                                        ),     
                                                $('<td>').append(
                                                      $('<input>',{
                                                        class : 'btn btn-danger',
                                                        type:'button',
                                                        value:'Eliminar',
                                                        onclick:`fn_eliminarAlumno('${item.id_alumno}')`})
                                                        )).             
                         appendTo("#tbody");

               
            });
             
        
        }
     })
     
   
      });
      
 function fn_editarAlumno(data){
      console.log(listaAlumno);
      
   for(var i=0; i<listaAlumno[0].length;i++){
       
      console.log(listaAlumno[0][i]);
        if(listaAlumno[0][i].id_alumno == data){
                        $('input[name=registrarAlumno]').val('Editar').attr('class','form-control mt-auto bg-warning font-weight-bold');
                        $('input[name=PAS_ALU]').val('encriptada');
                        $('input[name=ID_ALU]').val(listaAlumno[0][i].id_alumno);
                         $('select[name=SEX_ALU]').val(listaAlumno[0][i].sexo_alumno);
                         $('input[name=FEC_ALU]').val(listaAlumno[0][i].fecha_alumno);
                        $('input[name=NOM_ALU]').val(listaAlumno[0][i].nombre_alumno);
                        $('input[name=COR_ALU]').val(listaAlumno[0][i].correo_alumno);
                        $('input[name=NOM_ALU]').val(listaAlumno[0][i].nombre_alumno);
                        $('input[name=NOM_ALU]').val(listaAlumno[0][i].nombre_alumno);
                        $('select[name=DISTRITO]').val(listaAlumno[0][i]['Distrito'].id_distrito);

       }
    }
      
    
 }     
 function  fn_eliminarAlumno(data){
         $.ajax({
          type:'POST',
         url:"controller/AlumnoController.php",
            data:{
             fn_eliminar:'eliminar', 
             id_alu: data},
         success: function (data, textStatus, jqXHR) {
        location.reload();

        }
         });
     }
     