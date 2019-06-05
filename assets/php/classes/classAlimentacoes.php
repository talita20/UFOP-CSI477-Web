<?php

require_once "database.php";

class Alimentacoes{

    private $id;
    private $tipo;
    private $data;
    private $horario;
    private $descricao;
    private $bebe_id;

    public function __construct() {
        $database = new Database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }

    function setId($value){
        $this->id = $value;
    }

    function setTipo($value){
        $this->tipo = $value;
    }

    function setData($value){
        $this->data = $value;
    }

    function sethorario($value){
        $this->horario = $value;
    }

    function setdescricao($value){
        $this->descricao = $value;
    }

    function setBebeId($value){
        $this->bebe_id = $value;
    }

    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `alimentacoes`(`tipo`,`data`,`horario`, `descricao`, `bebe_id`) VALUES (:tipo,:data,:horario, :descricao, :bebe_id)");
            $stmt->bindParam(":tipo", $this->tipo);
            $stmt->bindParam(":data", $this->data);
            $stmt->bindParam(":horario", $this->horario);
            $stmt->bindParam(":descricao", $this->descricao);
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
            $stmt = $this->conn->prepare("UPDATE `alimentacoes` SET `tipo` = :tipo, `data` = :data, `horario` = :horario, `descricao` = :descricao, `bebe_id` = :bebe_id WHERE `id` = :id");
            $stmt->bindParam(":tipo", $this->tipo);
            $stmt->bindParam(":data", $this->data);
            $stmt->bindParam(":horario", $this->horario);
            $stmt->bindParam(":descricao", $this->descricao);
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
            $stmt = $this->conn->prepare("DELETE FROM `alimentacoes` WHERE `id` = :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function view(){
        $stmt = $this->conn->prepare("SELECT * FROM `alimentacoes` WHERE `id` = :id");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }

    public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `alimentacoes` WHERE 1 ORDER BY `tipo`");
        $stmt->execute();
        return $stmt;
    }


}
?>