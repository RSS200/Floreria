<?php 
    include("../includes/header.php");
    include("../includes/menu.php");
    include("../config/Mysql.php");
    include("../modelos/Categorias.php");
    include("../modelos/Flores.php");
    if (!$_SESSION['auth']){
        header('Location: ../login.php');
    }
    $base = new Mysql();
    $cx = $base->connect();
    //lista de categorias
    $categoria = new Categorias($cx);
    $flores = new Flores($cx);
    $categorias = $categoria->listar();
    $id=0;
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $flor = $flores->getFlor($id);
    } 
    //edita la categoria 
    if (isset($_POST['editarFlor'])){
        $id=intval($_POST["id"]);
        $nombre=$_POST["nombre"];
        $precio =$_POST["precio"];
        $activo=intval($_POST['activo']);
        $categoria=intval($_POST['categoria']);
        if($nombre=='' || empty($nombre) ){
            $error = "Todos los campos son obligatorios";
        }else{
            if($flores->actualizarFlor($nombre,$precio,$activo,$categoria, $id)){
                $mensaje = "Se ha actualizado el registro";
               session_start();
               $_SESSION['Mensaje']='Se ha editado la flor con exito';
               header( "Location: listaflores.php");
            }
        }
    }else{
        $error = "Error al editar el registro";
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
       <h3>Editar Flor</h3>
    </div>            

    <div class="row">
    <div class="col-sm-6 offset-3">
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?=$flor->id?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el nombre"value="<?=$flor->nombre?> ">              
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="number" class="form-control" name="precio" id="precio" placeholder="Ingresa el precio de la flor" value="<?=$flor->precio?>" >              
            </div>
            <div class="mb-3">
            <label for="" class="form-label">Activo:</label>
            <select class="form-select" aria-label="Default select example" name="activo">
                <option value="1" <?=($flor->activo)==1? 'selected':''?>>Activo</option>  
                <option value="0" <?=($flor->activo)==0? 'selected':''?>>Inactivo</option>
                             
            </select>             
            </div>   
            <div class="mb-3">
            <label for="" class="form-label">Categoria:</label>
            
            <select class="form-select" aria-label="Default select example" name="categoria">
            <?php foreach($categorias as $cat):?>
                <option value="<?= $cat->id ?>" <?=($flor->id_categoria)==$cat->id? 'selected':''?>><?= $cat->nombre ?></option>
            <?php endforeach; ?>              
            </select>             

            </div>       
        
            <br/>
            <button type="submit" name="editarFlor" class="btn btn-success float-left"><i class="bi bi-person-bounding-box"></i> Editar</button>
            <a href="listaflores.php" class="btn btn-warning">Cancelar</a>
            </form>
        </div>
    </div>
<?php include("../includes/footer.php") ?>
       