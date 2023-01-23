<?php
include_once '../configuraciones/bd.php';
$conexionBD=BD::crearInstancia();

$id=isset($_POST['id'])?$_POST['id']:'';
$nombre_perfil=isset($_POST['nombre_perfil'])?$_POST['nombre_perfil']:'';
$accion=isset($_POST['accion'])?$_POST['accion']:'';

if($accion!=''){
    switch ($accion) {
        case 'agregar':
            $sql="INSERT INTO perfiles (id, perfil) VALUES (NULL, :nombre_perfil)";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':nombre_perfil', $nombre_perfil);
            $consulta->execute();
            break;
        case 'editar':
            $sql="UPDATE perfiles SET perfil=:nombre_perfil WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id', $id);
            $consulta->bindParam(':nombre_perfil', $nombre_perfil);
            $consulta->execute();
            break;
        case 'borrar':
            $sql="DELETE FROM perfiles WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam(':id', $id);
            $consulta->execute();
            break;
            
        case 'Seleccionar':
            $sql="SELECT * FROM perfiles WHERE id=:id";
            $consulta=$conexionBD->prepare($sql);
            $consulta->bindParam('id',$id);
            $consulta->execute();
            $perfil=$consulta->fetch(PDO::FETCH_ASSOC);
            $nombre_perfil=$perfil['perfil'];
            break;
            
    }
}

$consulta=$conexionBD->prepare("SELECT *FROM perfiles");
$consulta->execute();
$listaPerfiles=$consulta->fetchAll();

?>