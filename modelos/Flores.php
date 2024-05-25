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

    public function crearFlor($nombre, $precio, $activo, $categoria) {
        try {
            $qry = "INSERT INTO {$this->table} (nombre, precio, activo, categoria) VALUES (:nombre, :precio, :activo, :categoria)";
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
    
}