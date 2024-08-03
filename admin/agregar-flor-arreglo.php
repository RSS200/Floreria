<?php 
    include("../includes/header.php");
    include("../includes/menu.php");
    include("../config/Mysql.php");
    include("../modelos/Categorias.php");
    include("../modelos/Flores.php");
    include("../modelos/Arreglo.php");
    if (!$_SESSION['auth']){
        header('Location: ../login.php');
    }
    $base = new Mysql();
    $cx = $base->connect();
    $categoria = new Categorias($cx);
    $categorias = $categoria->listar();
    $flores = new Flores($cx);
    $arreglo = new Arreglo($cx);
    $id=0;
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $cat = $categoria->getCategoria($id);
    } 
    //CREA LA FLOR
    if(isset($_POST['CrearFlorArreglo'])){
   
        $piezas=$_POST["piezas"];
        $idFlor =$_POST["idFlor"];
        $idArreglo =$_POST["idArreglo"];
        $activo=1;
      
        if($piezas=='' || empty($piezas) ){
            echo "Todos los campos son obligatorios";
            die();
        }else{
            $florSelccionada = $flores->getFlor($idFlor);
            $precioFlorPieza= $florSelccionada->precio;
            $precioTotalFlor= $florSelccionada->precio * $piezas;
         
            if($arreglo->insertarFlorEnArreglo($piezas,$precioFlorPieza,$precioTotalFlor, $idFlor, $idArreglo)){
                $mensaje = "Se ha actualizado el registro";
               session_start();
               $_SESSION['Mensaje']='Se ha ingresado la flor con extito';
               header( "Location: editar-arreglo.php?idArreglo=".$idArreglo);
            }
        }
    }else{
        $error = "Error al crear el registro";
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
       <h3>Agrega la nueva flor</h3>
    </div>            

    <div class="row">
        <div class="col-sm-6 offset-3">
        <form method="POST" action="">

            <div class="mb-3">
                <label class="form-label">piezas:</label>
                <input type="number" class="form-control" name="piezas" id="piezas" placeholder="Ingresa el numero de piezas" required >              
            </div>

            <input type="hidden" name="idArreglo" value="<?=$_GET['idArreglo']?>">
          
            <div class="mb-3">
            <label for="" class="form-label">Flor:</label>
            
            <select class="form-select" name="idFlor">
            <?php foreach($flores->listar() as $flor):?>
                <option value="<?=$flor->id ?>"><?= $flor->nombre ?></option>
            <?php endforeach; ?>              
            </select>             

            </div>       
        
            <br/>
            <button type="submit" name="CrearFlorArreglo" class="btn btn-success float-left"><i class="bi bi-person-bounding-box"></i> Agregar al arreglo</button>
            <a href="editar-arreglo.php?idArreglo=<?=$_GET['idArreglo']?>" class="btn btn-warning">Cancelar</a>
            </form>
        </div>
    </div>
<?php include("../includes/footer.php") ?>
       