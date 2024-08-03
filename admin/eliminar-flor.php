<?php
include("../config/Mysql.php");
include("../modelos/Flores.php");

$base = new Mysql();
$cx = $base->connect();
$flores = new Flores($cx);
$id=0;
if (isset($_GET['id'])){
    $id = $_GET['id'];
    
    if($flores->eliminarFlor( $id)){
        $mensaje = "Se ha eliminado el registro";
       session_start();
       $_SESSION['Mensaje']=$mensaje;
       header( "Location: listaflores.php");
    }
    
} 




?>