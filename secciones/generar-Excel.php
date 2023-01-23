<?php
ob_start();
?>
<?php
include('../configuraciones/bd.php');


$sentenciaSQL= $conexion->prepare("SELECT * FROM personas");
$sentenciaSQL->execute();
$listapersonas=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=usuarios_".time().".xls");
header("Pragma: no-cache");
header("Expires: 0");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">
</head>
<body>

<table>
    <caption> Datos miembros</caption>
    <tr>
        <th>ID</th>
        <th>Cedula</th>
        <th>Nombre Completo</th>
        <th>Celular</th>
        <th>Correo Electronico</th>
        <th>Sede</th>
        <th>Direccion</th>
        <th>Tiempo de servicio</th>
        <th>Fecha de nacimiento</th>
        <th>Estado Civil</th>
        <th>Perfil Ministerial</th>
        <th>Profesion</th>
        <th>Ciudad</th>
        <th>Region</th>
        
    </tr>
    <tr>
    <?php foreach ($listapersonas as $persona) {?>
                <td><?php echo $persona['id']?></td>
                <td><?php echo $persona['cedula']?></td>
                <td><?php echo $persona['nombres']?></td>
                <td><?php echo $persona['celular']?></td>
                <td><?php echo $persona['correo']?></td>
                <td><?php echo $persona['sede']?></td>
                <td><?php echo $persona['direccion']?></td>
                <td><?php echo $persona['tiempo']?></td>
                <td><?php echo $persona['fecha']?></td>
                <td><?php echo $persona['estado']?></td>
                <td><?php echo $persona['perfil']?>
                <td><?php echo $persona['profesion']?></td>
               
                
                <td><?php echo $persona['ciudad']?></td>
                <td><?php echo $persona['region']?></td>
    </tr>
    <?php }?>
</table>