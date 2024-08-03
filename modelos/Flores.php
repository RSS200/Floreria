<?php
class Flores{
    private $conn; //conexión con la BD
    private $table = "Flor";

    public  function __construct($cx) {
        $this->conn =$cx;
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
    public function getFlor($id){
        try{
           
            $qry = "select * from ". $this->table . " where id = :id";
            $st = $this->conn->prepare($qry);
            $st->bindParam(':id', $id, PDO::PARAM_INT);
            $st->execute();
            return $st->fetch(PDO::FETCH_OBJ);
        } catch( PDOException $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "\n";
            return false;
        }
    }

    public function crearFlor($nombre, $precio, $activo, $categoria) {
        try {
            $qry = "INSERT INTO {$this->table} (nombre, precio, activo, id_categoria) VALUES (:nombre, :precio, :activo, :categoria)";
            $st = $this->conn->prepare($qry);
            $st->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $st->bindParam(':precio', $precio, PDO::PARAM_STR);
            $st->bindParam(':activo', $activo, PDO::PARAM_BOOL);
            $st->bindParam(':categoria', $categoria, PDO::PARAM_INT);
            $st->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "\n";
            return false;
        }
    }



    public function actualizarFlor($nombre, $precio, $activo, $categoria, $id) {
        try {
            $qry = "UPDATE  {$this->table} SET nombre=:nombre , precio=:precio, activo=:activo, id_categoria=:categoria WHERE ID =:id";
            $st = $this->conn->prepare($qry);
           
            $st->bindParam(':id', $id, PDO::PARAM_INT);
            $st->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $st->bindParam(':precio', $precio, PDO::PARAM_STR);
            $st->bindParam(':activo', $activo, PDO::PARAM_BOOL);
            $st->bindParam(':categoria', $categoria, PDO::PARAM_INT);
           
            $st->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "\n";
            return false;
        }
    }



    public function eliminarFlor( $id) {
        try {
            $qry = "DELETE  FROM {$this->table}  WHERE ID =:id";
            $st = $this->conn->prepare($qry);
      
            $st->bindParam(':id', $id, PDO::PARAM_INT);
     
            $st->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "\n";
            return false;
        }
    }



    public function getFloresPorArreglo($id) {
        try {
            $qry = "SELECT fa.id as faid, a.nombre as nombreflor, a.precio as precioflor, fa.piezasFlor FROM flor_arreglo fa JOIN {$this->table} a ON fa.id_flor = a.id WHERE fa.id_arreglo = :id";
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