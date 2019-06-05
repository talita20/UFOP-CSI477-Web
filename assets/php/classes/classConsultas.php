<?php

require_once "database.php";

class Consultas{

    private $id;
    private $data;
    private $local;
    private $medico;
    private $observacao;
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

    function setlocal($value){
        $this->local = $value;
    }

    function setMedico($value){
        $this->medico = $value;
    }

    function setObservacao($value){
        $this->observacao = $value;
    }

    function setBebeId($value){
        $this->bebe_id = $value;
    }

    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `consultas`(`data`,`local`,`medico`, `observacao`, `bebe_id`) VALUES (:data,:local,:medico, :observacao, :bebe_id)");
            $stmt->bindParam(":data", $this->data);
            $stmt->bindParam(":local", $this->local);
            $stmt->bindParam(":medico", $this->medico);
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
            $stmt = $this->conn->prepare("UPDATE `consultas
            ` SET `data` = :data, `local` = :local, `medico` = :medico, `observacao` = :observacao, `bebe_id` = :bebe_id WHERE `id` = :id");
            $stmt->bindParam(":data", $this->data);
            $stmt->bindParam(":local", $this->local);
            $stmt->bindParam(":medico", $this->medico);
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
            $stmt = $this->conn->prepare("DELETE FROM `consultas
            ` WHERE `id` = :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function view(){
        $stmt = $this->conn->prepare("SELECT * FROM `consultas
        ` WHERE `id` = :id");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }

     public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `consultas` WHERE 1 ORDER BY `data`");
        $stmt->execute();
        return $stmt;
    }

    public function listar(){
        $stmt = $this->conn->prepare("SELECT * FROM `consultas` WHERE 1 ORDER BY `data`");
        $stmt->execute();

        $arrayProdutos = [];

        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $arrayProdutos[] = [
                "data" => $row->data,
                "bebe_id" => $row->bebe_id,
                "medico" => $row->medico,
                "local" => $row->local,
                "observacao"=>$row->observacao
            ];
        }
        return $arrayProdutos;
    }

    public function consultasRealizadas($bebe_id,$data_inicial,$data_final){
        $stmt = $this->conn->prepare("SELECT count(id) as quantidade, data as dia, medico, local, observacao FROM `consultas` WHERE `bebe_id` = :bebe_id AND `data` BETWEEN :data_inicial AND :data_final GROUP BY `data`");
        $stmt->bindParam(":bebe_id", $bebe_id);
        $stmt->bindParam(":data_inicial", $data_inicial);
        $stmt->bindParam(":data_final", $data_final);
        $stmt->execute();
        return $stmt;
    }

}
?>