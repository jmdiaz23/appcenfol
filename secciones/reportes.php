<?php
ob_start();
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
<?php
include('../configuraciones/bd.php');

$sentenciaSQL= $conexion->prepare("SELECT * FROM personas");
$sentenciaSQL->execute();
$listapersonas=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>

<table class="table table-striped" id="tabla" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Celular</th>
                <th>Correo</th>
                <th>Fecha</th>
                <th>Tiempo</th>
                <th>Estado</th>
                <th>Perfil</th>
                <th>Profesion</th>
                <th>Foto</th>
               <!-- <th>Sede</th>
                <th>Direccion</th>
                <th>Ciudad</th>
                <th>Region</th>-->
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listapersonas as $persona) {?>
               
            
            <tr>
                <td><?php echo $persona['id']?></td>
                <td><?php echo $persona['nombres']?></td>
                <td><?php echo $persona['celular']?></td>
                <td><?php echo $persona['correo']?></td>
                <td><?php echo $persona['fecha']?></td>
                <td><?php echo $persona['tiempo']?></td>
                <td><?php echo $persona['estado']?></td>
                <td><?php echo $persona['perfil']?></td>
                <td><?php echo $persona['profesion']?></td>
                <td>
                <img class="img-thumbnail rounded" src="http://<?php echo $_SERVER['HTTP_HOST'];?>/aplicacion/img/<?php echo $persona['foto']?>" width="50" alt="" srcset=""> 
                
            
            </td>
              <!--  <td><?php //echo $persona['sede']?></td>
                <td><?php //echo $persona['direccion']?></td>
                <td><?php //echo $persona['ciudad']?></td>
                <td><?php //echo $persona['region']?></td>-->
            
            </tr>
            <?php }?>
        </tbody>
    </table>
</body>


</html>

<?php
$html=ob_get_clean();
//echo $html;

require_once('../librerias/dompdf/autoload.inc.php');

use Dompdf\Dompdf;
$dompdf= new Dompdf();

$options =$dompdf->getOptions();
$options->set(array('isRemoteEnabled'=> true));
$dompdf->setOptions($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("archivo_.pdf", array("Attachment"=>true));
?>

