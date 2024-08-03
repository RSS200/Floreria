<?php 
    include("../includes/header.php");
    include("../includes/menu.php");
    include("../config/Mysql.php");
    include("../modelos/Categorias.php");
    if (!$_SESSION['auth']){
        header('Location: ../login.php');
    }
    $base = new Mysql();
    $cx = $base->connect();
    $categoria = new Categorias($cx);
    $id=0;
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $cat = $categoria->getCategoria($id);
    } 
    //CREA LA CATEGORIA
    if(isset($_POST['CrearCategoria'])){
        $nombre=$_POST["nombre"];
        $activo=intval($_POST['activo']);
        if($nombre=='' || empty($nombre) || $activo==3){
            $error = "Todos los campos son obligatorios";
        }else{
            if($categoria->crearCategoria($nombre, $activo)){
                $mensaje = "Se ha actualizado el registro";
               session_start();
               $_SESSION['Mensaje']='Se ha agregado la categoria con extito';
               header( "Location: listacategoria.php");
            }
        }
    }else{
        $error = "Error al borrar el registro";
    }
   
?>
    <!--Imprimir el error o el mensaje -->

<div class="row">
    <div class="col-sm-12">
        <?php if (isset($_SESSION['Mensaje'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $_SESSION['Mensaje'] ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>
</div>

    <div class="titulos text-center container m-5">
       <h3>Crear Categoria</h3>
    </div>            

    <div class="row">
        <div class="col-sm-6 offset-3">
        <form method="POST" action="">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el nombre" >              
            </div>
            <div class="mb-3">
            <label for="" class="form-label">Activo:</label>
            <select class="form-select" aria-label="Default select example" name="activo">
                <option value="1">Activo</option>  
                <option value="0">Inactivo</option>
                             
            </select>             
            </div>          
        
            <br/>
            <button type="submit" name="CrearCategoria" class="btn btn-success float-left"><i class="bi bi-person-bounding-box"></i> Crear Categoria</button>
            <a href="listacategoria.php" class="btn btn-warning">Cancelar</a>
            </form>
        </div>
    </div>
<?php include("../includes/footer.php") ?>
       