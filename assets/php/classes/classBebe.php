<?php

require_once "database.php";

class Bebes{

    private $id;
    private $nome;
    private $data_nascimento;
    private $cidade;
    private $foto;
    private $usuarios_master_id;

    public function __construct() {
        $database = new Database();
        $dbSet = $database->dbSet();
        $this->conn = $dbSet;
    }

    function setId($value){
        $this->id = $value;
    }

    function setNome($value){
        $this->nome = $value;
    }

    function setDataNascimento($value){
        $this->data_nascimento = $value;
    }

    function setCidade($value){
        $this->cidade = $value;
    }

    function setFoto($value){
        $this->foto = $value;
    }

    function setUsuario($value){
        $this->usuarios_master_id = $value;
    }

    public function insert(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO `bebe`(`nome`,`data_nascimento`,`cidade`, `foto`, `usuarios_master_id`) VALUES (:nome,:data_nascimento,:cidade, :foto, :usuarios_master_id)");
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":data_nascimento", $this->data_nascimento);
            $stmt->bindParam(":cidade", $this->cidade);
            $stmt->bindParam(":foto", $this->foto);
            $stmt->bindParam(":usuarios_master_id", $this->usuarios_master_id);
            $stmt->execute();
            return $this->conn->lastInsertId();
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function edit(){
        try{
            $stmt = $this->conn->prepare("UPDATE `bebe` SET `nome` = :nome, `data_nascimento` = :data_nascimento, `cidade` = :cidade, `foto` = :foto, `usuarios_master_id` = :usuarios_master_id WHERE `id` = :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":data_nascimento", $this->data_nascimento);
            $stmt->bindParam(":cidade", $this->cidade);
            $stmt->bindParam(":foto", $this->foto);
            $stmt->bindParam(":usuarios_master_id", $this->usuarios_master_id);
            $stmt->execute();
            return $this->id;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function delete(){
        try{
            $stmt = $this->conn->prepare("DELETE FROM `bebe` WHERE `id` = :id");
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            return 1;
        }catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }

    public function view(){
        $stmt = $this->conn->prepare("SELECT * FROM `bebe` WHERE `id` = :id");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }

    public function index(){
        $stmt = $this->conn->prepare("SELECT * FROM `bebe` WHERE 1 ORDER BY `nome`");
        $stmt->execute();
        return $stmt;
    }

    public function pesquisa($usuarios_master_id){
        $stmt = $this->conn->prepare("SELECT * FROM `bebe` WHERE `usuarios_master_id` = :usuarios_master_id");
        $stmt->bindParam(":usuarios_master_id", $usuarios_master_id);
        $stmt->execute();
        return $stmt;
    }

    public function pesquisaBebe($usuarios_master_id){
        $stmt = $this->conn->prepare("SELECT * FROM `bebe` WHERE `usuarios_master_id` = :usuarios_master_id");
        $stmt->bindParam(":usuarios_master_id", $usuarios_master_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row;
    }

}
?>