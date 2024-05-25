<?php 
    include("../includes/header.php");
    include("../includes/menu.php");
    include("../config/Mysql.php");
    include("../modelos/Usuario.php");
    $base = new Mysql();
    $cx = $base->connect();
    $usuario = new Usuario($cx);
    $id=0;
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $user = $usuario->getUser($id);
    } 
    if (isset($_POST['editarUsuario'])){
     
        $nombre=$_POST["nombre"];
        $nombreusuario =$_POST['usuario'];
        $admin=intval($_POST['admin']);
        $id = $_POST['id'];
        
        if ($nombre=='' || empty($nombre) || $nombreusuario=='' || empty($nombreusuario) || $admin==0){
            $error = "Todos los campos son obligatorios";
        } else {
            
            if ($usuario->editarUsuario($id, $nombre,$nombreusuario,$admin)) {
                $mensaje = "Se ha actualizado el registro";
               // header( "Location: usuarios.php?mensaje=".urlencode($mensaje));
               session_start();
               $_SESSION['Mensaje']='Se ha editado la variable con extito';
               header( "Location: listausuarios.php");
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
        <?php if (isset($mensaje)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?= $mensaje ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>
</div>

    <div class="titulos text-center container m-5">
       <h3>Editar Usuario</h3>
    </div>            

    <div class="row">
        <div class="col-sm-6 offset-3">
        <form method="POST" action="">

            <input type="hidden" name="id" value="<?=$user->id?>">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el nombre" value="<?=$user->nombre?>" >              
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">usuario:</label>
                <input type="usuario" class="form-control" name="usuario" id="usuario" placeholder="Ingresa el usuario" value="<?=$user->usuario?>" >               
            </div>
            <div class="mb-3">
            <label for="" class="form-label">Rol:</label>
            <select class="form-select" aria-label="Default select example" name="admin">
                <option value="0">--Selecciona un rol--</option>
                <option value="1" <?=($user->admin==1?'selected':'')?>>Administrador</option>  
                <option value="2" <?=($user->admin==0?'selected':'')?>>Usuario</option>
                             
            </select>             
            </div>          
        
            <br />
            <button type="submit" name="editarUsuario" class="btn btn-success float-left"><i class="bi bi-person-bounding-box"></i> Editar Usuario</button>

            <button type="submit" name="borrarUsuario" class="btn btn-danger float-right"><i class="bi bi-person-bounding-box"></i> Borrar Usuario</button>
            </form>
        </div>
    </div>
<?php include("../includes/footer.php") ?>
       