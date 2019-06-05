<?php
require_once 'header.php';
require_once 'assets/php/classes/classBebe.php';
require_once 'assets/php/classes/classPesoAltura.php';

$bebe = new Bebes();
$pesoAltura = new PesoAltura();
$pessoa = $bebe->pesquisa($_SESSION['id']);
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Dados do bebê</h4>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <?php while ($row = $pessoa->fetch(PDO::FETCH_OBJ)) {
                                $stmt = $pesoAltura->dados_bebe($row->id);
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Nome: </label>
                                        <input type="text" name="nome" value="<?php echo $row->nome ?>"
                                               class="form-control" readonly>
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Data de Nascimento: </label>
                                        <input type="text" name="data_nascimento"
                                               value="<?php echo date('d/m/Y', strtotime($row->data_nascimento)); ?>"
                                               class="form-control" readonly>
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cidade: </label>
                                        <input type="text" name="nome" value="<?php echo $row->cidade ?>"
                                               class="form-control" readonly>
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Altura: </label>
                                        <input type="text" name="nome" value="<?php echo $stmt->altura ?> cm"
                                               class="form-control" readonly>
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Peso: </label>
                                        <input type="text" name="nome" value="<?php echo $stmt->peso ?> gramas"
                                               class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Foto: </label>
                                            <img src="<?php echo $row->foto ?>" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                                <p>Para adicionar um novo usuário para gerenciar as informações do bebê, clique no botão abaixo.</p>
                                <a href="cadastrarUsuario.php" class="btn btn-primary pull-right">Adicionar usuário</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
