<?php
session_start();
  if(!isset($_SESSION['usuario'])){
    header("Location:../index.php");
  }else{
    if($_SESSION['usuario']=="ok"){
      $nombreUsuario=$_SESSION["nombreUsuario"];
    }
  }
?>
<!doctype html>
<html lang="es">
  <head>
    <title>inicio</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    
    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Vanilla DataTables -->
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--Chart js-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>

    <style>
        .navbar {
            background-color: #3C4357 !important;
        }
</style>

    

    


  </head>
  <body>
    <?php $url ="http://".$_SERVER['HTTP_HOST']."/aplicacion"?>
    <nav class="navbar navbar-expand navbar-dark bg-primary">
        <div class="nav navbar-nav d-flex" >
        <a class="navbar-brand" href="<?php echo $url;?>/inicio.php">
      <img src="http://localhost/aplicacion/img_2/logo.png" alt="logo" width="54" height="44" class="d-inline-block align-text-top responsive">
      
    </a>
            <a class="nav-item nav-link active mr-auto p-2" href="#">Sistema de informacion <span class="visually-hidden">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/inicio.php">Inicio</a>
            
            <a class="nav-item nav-link p-2" href="<?php echo $url;?>/secciones/miembros.php">Miembros</a>
            <a class="nav-item nav-link p-2" href="<?php  echo $url;?>/secciones/perfiles.php">Perfil Ministerial</a>
            <a class="nav-item nav-link btn btn-danger float-end p-2" href="<?php echo $url;?>/secciones/cerrar.php">Cerrar sesion</a>
        </div>
    </nav>
    <div class="container">
        <br/>
        <div class="row">
      
        