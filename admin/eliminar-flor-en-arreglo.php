<?php
include("../config/Mysql.php");
include("../modelos/Arreglo.php");

$base = new Mysql();
$cx = $base->connect();
$arreglo = new Arreglo($cx);
$id=0;
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $idArreglo = $_GET['idArreglo'];
    
    if($arreglo->eliminarFlor( $id)){
        $mensaje = "Se ha eliminado el registro";
       session_start();
       $_SESSION['Mensaje']=$mensaje;
       header( "Location: editar-arreglo.php?idArreglo=".$idArreglo);
    }
    
} 




?>