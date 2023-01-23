<?php include('../templates/cabecera.php') ;?>
<?php  

$txtId=(isset($_POST['txtId']))?$_POST['txtId']:"";
$txtCedula=(isset($_POST['txtCedula']))?$_POST['txtCedula']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtCelular=(isset($_POST['txtCelular']))?$_POST['txtCelular']:"";
$txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
$txtFecha=(isset($_POST['txtFecha']))?$_POST['txtFecha']:"";
$txtTiempo=(isset($_POST['txtTiempo']))?$_POST['txtTiempo']:"";
$txtEstado=(isset($_POST['txtEstado']))?$_POST['txtEstado']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$txtSede=(isset($_POST['txtSede']))?$_POST['txtSede']:"";
$txtDireccion=(isset($_POST['txtDireccion']))?$_POST['txtDireccion']:"";
$txtCiudad=(isset($_POST['txtCiudad']))?$_POST['txtCiudad']:"";
$txtRegion=(isset($_POST['txtRegion']))?$_POST['txtRegion']:"";
$txtPerfil=(isset($_POST['txtPerfil']))?$_POST['txtPerfil']:"";
$txtProfesion=(isset($_POST['txtProfesion']))?$_POST['txtProfesion']:"";
$txtDepto=(isset($_POST['txtDepto']))?$_POST['txtDepto']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

$accionAgregar="";
$accionModificar=$accionEliminar=$accionCancelar="disabled";
$mostrarModal=false;

include('../configuraciones/bd.php');
#INSERT INTO `personas` (`id`, `nombres`, `celular`, `correo`, `sede`, `direccion`, `tiempo`, `fecha`, `estado`, `foto`, `participacion`, `ciudad`, `region`) VALUES (NULL, 'Jorge Diaz', '123456', 'durank448@gmail.com', 'santa marta', 'mamatoco', '2', '1994-05-23', 'casado', 'imagen.jpg', 'nacional', 'santa marta', 'costa');
#$conexionBD=BD::crearInstancia();


switch($accion){
    case "Agregar":
        $sentenciaSQL= $conexion->prepare("INSERT INTO personas (cedula, nombres, celular, correo, sede, direccion, tiempo, fecha, estado, perfil, profesion, foto, ciudad, departamento, region) VALUES (:cedula, :nombres, :celular, :correo, :sede, :direccion, :tiempo, :fecha, :estado, :perfil, :profesion, :foto, :ciudad, :departamento :region);");
        $sentenciaSQL->bindParam(':cedula', $txtCedula);
        $sentenciaSQL->bindParam(':nombres', $txtNombre);
        $sentenciaSQL->bindParam(':celular', $txtCelular);
        $sentenciaSQL->bindParam(':correo', $txtCorreo);
        $sentenciaSQL->bindParam(':sede', $txtSede);
        $sentenciaSQL->bindParam(':direccion', $txtDireccion);
        $sentenciaSQL->bindParam(':tiempo', $txtTiempo);
        $sentenciaSQL->bindParam(':fecha', $txtFecha);
        $sentenciaSQL->bindParam(':estado', $txtEstado);
        $sentenciaSQL->bindParam(':perfil', $txtPerfil);
        $sentenciaSQL->bindParam(':profesion', $txtProfesion);

        $fecha= new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
        if($tmpImagen!=""){
            move_uploaded_file($tmpImagen,"../img/".$nombreArchivo);
        }

        $sentenciaSQL->bindParam(':foto', $nombreArchivo);
        $sentenciaSQL->bindParam(':ciudad', $txtCiudad);
        $sentenciaSQL->bindParam(':departamento', $txtDepto);
        $sentenciaSQL->bindParam(':region', $txtRegion);
        $sentenciaSQL->execute();
        header("Location:miembros.php");
        break;
    case "Modificar":
        //echo "Presionando Modificar";
        $sentenciaSQL= $conexion->prepare("UPDATE  personas SET cedula=:cedula, nombres=:nombres, celular=:celular, correo=:correo, sede=:sede, direccion=:direccion, tiempo=:tiempo, fecha=:fecha, estado=:estado, perfil=:perfil, profesion=:profesion, ciudad=:ciudad, departamento=:departamento, region=:region WHERE id=:id");
        $sentenciaSQL->bindParam(':cedula', $txtCedula);
        $sentenciaSQL->bindParam(':nombres', $txtNombre);
        $sentenciaSQL->bindParam(':celular', $txtCelular);
        $sentenciaSQL->bindParam(':correo', $txtCorreo);
        $sentenciaSQL->bindParam(':sede', $txtSede);
        $sentenciaSQL->bindParam(':direccion', $txtDireccion);
        $sentenciaSQL->bindParam(':tiempo', $txtTiempo);
        $sentenciaSQL->bindParam(':fecha', $txtFecha);
        $sentenciaSQL->bindParam(':estado', $txtEstado);

        $sentenciaSQL->bindParam(':perfil', $txtPerfil);
        $sentenciaSQL->bindParam(':profesion', $txtProfesion);
        $sentenciaSQL->bindParam(':ciudad', $txtCiudad);
        $sentenciaSQL->bindParam(':departamento', $txtDepto);
        $sentenciaSQL->bindParam(':region', $txtRegion);
        $sentenciaSQL->bindParam(':id', $txtId);
        $sentenciaSQL->execute();

        if($txtImagen!=""){

            $fecha= new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
            move_uploaded_file($tmpImagen,"../img/".$nombreArchivo);

            $sentenciaSQL= $conexion->prepare("SELECT foto FROM personas WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtId);
            $sentenciaSQL->execute();
            $persona=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            if(isset($persona["foto"])&&($persona["foto"]!="imagen.jpg")){
            if (file_exists("../img/".$persona["foto"])) {
                unlink("../img/".$persona["foto"]);
                }
            }


            $sentenciaSQL= $conexion->prepare("UPDATE  personas SET foto=:foto WHERE id=:id");
            $sentenciaSQL->bindParam(':foto', $nombreArchivo);
            $sentenciaSQL->bindParam(':id', $txtId);
            $sentenciaSQL->execute();
        }
        header("Location:miembros.php");
        break;
    case "Cancelar":
        //echo "Presionando cancelar";
        header("Location:miembros.php");
        break;
    case "Seleccionar":
        //echo "Presionando Seleccionar";
        $sentenciaSQL= $conexion->prepare("SELECT * FROM personas WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtId);
        $sentenciaSQL->execute();
        $persona=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        
        $txtCedula=$persona['cedula'];
        $txtNombre=$persona['nombres'];
        $txtCelular=$persona['celular'];
        $txtCorreo=$persona['correo'];
        $txtSede=$persona['sede'];
        $txtDireccion=$persona['direccion'];
        $txtTiempo=$persona['tiempo'];
        $txtFecha=$persona['fecha'];
        $txtEstado=$persona['estado'];
        $txtPerfil=$persona['perfil'];
        $txtProfesion=$persona['profesion'];
        $txtImagen=$persona['foto'];
        $txtCiudad=$persona['ciudad'];
        $txtDepto=$persona['departamento'];
        $txtRegion=$persona['region'];

        $accionAgregar="disabled";
        $accionModificar=$accionEliminar=$accionCancelar="";
        $mostrarModal=true;
        break;
    case "Borrar":
        //echo "Presionando Borrar";
        $sentenciaSQL= $conexion->prepare("SELECT foto FROM personas WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtId);
        $sentenciaSQL->execute();
        $persona=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        if(isset($persona["foto"])&&($persona["foto"]!="imagen.jpg")){
            if (file_exists("../img/".$persona["foto"])) {
                unlink("../img/".$persona["foto"]);
            }
        }
        $sentenciaSQL= $conexion->prepare("DELETE FROM personas WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtId);
        $sentenciaSQL->execute();
        header("Location:miembros.php");
        break;
}

#$sentenciaSQL= $conexion->prepare("SELECT * FROM personas");
$sentenciaSQL= $conexion->prepare("SELECT * FROM personas ORDER BY nombres");
$sentenciaSQL->execute();
$listapersonas=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

/*$sentenciaSQL=$conexionBD->prepare("SELECT *FROM personas");
$sentenciaSQL->execute();
$listapersonas=$sentenciaSQL->fetchAll();*/

$consulta=$conexion->prepare("SELECT * FROM perfiles");
$consulta->execute();
$listaperfil=$consulta->fetchAll();





?>
<!-- Button trigger modal -->

<form method="POST" enctype="multipart/form-data">
<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Miembros</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                <div class="form-group">
        
        <label for="txtId">ID</label>
        <input type="text" required readonly class="form-control"  value="<?php echo $txtId;?>" name="txtId" id="txtId" placeholder="ID">
    </div>

    <div class="form-group">
        <label for="txtCedula">Cedula</label>
        <input type="number" required  class="form-control"  value="<?php echo $txtCedula;?>" name="txtCedula" id="txtCedula" placeholder="CC">
    </div>
    <div class="form-group">
        <label for="txtNombre">Nombre Completo</label>
        <input type="text" required class="form-control" value="<?php echo $txtNombre;?>" name="txtNombre" id="txtNombre" placeholder="Tu nombre">
    </div>

    <div class="form-group">
        <label for="txtCelular">Celular</label>
        <input type="number" class="form-control" value="<?php echo $txtCelular;?>" name="txtCelular" id="txtCelular" placeholder="Digita el celular">
    </div>

    <div class="form-group">
        <label for="txtCorreo">Correo Electronico</label>
        <input type="email" class="form-control" value="<?php echo $txtCorreo;?>" name="txtCorreo" id="txtCorreo" placeholder="Digita el correo">
    </div>
    <div class="form-group">
        <label for="txtFecha">Fecha de Nacimiento</label>
        <input type="date" class="form-control" value="<?php echo $txtFecha;?>" name="txtFecha" id="txtFecha" placeholder="Digita la fecha de nacimiento">
    </div>
    <div class="form-group">
        <label for="txtTiempo">Tiempo de Servicio</label>
        <input type="number" class="form-control" value="<?php echo $txtTiempo;?>" name="txtTiempo" id="txtTiempo" placeholder="Tiempo en servicio">
    </div>
    <div class="form-group">
        <label for="txtEstado">Estado Civil</label>
        <!--<input type="text" class="form-control" value="<?php //echo $txtEstado;?>" name="txtEstado" id="txtEstado" placeholder="Estado Civil">-->
        <select class="form-control" name="txtEstado" id="txtEstado"
        <option selected>Selecciona...</option>
        <option >Casado (a)</option>
        <option >Soltero (a)</option>
        <option >Viudo (a)</option>
    
        </select>
    </div>
    <div class="form-group">
        <label for="txtPerfil" >Perfil Ministerial</label>
       <!--<input type="text" class="form-control" value="<?php //echo $txtPerfil;?>" name="txtPerfil" id="txtPerfil" placeholder="Perfil ministerial">-->
       <select class="form-control" name="txtPerfil" id="txtPerfil"
        <option selected>Selecciona...</option>
        <option >Tiempo Completo</option>
        <option >Hijos TC</option>
        <option >Paulinos</option>
        <option >Directores Pais</option>
        <option >Misioneros de nuevo ingreso</option>
        
        <?php //foreach ($listaperfil as $perfil) {  ?>
           <!-- <option><?php //echo $perfil['perfil'] ;?></option>  -->
        <?php// } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="txtProfesion" >Profesiòn</label>
        <input type="text" class="form-control" value="<?php echo $txtProfesion;?>" name="txtProfesion" id="txtProfesion" placeholder="Profesion">
    </div>

    <div class="form-group">
        <label for="txtImagen">Foto:</label>
        <br/>
            <?php
                if($txtImagen!=""){ ?>

                <img class="img-thumbnail rounded" src="../img/<?php echo $txtImagen;?>" width="50" alt="" srcset="">


            <?php
            }
            ?>
            <input type="file"  class="form-control" name="txtImagen" id="txtImagen" placeholder="Tu foto">
    </div>

    <br>
    <div class="form-group">
        <h3>Datos sede</h3>
        <label for="txtSede">Nombre de la sede</label>
        <input type="text" class="form-control" value="<?php echo $txtSede;?>" name="txtSede" id="txtSede" placeholder="Digita la sede">
    </div>

    <div class="form-group">
        <label for="txtDireccion">Direccion de la sede</label>
        <input type="text" class="form-control" value="<?php echo $txtDireccion;?>" name="txtDireccion" id="txtDireccion" placeholder="Digita la sede">
    </div>
    <div class="form-group">
        <label for="txtCiudad">Ciudad </label>
        <input type="text" class="form-control" value="<?php echo $txtCiudad;?>" name="txtCiudad" id="txtCiudad" placeholder="Digita la ciudad">
    </div>
    <div class="form-group">
        <label for="txtDepto">Departamento</label>
        <input type="text" class="form-control" value="<?php echo $txtDepto;?>" name="txtDepto" id="txtDepto" placeholder="Digita el departamento">
    </div>
    <div class="form-group">
        <label for="txtRegion">Regiòn</label>
        <!--<input type="text" class="form-control" value="<?php echo $txtRegion;?>" name="txtRegion" id="txtRegion" placeholder="Digita el departamento">-->
        <select class="form-control" name="txtRegion" id="txtRegion"
        <option selected>Selecciona...</option>
        <option >Aburrá Sur</option>
        <option >Cali</option>
        <option >Cauca</option>
        <option >Centro</option>
        <option >Costa Caribe</option>
        <option >Costa Sabana</option>
        <option >Eje cafetero</option>
        <option >Medellin Occidente</option>
        <option >Medellin Centro</option>
        <option >Ñariño</option>
        <option >Poblado</option>
        <option >Santanderes</option>
        <option >Valle del Cauca</option>
        <option >Centro Norte</option>
        <option >Centro sur Llanos</option>
        
        <?php //foreach ($listaperfil as $perfil) {  ?>
           <!-- <option><?php //echo $perfil['perfil'] ;?></option>  -->
        <?php// } ?>
        </select>
    </div>
            </div>
            </div>
            <div class="modal-footer">
            <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="accion" <?php echo $accionAgregar;?> value="Agregar" class="btn btn-success"><i class="bi bi-plus-circle"> Agregar</i></button>
            <button type="submit" name="accion" <?php echo $accionModificar;?> value="Modificar" class="btn btn-warning"><i class="bi bi-pencil-fill"> Editar</i></button>
            <button type="submit" name="accion" <?php echo $accionCancelar;?> value="Cancelar" class="btn btn-info"><i class="bi bi-x-octagon-fill"> Cancelar</i></button>
            </div>
            </div>
        </div>
    </div>
</div>
<button type="button" class="btn btn-primary rojobt" data-bs-toggle="modal" data-bs-target="#modelId">
  Añadir Miembro +
</button>
<style>
    .rojobt{
        background-color: #58222b !important;
    }
</style>
<br>


 <!-- <div class="col-md-3" id="mover">
 
      <div class="card">
        <div class="card-header">
            Miembros
        </div>
        <div class="card-body">
          
            <form method="POST" enctype="multipart/form-data">-->


            <!-- Button trigger modal -->



        
<!--</div>-->
        
      
        
      
   




            
        
        
    </form>
   <!-- </div>
    <br>
    </div>   -->
    
<br/>
<div class="col-md-12">
<br/>


<a class="btn btn-danger" href="reportes.php" role="button"><i class="bi bi-filetype-pdf">PDF</i></a>
<a class="btn btn-success" href="generar-Excel.php" role="button"><i class="bi bi-filetype-xls">Excel</i></a>

<br/>
    <table class="table table-bordered" id="tabla" >
        <thead>
            <tr>
                
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Celular</th>
                <th>Correo</th>
                <th>Cumpleaños</th>
                <th>Tiempo</th>
                <th>Estado</th>
                <th>Perfil</th>
                <th>Profesion</th>
                <th>Foto</th>
                <th>Sede</th>
                <th>Direccion</th>
                <th>Ciudad</th>
                <th>Departamento</th>
                <th>Region</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listapersonas as $persona) {?>
               
            
            <tr>
               
                <td><?php echo $persona['cedula']?></td>
                <td><?php echo $persona['nombres']?></td>
                <td><?php echo $persona['celular']?></td>
                <td><?php echo $persona['correo']?></td>
                <td><?php echo $persona['fecha']?></td>
                <td><?php echo $persona['tiempo']?></td>
                <td><?php echo $persona['estado']?></td>
                <td><?php echo $persona['perfil']?>
                   
            
            </td>
                    
                
               
            
                <td><?php echo $persona['profesion']?></td>
                <td>
                <img class="img-thumbnail rounded" src="../img/<?php echo $persona['foto']?>" width="50" alt="" srcset=""> 
                
            
            </td>
                <td><?php echo $persona['sede']?></td>
                <td><?php echo $persona['direccion']?></td>
                <td><?php echo $persona['ciudad']?></td>
                <td><?php echo $persona['departamento']?></td>
                <td><?php echo $persona['region']?></td>
                <td>
                
               

                <form  method="post" class="d-inline">
                    <input type="hidden" name="txtId" id="txtId" value ="<?php echo $persona['id']?>">
                    <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary ">
                    <input type="submit" name="accion"  value="Borrar" class="btn btn-danger">
                    
                    <a class="btn btn-success" href="secciones/ver_miembros.php?id=<?php $persona['id']?>" role="button">Ver</a>
                </form>
            </td>
            </tr>
            <?php }?>
        </tbody>
    </table>
    
</div>
            </div>
<?php if($mostrarModal){?>
    <script>
        //$('#modelId').modal('show');
       // $('#modelId').on('shown.bs.modal', function () {
        //$('#modelId').trigger('focus')
        var myModal = document.getElementById('modelId')
        var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})
 
        
       
        
//})
    </script>
<?php }?>

<script>
    var tabla = document.querySelector("#tabla");
    var dataTable = new DataTable(tabla, {
	perPage: 3,
	perPageSelect: [3,6,9,12],
});

</script>

<?php include('../templates/pie.php') ;?>