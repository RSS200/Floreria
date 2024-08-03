<?php
    class Usuario{
        private $conn; //conexión con la BD
        private $table = "usuarios";

        public  function __construct($cx) {
            $this->conn =$cx;
        }

        public function crearUsuario ($nombre, $nombreUsuario, $admin, $password){
            try {
                //Instrucción que dice que hacer
                $qry = "INSERT INTO " . $this->table . "(nombre,  usuario, password, admin, fecha_creacion) VALUES (:nombre, :nombreUsuario, :password, :admin, CURDATE())";
                //Preparo la operación
                $st = $this->conn->prepare($qry);
                //Asignar los valores
                $pass_encriptada = md5($password);
                $st->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $st->bindParam(":nombreUsuario", $nombreUsuario, PDO::PARAM_STR);
                $st->bindParam(":password", $pass_encriptada, PDO::PARAM_STR);
                $st->bindParam(":admin", $admin, PDO::PARAM_INT);  
                
                $st->execute();
                return true;
            } catch (PDOException $e) {
                echo 'Excepción capturada: ', $e->getMessage(), "\n";
                return false;
            }
        }
        

        
        public function listar(){
            try{
                $qry = "select * from view_" .$this->table;
                $st = $this->conn->prepare($qry);
                $st->execute();
                return $st->fetchAll(PDO::FETCH_OBJ);
            }catch(PDOException $e){
                echo 'Excepción capturada: ', $e->getMessage(), "\n";
                return false;
            }
        }

        public function getUser($id){
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

        public function editarUsuario($id, $nombre, $usuario, $admin){
           
            try {
                $qry = "update  ".$this->table." set nombre=:nombre, usuario=:usuario, admin=:admin where id=:id";
              
                $st = $this->conn->prepare($qry);
                $st->bindParam(":id", $id, PDO::PARAM_INT);
                $st->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $st->bindParam(':usuario', $usuario, PDO::PARAM_STR);
                $st->bindParam(':admin',$admin, PDO::PARAM_INT);
               
                $st->execute();
                return true;
            } catch (PDOException $e){
                echo 'Excepción capturada: ', $e->getMessage(), "\n";
                return false;
            }
        }

        public function eliminarUsuario ($id){
            try{

                $qry = "select count(*) from ". $this->table . " ";
                $st = $this->conn->prepare($qry);
                $st->execute();
                $valor =$st->fetch(PDO::FETCH_OBJ);
             
                $qry = "delete from  ".$this->table." where id=:id";
                $st = $this->conn->prepare($qry);
                $st->bindParam(':id',$id,PDO::PARAM_INT);
                $st->execute();
                return true;
            } catch (PDOException $e){
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
        public function login ($usuario, $password){
            try {
                $pass = md5($password);
                $qry = "select * from " . $this->table . " where usuario = :usuario and password = :password";
                $st = $this->conn->prepare($qry);
                $st->bindParam(':usuario', $usuario, PDO::PARAM_STR);
                $st->bindParam(':password', $pass,  PDO::PARAM_STR);
                $st->execute();
                $resultado = $st->fetch(PDO::FETCH_ASSOC);
                if ($resultado){
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e){
                echo 'Excepción capturada: ', $e->getMessage(), "\n";
                return false;
            }
        }

       

    }