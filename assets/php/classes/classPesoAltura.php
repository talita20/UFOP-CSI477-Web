<?php

require_once "database.php";

class PesoAltura{

    private $id;
    private $peso;
    private $altura;
    private $bebe_id;

    public function __construct() {
        $database = new database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }

    function setId($value){
        $this->id = $value;
    }

    function setPeso($value){
        $this->peso = $value;
    }

    function setAltura($value){
        $this->altura = $value;
    }

    function setBebe($value){
        $this->bebe_id = $value;
    }

    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `pesoaltura`(`peso`,`altura`,`bebe_id`) VALUES (:peso,:altura,:bebe_id)");
            $stmt->bindParam(":peso", $this->peso);
            $stmt->bindParam(":altura", $this->altura);
            $stmt->bindParam(":bebe_id", $this->bebe_id);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function edit(){
        try{
            $stmt = $this->conn->prepare("UPDATE `pesoaltura` SET `peso` = :peso, `altura` = :altura, `bebe_id` = :bebe_id WHERE `id` = :id");
            $stmt->bindParam(":peso", $this->peso);
            $stmt->bindParam(":altura", $this->altura);
            $stmt->bindParam(":bebe_id", $this->bebe_id);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function delete(){
        try{
            $stmt = $this->conn->prepare("DELETE FROM `pesoaltura` WHERE `id` = :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function view(){
        $stmt = $this->conn->prepare("SELECT * FROM `pesoaltura` WHERE `id` = :id");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }

    public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `pesoaltura` WHERE 1 ORDER BY `peso`");
        $stmt->execute();
        return $stmt;
    }

    public function dados_bebe($bebe_id){
        $stmt = $this->conn->prepare("SELECT * FROM `pesoaltura` WHERE `bebe_id` = :bebe_id ORDER BY `id` DESC LIMIT 1");
        $stmt->bindParam(":bebe_id", $bebe_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }

    public function historico($id){
        $stmt = $this->conn->prepare("SELECT * FROM `pesoaltura`, `bebe` WHERE `bebe`.`id` = :id ORDER BY `pesoaltura`.`id` DESC");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt;
    }

}
?>