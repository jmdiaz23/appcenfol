<?php
session_start();


    if($_POST){
      if(($_POST['usuario']=="caroprada")&&($_POST['contrasena']=="caroprada@")){
        $_SESSION['usuario']="ok";
        $_SESSION['nombreUsuario']="caroprada";
        header('location:inicio.php'); 
      }else{
        $mensaje="Error en la autentificacion";
      }
        
    }

?>
<!doctype html>
<html lang="es">
  <head>
    <title>Aplicacion</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css">
  </head>
  <body>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4">
            <br><br><br>
                <div class="card">
                    
                    <div class="card-header">
                        Inicio de Sesión
                    </div>
                    <div class="card-body">
                      <?php if(isset($mensaje)) {?>
                      <div class="alert alert-danger" role="alert">
                        <?php echo $mensaje;?>
                      </div>
                      <?php } ?> 
                      <div class="text-center">
                      <img src="./img/logo-v1.png" width="200" height="198" alt="Responsive image">
                          </div>
                      
                      <br/>
                       <form method="POST">
                        <div class="form-floating mb-3">
                          <br>
                          <label for="floatingInput">Usuario</label>
                          <input type="text" name="usuario" id="" class="form-control" placeholder="Escriba Usuario" >
                         
                        </div>
                        <div class="form-floating">
                          <br>
                          <label for="floatingInput">Contraseña</label>
                          <input type="password" name="contrasena" class="form-control" placeholder="Escriba la contraseña">
                          
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                       </form>
                    </div>
                    
                </div>
            </div>
            
            
        </div>
    </div>
       <!--sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy-->
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>
<style>
  .btn-primary{
    background-color:#722D37;
  }
  

  
</style>
