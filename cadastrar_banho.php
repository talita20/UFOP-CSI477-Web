<?php
require_once 'header.php';
require_once 'assets/php/classes/classBebe.php';
require_once 'assets/php/classes/classBanhos.php';

$bebe = new Bebes();
$banho = new Banhos();

$pessoa = $bebe->pesquisa($_SESSION['id']);

if (isset($_POST['insert'])) {
    $banho->setBebe($_POST['bebe_id']);
    $banho->setData($_POST['data']);
    $banho->setHorario($_POST['horario']);

    if ($banho->insert() == 1) {
        $result = "Banho inserido com sucesso!";
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Cadastrar</h4>
                        <p class="category">Cadastre a rotina de banho do bebê</p>
                    </div>
                    <div class="card-content">
                        <form action="" method="post">
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
                            <button type="submit" name="insert" id="btnamarelo" class="btn btn-primary pull-right">
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

<?php
require_once 'footer.php';
?>
