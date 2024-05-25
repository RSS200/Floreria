<?php
class Categorias{
    private $conn; //conexión con la BD
    private $table = "categoria";

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


    public function consultaUsuario ($usuario){
        try{
            $qry = "select * from ". $this->table . " where usuario = :usuario";
            $st = $this->conn->prepare($qry);
            $st->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $st->execute();
            return $st->fetch(PDO::FETCH_OBJ);
        } catch( PDOException $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "\n";
            return false;
        }
    }


    public function getCategoria($id){
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

    public function editarCategoria($id, $nombre, $activo){
           
        try {
            $qry = "update  ".$this->table." set nombre=:nombre, activo=:activo where id=:id";
          
            $st = $this->conn->prepare($qry);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $st->bindParam(':activo',$activo, PDO::PARAM_INT);
           
            $st->execute();
            return true;
        } catch (PDOException $e){
            echo 'Excepción capturada: ', $e->getMessage(), "\n";
            return false;
        }
    }


    public function crearCategoria($nombre, $activo) {
        try {
            $qry = "INSERT INTO {$this->table} (nombre, activo) VALUES (:nombre, :activo)";
            $st = $this->conn->prepare($qry);
            $st->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $st->bindParam(':activo', $activo, PDO::PARAM_INT);
            $st->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "\n";
            return false;
        }
    }

    public function eliminarCategoria($id) {
        try {
            $qry = "DELETE FROM {$this->table} WHERE id = :id";
            $st = $this->conn->prepare($qry);
            $st->bindParam(':id', $id, PDO::PARAM_INT);
            $st->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Excepción capturada: ', $e->getMessage(), "\n";
            return false;
        }
    }
    
    
}