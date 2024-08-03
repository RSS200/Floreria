<?php 
    include("includes/header.php");
    include("config/Mysql.php");
    include("modelos/Usuario.php");
    //session_start();
    //session_destroy();
    $base = new Mysql();
    $cx =  $base->connect();
    $user = new Usuario($cx);
    if (isset($_POST['acceder'])){
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        if ($usuario=='' || empty($usuario) || $password == '' || empty($password)){
            $error = "Todos los campos son obligatorios";
        }else{
            if ($user->login($usuario, $password)){
                $mensaje = "Usuario identificado";
                $u = $user->consultaUsuario($usuario);
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $u->id;
                $_SESSION['nombre'] = $u->nombre;
                $_SESSION['rol_id'] = $u->admin;
                header('Location:index.php'); 
            } else {
                $error = "Credenciales inválidas";
            }
        }
    }
?>

<style>
    .contenedor-login{
        margin-top: 150px;
        background: pink;
        padding: 50px;
        border-radius: 10px;
        width: 800px;
        border: #855a75 solid 10px;
    }
    .contenedor-login h1{
        text-align: center;
        font-size: 60px;
        color: #855a75;

    }
    .contenedor-login div{
        margin-top: 30px;
    }
    .contenedor-login div label{
        margin-bottom:  10px;            
    }
    .contenedor-login  input[type="submit"]{
        background: #855a75;
        color: #fff;
        margin-top:  30px;
        width:  100%;
        padding: 10px;
    }
</style>

 <!--Imprimir el error o el mensaje -->
 <div class="row">
    <div class="col-sm-12">
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $error ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>
</div>
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



<div class="container contenedor-login">
    <h1>Login</h1>
    <form method="POST">
        <div class="form-group">
            <label >Ingresa tu usuario</label>
            <input type="text" name="usuario" class="form-control"  aria-describedby="emailHelp" placeholder="Usuario">
        </div>
        <div class="form-group">
            <label >Password</label>
            <input type="password" name="password" class="form-control"placeholder="Contraseña">
        </div>

        <input type="submit" name="acceder" class="btn" value="Ingresar">
    </form>

</div>

<?php include("includes/footer.php"); ?>
       