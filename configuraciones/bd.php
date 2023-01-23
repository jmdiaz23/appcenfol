<?php


$host ="localhost";
$bd="aplicacion";
$usuario="root";
$contrasena="";

try {
    $conexion=new PDO ("mysql:host=$host; dbname=$bd",$usuario, $contrasena);
   # if($conexion){echo"conectado...";}
} catch (Exception $ex) {
    echo $ex->getMessage();
}


/*class BD{
    public static $instancia=null;
    public static function crearInstancia(){
        if (!isset (self::$instancia)) {
            # code...
            $opciones[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
            self::$instancia=new PDO ('mysql:host=localhost; dbname=aplicacion' ,'root', '', $opciones);
            #echo "conectado...";
        }

        return self::$instancia;
    }
}*/
?>