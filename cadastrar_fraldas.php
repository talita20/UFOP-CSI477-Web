<?php
require_once 'header.php';
require_once 'assets/php/classes/classBebe.php';
require_once 'assets/php/classes/classFraldas.php';

$bebe = new Bebes();
$fralda = new Fraldas();

$pessoa = $bebe->pesquisa($_SESSION['id']);

if(isset($_POST['insert'])){
    $fralda->setBebe($_POST['bebe_id']);
    $fralda->setData($_POST['data']);
    $fralda->setHorario($_POST['horario']);

    if($fralda->insert() == 1){
        $result = "Troca de fralda inserida com sucesso!";
    }else{
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
            }else if(isset($error)){
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
                        <p class="category">Cadastre o consumo de fraldas da criança</p>
                    </div>
                    <div class="card-content">
                        <form action="cadastrar_fraldas.php" method="post">
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
                                        <input type="date" name="data" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Horário</label>
                                        <input type="time" name="horario" class="form-control" required>
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
