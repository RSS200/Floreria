<?php
include("../config/Mysql.php");
include("../modelos/Usuario.php");

$base = new Mysql();
$cx = $base->connect();
$usuario = new Usuario($cx);
$id=0;
if (isset($_GET['id'])){
    $id = $_GET['id'];
    
    if($usuario->eliminarUsuario( $id)){
        $mensaje = "Se ha eliminado el registro";
       session_start();
       $_SESSION['Mensaje']=$mensaje;
       header( "Location: listausuarios.php");
    }
    
} 




?>