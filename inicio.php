<?php include('templates/cabecera.php') ;?>
<?php include('configuraciones/bd.php'); ?>

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


#INSERT INTO `personas` (`id`, `nombres`, `celular`, `correo`, `sede`, `direccion`, `tiempo`, `fecha`, `estado`, `foto`, `participacion`, `ciudad`, `region`) VALUES (NULL, 'Jorge Diaz', '123456', 'durank448@gmail.com', 'santa marta', 'mamatoco', '2', '1994-05-23', 'casado', 'imagen.jpg', 'nacional', 'santa marta', 'costa');
#$conexionBD=BD::crearInstancia();


switch($accion){
    case "Agregar":
        $sentenciaSQL= $conexion->prepare("INSERT INTO personas ( cedula, nombres, celular, correo, sede, direccion, tiempo, fecha, estado, perfil, profesion, foto, ciudad, departamento, region) VALUES (:cedula,:nombres, :celular, :correo, :sede, :direccion, :tiempo, :fecha, :estado, :perfil, :profesion, :foto, :ciudad, :departamento, :region);");
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
    
    case "Cancelar":
        //echo "Presionando cancelar";
        header("Location:miembros.php");
        break;
    
}

$sentenciaSQL= $conexion->prepare("SELECT * FROM personas");
$sentenciaSQL->execute();
$listapersonas=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

/*$sentenciaSQL=$conexionBD->prepare("SELECT *FROM personas");
$sentenciaSQL->execute();
$listapersonas=$sentenciaSQL->fetchAll();*/

$consulta=$conexion->prepare("SELECT * FROM perfiles");
$consulta->execute();
$listaperfil=$consulta->fetchAll();





?>




<?php 
$sentenciaSQL= $conexion->prepare("SELECT count(*) totalMiembros FROM personas");
$sentenciaSQL->execute();
$persona=$sentenciaSQL->fetch(PDO::FETCH_ASSOC);
$totalMiembros=$persona['totalMiembros'];

$sentenciaSQL= $conexion->prepare("SELECT count(*) totalPerfiles FROM perfiles");
$sentenciaSQL->execute();
$registro=$sentenciaSQL->fetch(PDO::FETCH_ASSOC);
$totalPerfiles=$registro['totalPerfiles'];

?>

            <div class="col-md-12">
            <div class="p-5 bg-light">
            <div class="container">
            <h1 class="display-3">Sistema de Información </h1>
            <h3 class"lead">Bienvenido <?php echo $nombreUsuario;?></h3>
            <p class="lead">CENFOL BD</p>
            <hr class="my-2">
            <p>Mas información</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="secciones/miembros.php" role="button"  >Administrar aqui</a>
            </p>
        </div>
    
      </div>
            </div>
     <div class="mb-3">
     
     </div>
<br>
<br>
     <div class="card border-primary">
       <div class="card-body">
         <h4 class="card-title">Miembros</h4>
         <div class="btn-group" role="group" aria-label="">
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
        <input type="text" required  class="form-control"  value="<?php echo $txtCedula;?>" name="txtCedula" id="txtCedula" placeholder="Cèdula">
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
        <option >Misioneros Nuevo Ingreso</option>
        
        <?php //foreach ($listaperfil as $perfil) {  ?>
           <!-- <option><?php //echo $perfil['perfil'] ;?></option>  -->
        <?php// } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="txtPerfil" >Profesion</label>
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
        <label for="txtCiudad">Ciudad</label>
        <input type="text" class="form-control" value="<?php echo $txtCiudad;?>" name="txtCiudad" id="txtCiudad" placeholder="Digita la ciudad">
    </div>
    <div class="form-group">
        <label for="txtDepto">Departamento</label>
        <input type="text" class="form-control" value="<?php echo $txtDepto;?>" name="txtDepto" id="txtDepto" placeholder="Digita el departamento">
    </div>
    <div class="form-group">
        <label for="txtRegion">Regiòn</label>
       <!-- <input type="text" class="form-control" value="<?php #echo $txtRegion;?>" name="txtRegion" id="txtRegion" placeholder="Digita la region">-->
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
            
            <button type="submit" name="accion" <?php echo $accionCancelar;?> value="Cancelar" class="btn btn-info"><i class="bi bi-x-octagon-fill"> Cancelar</i></button>
            </div>
            </div>
        </div>
    </div>
</div>
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modelId">
  Añadir Miembro +
</button> 

<br>

        
      
        
      
   




            
        
        
    </form>
            <a class="btn btn-primary" href="secciones/miembros.php" role="button">Ver Miembros</a>
            <a class="btn btn-secondary" href="secciones/perfiles.php" role="button">Ver Perfiles</a>
            <a class="btn btn-success" href="secciones/generar-Excel.php" role="button">Informe Excel</a>
            
            </div>
       </div>
     </div>
<br/>
<br/>
<div class="mb-3">
     
     </div>
     <div class="card text-white bg-info mb-3 mie"style="max-width: 18rem; ">
     <div class="card-header">Total de miembros</div>
       <div class="card-body">
         <h4 class="card-title"><?php echo $totalMiembros;?></h4>
         <p class="card-text">Miembros registrados</p>
       </div>
     </div>

     <div class="card text-white bg-warning mb-3 mieazul" style="max-width: 18rem;">
     <div class="card-header">Total Categorias</div>
       <div class="card-body">
         <h4 class="card-title"><?php echo $totalPerfiles;?></h4>
         <p class="card-text">Perfiles registrados</p>
       </div>
     </div>
     
 <?php include('templates/pie.php') ;?>           
            
 <style>
    .btn-secondary, .bg-info{
        background-color: #722D37;
    }
    .btn-primary{
        background-color:#292F38;
    }
    .bg-warning{
        background-color:#B1B1B1;
    }
    .mie{
        background-color:#58222b !important; 
    }
    .mieazul{
        background-color:#3c4758 !important;
    }
 </style>