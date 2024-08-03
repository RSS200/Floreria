<?php
include("../config/Mysql.php");
include("../modelos/Categorias.php");

$base = new Mysql();
$cx = $base->connect();
$categoria = new Categorias($cx);
$id=0;
if (isset($_GET['id'])){
    $id = $_GET['id'];
    
    if($categoria->eliminarCategoria( $id)){
        $mensaje = "Se ha eliminado el registro";
       session_start();
       $_SESSION['Mensaje']=$mensaje;
       header( "Location: listacategoria.php");
    }
    
} 




?>