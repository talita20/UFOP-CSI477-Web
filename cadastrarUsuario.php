<?php
require_once 'header.php';
require_once 'assets/php/classes/classUsuarioSecundarios.php';
require_once 'assets/php/classes/classUsuarioMaster.php';

$master = new Usuarios_master();
$secundario = new Usuarios_secundarios();

if (isset($_POST['insert'])) {
    $secundario->setEmail($_POST['email']);
    $secundario->setSenha(sha1(123456));
    $secundario->setUsuariosMasterId($_POST['usuarios_master_id']);

    if ($secundario->insert() == 1) {
        $result = "Novo usuário inserido com sucesso! A senha padrão do primeiro acesso é 123456. A nova senha deve ser fornecida no primeiro acesso do usuário.";
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
                                    <p class="category">Cadastre um novo usuário para gerenciar as informações do
                                        bebê</p>
                                </div>
                                <div class="card-content">
                                    <form action="cadastrarUsuario.php" method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">E-mail</label>
                                                    <input type="email" name="email" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="hidden" name="usuarios_master_id"
                                                       value="<?php echo $_SESSION['id'] ?>">
                                                <button type="submit" name="insert" id="btnamarelo"
                                                        class="btn btn-primary pull-right">
                                                    Cadastrar
                                                </button>
                                            </div>
                                        </div>
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
