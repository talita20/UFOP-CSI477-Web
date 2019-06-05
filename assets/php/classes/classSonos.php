<?php

require_once "database.php";

class Sonos{

    private $id;
    private $data;
    private $horario_inicio;
    private $horario_fim;
    private $observacao;
    private $bebe_id;

    public function __construct() {
        $database = new database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }

    function setId($value){
        $this->id = $value;
    }

    function setData($value){
        $this->data = $value;
    }

    function setHorario_inicio($value){
        $this->horario_inicio = $value;
    }

    function setHorario_fim($value){
        $this->horario_fim = $value;
    }

    function setObservacao($value){
        $this->observacao = $value;
    }

    function setBebeId($value){
        $this->bebe_id = $value;
    }

    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `sonos`(`data`,`horario_inicio`,`horario_fim`, `observacao`, `bebe_id`) VALUES (:data,:horario_inicio,:horario_fim, :observacao, :bebe_id)");
            $stmt->bindParam(":data", $this->data);
            $stmt->bindParam(":horario_inicio", $this->horario_inicio);
            $stmt->bindParam(":horario_fim", $this->horario_fim);
            $stmt->bindParam(":observacao", $this->observacao);
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
            $stmt = $this->conn->prepare("UPDATE `sonos` SET `data` = :data, `horario_inicio` = :horario_inicio, `horario_fim` = :horario_fim, `observacao` = :observacao, `bebe_id` = :bebe_id WHERE `id` = :id");
            $stmt->bindParam(":data", $this->data);
            $stmt->bindParam(":horario_inicio", $this->horario_inicio);
            $stmt->bindParam(":horario_fim", $this->horario_fim);
            $stmt->bindParam(":observacao", $this->observacao);
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
            $stmt = $this->conn->prepare("DELETE FROM `sonos` WHERE `id` = :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function view(){
        $stmt = $this->conn->prepare("SELECT * FROM `sonos` WHERE `id` = :id");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }

    public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `sonos` WHERE 1 ORDER BY `horario_inicio`");
        $stmt->execute();
        return $stmt;
    }


}
?>