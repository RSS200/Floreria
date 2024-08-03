<?php 
    include("../includes/header.php");
    include("../includes/menu.php");
    include("../config/Mysql.php");
    include("../modelos/Usuario.php");
    if (!$_SESSION['auth']){
        header('Location: ../login.php');
    }
    $base = new Mysql();
    $cx = $base->connect();
    $usuario = new Usuario($cx);
    $id=0;
    
    if (isset($_POST['crearUsuario'])){
     
        $nombre=$_POST["nombre"];
        $nombreusuario =$_POST['usuario'];
        $contrasena =$_POST['contrasena'];
        $admin=intval($_POST['admin']);
        
        if ($nombre=='' || empty($nombre) || $nombreusuario=='' || empty($nombreusuario) || $admin==0){
            $error = "Todos los campos son obligatorios";
        } else {
            
            if ($usuario->crearUsuario( $nombre,$nombreusuario,$admin, $contrasena)) {
                $mensaje = "Se ha insertado el registro";
               // header( "Location: usuarios.php?mensaje=".urlencode($mensaje));
               session_start();
               $_SESSION['Mensaje']='Se ha insertado la variable con extito';
               header( "Location: listausuarios.php");
            } else {
                $error = "Existe un problema al actualizar";
            }
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
       <h3>Crear Usuario</h3>
    </div>            

    <div class="row">
        <div class="col-sm-6 offset-3">
        <form method="POST" action="">


            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el nombre"  >              
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">usuario:</label>
                <input type="usuario" class="form-control" name="usuario" id="usuario" placeholder="Ingresa el usuario"  >               
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Contraseña:</label>
                <input type="text" class="form-control" name="contrasena" id="contrasena" placeholder="Ingresa la contraseña"  >              
            </div>
            <div class="mb-3">
            <label for="" class="form-label">Rol:</label>
            <select class="form-select" aria-label="Default select example" name="admin">
                <option value="1" >Administrador</option>  
                <option value="2" >Usuario</option>
                             
            </select>             
            </div>          
        
            <br />
            <button type="submit" name="crearUsuario" class="btn btn-success float-left"><i class="bi bi-person-bounding-box"></i> Crear Usuario</button>

            </form>
        </div>
    </div>
<?php include("../includes/footer.php") ?>
       