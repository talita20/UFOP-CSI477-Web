<?php

require_once "database.php";

class Usuarios_secundarios{

    private $id;
    private $email;
    private $senha;
    private $usuarios_master_id;

    public function __construct() {
        $database = new database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }

    function setId($value){
        $this->id = $value;
    }

    function setEmail($value){
        $this->email = $value;
    }

    function setSenha($value){
        $this->senha = $value;
    }

    function setUsuariosMasterId($value){
        $this->usuarios_master_id = $value;
    }

    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `usuarios_secundarios`(`email`,`senha`, `usuarios_master_id`) VALUES (:email,:senha, :usuarios_master_id)");
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":senha", $this->senha);
            $stmt->bindParam(":usuarios_master_id", $this->usuarios_master_id);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function edit(){
        try{
            $stmt = $this->conn->prepare("UPDATE `usuarios_secundarios` SET `email` = :email, `senha` = :senha, `usuarios_master_id` = :usuarios_master_id WHERE `id` = :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":senha", $this->senha);
            $stmt->bindParam(":usuarios_master_id", $this->usuarios_master_id);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function delete(){
        try{
            $stmt = $this->conn->prepare("DELETE FROM `usuarios_secundarios` WHERE `id` = :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function view(){
        $stmt = $this->conn->prepare("SELECT * FROM `usuarios_secundarios` WHERE `id` = :id");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }

    public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `usuarios_secundarios` WHERE 1 ORDER BY `email`");
        $stmt->execute();
        return $stmt;
    }

    public function indexEmail($email){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM `usuarios_secundarios` WHERE `email` = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            return $row;
        }catch(PDOException $e){
            return $e;
        }
    }

    public function locate(){
        $stmt = $this->conn->prepare("SELECT * FROM `usuarios_secundarios` WHERE `email` = :email");
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }

}
?>