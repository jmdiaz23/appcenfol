<?php include('../templates/cabecera.php') ;?>
<?php include('../configuraciones/bd.php'); ?>

<?php
$txtId=(isset($_POST['txtId']))?$_POST['txtId']:"";
$txtPer=(isset($_POST['txtPer']))?$_POST['txtPer']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch ($accion) {
    case 'Agregar':
        $sentenciaSQL= $conexion->prepare("INSERT INTO perfiles (profilex) VALUES (:profilex);");
        $sentenciaSQL->bindParam(':profilex', $txtPer);
        $sentenciaSQL->execute();
        header("Location:perfiles.php");
        break;
    case 'Modificar':
        $sentenciaSQL= $conexion->prepare("UPDATE  perfiles SET profilex=:profilex WHERE id=:id");
        $sentenciaSQL->bindParam(':profilex', $txtPer);
        $sentenciaSQL->execute();
        header("Location:perfiles.php");
        break;
    
    case 'Seleccionar':
        $sentenciaSQL= $conexion->prepare("SELECT * FROM perfiles WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtId);
        $sentenciaSQL->execute();
        $min=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtPer=$min['profilex'];
        break;

    case 'borrar':
        # code...
        $sentenciaSQL= $conexion->prepare("SELECT * FROM perfiles WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtId);
        $sentenciaSQL->execute();
        $categoria=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $sentenciaSQL= $conexion->prepare("DELETE FROM perfiles WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtId);
        $sentenciaSQL->execute();
        header("Location:perfiles.php");
        break;
        
}

$sentenciaSQL= $conexion->prepare("SELECT * FROM perfiles");
$sentenciaSQL->execute();
$listaPerfiles=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="col-md-5">

<form action="" method="post">
<div class="card">
    <div class="card-header">
        Perfil Ministerial
    </div>
    <div class="card-body">
       <div class="mb-3">
        <label for="id" class="form-label">ID</label>
    <input type="text" required readonly
    class="form-control" 
    name="id" 
    id="id" 
    value="<?php echo $txtId;?>"
    aria-describedby="helpId" placeholder="ID">
  
    </div>

<div class="mb-3">
  <label for="txtPer" class="form-label">Nombre</label>
  <input type="text"
    class="form-control" 
    name="txtPer" 
    id="txtPer" 
    value="<?php echo $txtPer;?>"
    aria-describedby="helpId" placeholder="Nombre del perfil">
  
</div>

<div class="btn-group" role="group" aria-label="">
    <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
    <button type="submit" name="accion" value="Modificar" class="btn btn-warning">Editar</button>
    <button type="submit" name="accion" value="borrar" class="btn btn-danger">Borrar</button>
</div>

    </div>
    
</div>


</form>







</div>

<div class="col-md-7">
<table class="table">
    <thead>
        <tr>
           
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($listaPerfiles as $categoria){?>
        <tr>
            
            <td><?php echo $categoria['profilex'];?></td>
            <td>
                <form action="" method="post">
                <input type="hidden" name="id" id="id" value="<?php echo $txtId;?>"/>
                <input type="submit" value="Seleccionar" name="accion" class="btn btn-info">

                </form>


            </td>
        </tr>
       <?php  }?>
    </tbody>
</table>


</div>



<?php include('../templates/pie.php') ;?>