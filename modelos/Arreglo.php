<?php
class Arreglo{
    private $conn; //conexión con la BD
    private $table = "arreglo";

    public  function __construct($cx) {
        $this->conn =$cx;
    }



    public function crearArreglo($nombre, $precio, $descripcion) {
        try {
            $qry = "INSERT INTO {$this->table} (nombre, precioManoObra, descripcion) VALUES (:nombre, :precio, :descripcion)";
            $st = $this->conn->prepare($qry);
            $st->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $st->bindParam(':precio', $precio, PDO::PARAM_INT);
            $st->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $st->execute();
            
            // Obtener el ID del último elemento insertado
            $lastInsertId = $this->conn->lastInsertId();
            
            return $lastInsertId;
        } catch (PDOException $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "\n";
            return false;
        }
    }

    public function listar(){
        try{
            $qry = "select * from " .$this->table;
            $st = $this->conn->prepare($qry);
            $st->execute();
            return $st->fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $e){
            echo 'Excepción capturada: ', $e->getMessage(), "\n";
            return false;
        }
    }


    public function sumaCostoFloresArreglo($idArreglo) {
        try {
            $qry = "SELECT SUM(precioTotal) as total FROM flor_arreglo WHERE id_arreglo = :idArreglo";
            $st = $this->conn->prepare($qry);
            $st->bindParam(':idArreglo', $idArreglo, PDO::PARAM_INT);
            $st->execute();
            
            // Recuperar y devolver el monto total
            return $st->fetchColumn();
        } catch (PDOException $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "\n";
            return false;
        }
    }
    
    public function insertarFlorEnArreglo($piezasFlor, $precioUnitario, $PrecioTotal, $idFlor, $idArreglo) {
        try {
            $qry = "INSERT INTO flor_arreglo(piezasFlor, precioUnitario, precioTotal,id_flor, id_arreglo) VALUES (:piezasFlor, :precioUnitario, :PrecioTotal, :idFlor, :idArreglo)";
            $st = $this->conn->prepare($qry);
          
            $st->bindParam(':piezasFlor', $piezasFlor, PDO::PARAM_INT);
            $st->bindParam(':precioUnitario', $precioUnitario, PDO::PARAM_STR);
            $st->bindParam(':PrecioTotal', $PrecioTotal, PDO::PARAM_STR);
            $st->bindParam(':idFlor', $idFlor, PDO::PARAM_INT);
            $st->bindParam(':idArreglo', $idArreglo, PDO::PARAM_INT);
            $st->execute();
            
            // Obtener el ID del último elemento insertado
            
            return true;
        } catch (PDOException $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "\n";
            return false;
        }
    }


    public function editarFlorEnArreglo($piezasFlor, $precioUnitario, $PrecioTotal ,$idArreglo_flor) {
        
        try {
            $qry = "update flor_arreglo set piezasFlor=:piezasFlor, precioUnitario=:precioUnitario, precioTotal=:PrecioTotal where id=:idArreglo_flor";
            $st = $this->conn->prepare($qry);
          
            $st->bindParam(':piezasFlor', $piezasFlor, PDO::PARAM_INT);
            $st->bindParam(':precioUnitario', $precioUnitario, PDO::PARAM_STR);
            $st->bindParam(':PrecioTotal', $PrecioTotal, PDO::PARAM_STR);
            $st->bindParam(':idArreglo_flor', $idArreglo_flor, PDO::PARAM_INT);
            $st->execute();
            
            // Obtener el ID del último elemento insertado
            
            return true;
        } catch (PDOException $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "\n";
            return false;
        }
    }
    

    
    public function eliminarFlor( $idFlorArreglo) {
        try {
            $qry = "DELETE  FROM flor_arreglo  WHERE ID =:id";
            $st = $this->conn->prepare($qry);
      
            $st->bindParam(':id', $idFlorArreglo, PDO::PARAM_INT);
     
            $st->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "\n";
            return false;
        }
    }

    public function getFlorArreglo($id) {
        try {
            $qry = "SELECT * FROM flor_arreglo fa where fa.id= :id";
            $st = $this->conn->prepare($qry);
            $st->bindParam(':id', $id, PDO::PARAM_INT);
            $st->execute();
         
            
            // Devolver todas las filas como un array de objetos
            return $st->fetchAll(PDO::FETCH_OBJ);
        
        } catch (PDOException $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "\n";
            return false;
        }
    }
    

}    