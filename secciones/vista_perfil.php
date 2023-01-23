<?php include('../templates/cabecera.php') ;?>
<?php include('../secciones/perfil.php') ;?>

<div class="col-md-5">

<form action="" method="post">
<div class="card">
    <div class="card-header">
        Perfil Ministerial
    </div>
    <div class="card-body">
       <div class="mb-3">
        <label for="id" class="form-label">ID</label>
    <input type="text"
    class="form-control" 
    name="id" 
    id="id" 
    value="<?php echo $id;?>"
    aria-describedby="helpId" placeholder="ID">
  
    </div>

<div class="mb-3">
  <label for="nombre_perfil" class="form-label">Nombre</label>
  <input type="text"
    class="form-control" 
    name="nombre_perfil" 
    id="nombre_perfil" 
    value="<?php echo $nombre_perfil; ?>"
    aria-describedby="helpId" placeholder="Nombre del perfil">
  
</div>

<div class="btn-group" role="group" aria-label="">
    <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button>
    <button type="submit" name="accion" value="editar" class="btn btn-warning">Editar</button>
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
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($listaPerfiles as $perfil){?>
        <tr>
            <td><?php echo $perfil['id']?></td>
            <td><?php echo $perfil['perfil']?></td>
            <td>
                <form action="" method="post">
                <input type="hidden" name="id" id="id" value="<?php echo $perfil['id'];?>"/>
                <input type="submit" value="Seleccionar" name="accion" class="btn btn-info">

                </form>


            </td>
        </tr>
       <?php  }?>
    </tbody>
</table>


</div>




<?php include('../templates/pie.php') ;?>