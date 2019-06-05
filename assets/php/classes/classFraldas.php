<?php

require_once "database.php";

class Fraldas{

    private $id;
    private $data;
    private $horario;
    private $bebe_id;

    public function __construct() {
        $database = new Database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }

    function setId($value){
        $this->id = $value;
    }

    function setData($value){
        $this->data = $value;
    }

    function setHorario($value){
        $this->horario = $value;
    }

    function setBebe($value){
        $this->bebe_id = $value;
    }

    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `fraldas`(`data`,`horario`,`bebe_id`) VALUES (:data,:horario,:bebe_id)");
            $stmt->bindParam(":data", $this->data);
            $stmt->bindParam(":horario", $this->horario);
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
            $stmt = $this->conn->prepare("UPDATE `fraldas` SET `data` = :data, `horario` = :horario, `bebe_id` = :bebe_id WHERE `id` = :id");
            $stmt->bindParam(":data", $this->data);
            $stmt->bindParam(":horario", $this->horario);
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
            $stmt = $this->conn->prepare("DELETE FROM `fraldas` WHERE `id` = :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function view(){
        $stmt = $this->conn->prepare("SELECT * FROM `fraldas` WHERE `id` = :id");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }

    public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `fraldas` WHERE 1 ORDER BY `data`");
        $stmt->execute();
        return $stmt;
    }

    public function trocaDeFraldas($bebe_id,$data_inicial,$data_final){
        $stmt = $this->conn->prepare("SELECT count(id) as quantidade, data as dia FROM `fraldas` WHERE `bebe_id` = :bebe_id AND `data` BETWEEN :data_inicial AND :data_final GROUP BY `data`");
        $stmt->bindParam(":bebe_id", $bebe_id);
        $stmt->bindParam(":data_inicial", $data_inicial);
        $stmt->bindParam(":data_final", $data_final);
        $stmt->execute();
        return $stmt;
    }
}
?>