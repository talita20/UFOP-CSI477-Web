<?php
require_once 'header.php';
require_once 'assets/php/classes/classAlimentacoes.php';
require_once 'assets/php/classes/classBebe.php';

$bebe = new Bebes();
$alimentacoes = new Alimentacoes();

$pessoa = $bebe->pesquisa($_SESSION['id']);

if (isset($_POST['insert'])) {
    $alimentacoes->setTipo($_POST['tipo']);
    $alimentacoes->setData($_POST['data']);
    $alimentacoes->setHorario($_POST['horario']);
    $alimentacoes->setDescricao($_POST['descricao']);
    $alimentacoes->setBebeId($_POST['bebe_id']);

    if ($alimentacoes->insert() == 1) {
        $result = "Alimentação inserida com sucesso!";
    } else {
        $error = "Erro ao inserir. Tente novamente";
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <?php
            if (isset($result)) {
                ?>
                <div class="alert alert-success">
                    <?php echo $result; ?>
                </div>
                <?php
            } else if (isset($error)) {
                ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
                <?php
            }
            ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="orange">
                                    <h4 class="title">Cadastrar</h4>
                                    <p class="category">Cadastre a rotina de alimentação da criança</p>
                                </div>
                                <div class="card-content">
                                    <form action="cadastrar_alimentacao.php" method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Criança</label>
                                                    <?php while ($row = $pessoa->fetch(PDO::FETCH_OBJ)) { ?>
                                                        <input type="hidden" name="bebe_id"
                                                               value="<?php echo $row->id ?>">
                                                        <input type="text" class="form-control"
                                                               value="<?php echo $row->nome ?>" readonly>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Tipo de Refeição</label>
                                                    <select name="tipo" id="tipo" for="alimentacoes"
                                                            class="form-control">
                                                        <option>Selecione</option>
                                                        <option value="Amamentação">Amamentação</option>
                                                        <option value="Café da Manhã">Café da Manhã</option>
                                                        <option value="Almoço">Almoço</option>
                                                        <option value="Café da Tarde">Café da Tarde</option>
                                                        <option value="Jantar">Jantar</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Data</label>
                                                    <input type="date" name="data" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Horário</label>
                                                    <input type="time" name="horario" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Descrição da Refeição</label>
                                                <input type="text" name="descricao" class="form-control">
                                            </div>
                                        </div>
                                        <button type="submit" name="insert" id="btnamarelo"
                                                class="btn btn-primary pull-right">
                                            Cadastrar
                                        </button>

                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>
