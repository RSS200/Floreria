<?php 
    include("../includes/header.php");
    include("../includes/menu.php");
    include("../config/Mysql.php");
    include("../modelos/Categorias.php");
    $base = new Mysql();
    $cx = $base->connect();
    $categoria = new Categorias($cx);
    $id=0;
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $cat = $categoria->getCategoria($id);
    } 
    //edita la categoria 
    if (isset($_POST['editarCategoria'])){
     
        $nombre=$_POST["nombre"];
        $activo=intval($_POST['activo']);
        $id = $_POST['id'];
        
        if ($nombre=='' || empty($nombre) || $activo==3){
            $error = "Todos los campos son obligatorios";
        } else {
            
            if ($categoria->editarCategoria($id,$nombre,$activo)) {
                $mensaje = "Se ha actualizado el registro";
               // header( "Location: usuarios.php?mensaje=".urlencode($mensaje));
               session_start();
               $_SESSION['Mensaje']='Se ha editado la variable con extito';
               header( "Location: listacategoria.php");
            } else {
                $error = "Existe un problema al actualizar";
            }
        }
    }
    
    if (isset($_POST['borrarUsuario'])){
        $id = $_POST['id'];
        if ($usuario->borrarUsuario($id)){
            $mensaje = "Se ha borrado el registro";
            header( "Location: usuarios.php?mensaje=".urlencode($mensaje));
        } else {
            $error = "Error al borrar el registro";
        }
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
       <h3>Editar Categoria</h3>
    </div>            

    <div class="row">
        <div class="col-sm-6 offset-3">
        <form method="POST" action="">

            <input type="hidden" name="id" value="<?=$cat->id?>">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el nombre" value="<?=$cat->nombre?>" >              
            </div>
            <div class="mb-3">
            <label for="" class="form-label">Activo:</label>
            <select class="form-select" aria-label="Default select example" name="activo">
                <option value="3">--Selecciona un rol--</option>
                <option value="1" <?=($cat->activo==1?'selected':'')?>>Activo</option>  
                <option value="0" <?=($cat->activo==0?'selected':'')?>>Inactivo</option>
                             
            </select>             
            </div>          
        
            <br/>
            <button type="submit" name="editarCategoria" class="btn btn-success float-left"><i class="bi bi-person-bounding-box"></i> Editar Categoria</button>
            <button type="submit" name="borrarUsuario" class="btn btn-danger float-right"><i class="bi bi-person-bounding-box"></i> Borrar Categoria</button>
            </form>
        </div>
    </div>
<?php include("../includes/footer.php") ?>
       