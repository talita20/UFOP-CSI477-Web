<?php
require_once 'header.php';
require_once 'assets/php/classes/classBebe.php';
require_once 'assets/php/classes/classPesoAltura.php';

$bebe = new Bebes();
$info = new PesoAltura();

$pessoa = $bebe->pesquisaBebe($_SESSION['id']);

if (isset($_POST['insert'])) {
    $bebe->setNome($_POST['nome']);
    $bebe->setDataNascimento($_POST['data_nascimento']);
    $bebe->setCidade($_POST['cidade']);
    $bebe->setUsuario($_POST['usuarios_master_id']);

    $foto = $_FILES["foto"];
    // Se a foto estiver sido selecionada
    if (!empty($foto["name"])) {
        // Pega extensão da imagem
        preg_match("/\.(png|jpg|jpeg){1}$/i", $foto["name"], $ext);
        // Gera um nome único para a imagem
        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
        $diretorio = "assets/img/";
        if (!file_exists($diretorio)) {
            mkdir($diretorio, 0777, true);
        }
        // Caminho de onde ficará a imagem
        $caminho_imagem = $diretorio . $nome_imagem;
        move_uploaded_file($foto["tmp_name"], $caminho_imagem);
        $bebe->setFoto($caminho_imagem);
    }

    $id_bebe = $bebe->insert();
    if ($id_bebe > 0) {
        $info->setAltura($_POST['altura']);
        $info->setPeso($_POST['peso']);
        $info->setBebe($id_bebe);
        if ($info->insert() == 1) {
            $result = "Dados inseridos com sucesso!";
        } else {
            $error = "Erro ao inserir. Tente novamente";
        }
    } else {
        $error = "Erro ao inserir. Tente novamente";
    }
}

if (isset($_POST['edit'])) {
    $foto = $_FILES["foto"];

    if (!empty($foto["name"])) {
        $ext = strtolower(substr($_FILES['foto']['name'], -4));
        $nome_arquivo = md5(uniqid(time())) . $ext;
        $diretorio = "assets/img/";
        if (!file_exists($diretorio)) {
            mkdir($diretorio, 0777, true);
        }
        $caminho_arquivo = $diretorio . $nome_arquivo;
        move_uploaded_file($foto["tmp_name"], $caminho_arquivo);

        $bebe->setId($_POST['id']);
        $bebe->setNome($_POST['nome']);
        $bebe->setDataNascimento($_POST['data_nascimento']);
        $bebe->setCidade($_POST['cidade']);
        $bebe->setUsuario($_POST['usuarios_master_id']);
        $bebe->setFoto($caminho_arquivo);
        var_dump($bebe);
    } else {
        $bebe->setId($_POST['id']);
        $bebe->setNome($_POST['nome']);
        $bebe->setDataNascimento($_POST['data_nascimento']);
        $bebe->setCidade($_POST['cidade']);
        $bebe->setUsuario($_POST['usuarios_master_id']);
        $bebe->setFoto($_POST['foto_old']);
    }

    $id_bebe = $bebe->edit();
    if ($id_bebe > 0) {
        $info->setId($_POST['id_pesoAltura']);
        $info->setAltura($_POST['altura']);
        $info->setPeso($_POST['peso']);
        $info->setBebe($id_bebe);
        if ($info->insert() == 1) {
            $result = "Dados editados com sucesso!";
        } else {
            $error = "Erro ao editar. Tente novamente";
        }
    } else {
        $error = "Erro ao editar. Tente novamente";
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
                    <?php
                    if ($pessoa == null) {
                    ?>
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Cadastrar</h4>
                        <p class="category">Cadastre os dados básicos do bebê</p>
                    </div>
                    <div class="card-content">
                        <form action="cadastrar_dados.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Nome</label>
                                        <input type="text" name="nome" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Data de Nascimento</label>
                                        <input type="date" name="data_nascimento" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cidade</label>
                                        <input type="text" name="cidade" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group label-floating">
                                    <label class="control-label">Peso (em gramas)</label>
                                    <input type="text" id="peso" name="peso" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-5">
                                <div class="form-group label-floating">
                                    <label class="control-label">Altura (em cm)</label>
                                    <input type="text" id="altura" name="altura" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div>
                                    <span class="btn btn-raised btn-round btn-default btn-file">
                                        <span class="fileinput-new">Inserir foto</span>
                                    <input type="file" name="foto"/></span>
                                </div>
                            </div>
                            <input type="hidden" name="usuarios_master_id" value="<?php echo $_SESSION['id'] ?>"
                                   class="form-control">
                            <button type="submit" name="insert" id="btnamarelo" class="btn btn-primary pull-right">
                                Cadastrar
                            </button>

                            <div class="clearfix"></div>
                        </form>
                        <?php } else {
                        $stmt = $info->dados_bebe($pessoa->id);
                        ?>
                        <div class="card-header" data-background-color="orange">
                            <h4 class="title">Editar</h4>
                            <p class="category">Edite os dados básicos do bebê</p>
                        </div>
                        <div class="card-content">
                            <form action="cadastrar_dados.php" method="post" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Nome: </label>
                                        <input type="text" name="nome" value="<?php echo $pessoa->nome ?>"
                                               class="form-control" readonly>
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Data de Nascimento: </label>
                                        <input type="hidden" name="data_nascimento" value="<?php echo $pessoa->data_nascimento ?>">
                                        <input type="text"
                                               value="<?php echo date('d/m/Y', strtotime($pessoa->data_nascimento)); ?>"
                                               class="form-control" readonly>
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cidade: </label>
                                        <input type="text" name="cidade" value="<?php echo $pessoa->cidade ?>"
                                               class="form-control" readonly>
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Altura: </label>
                                        <input type="text" name="altura" value="<?php echo $stmt->altura ?>"
                                               class="form-control">
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Peso: </label>
                                        <input type="text" name="peso" value="<?php echo $stmt->peso ?>"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-4">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Foto: </label>
                                            <input type="hidden" name="foto_old" value="<?php echo $pessoa->foto ?>">
                                            <img src="<?php echo $pessoa->foto ?>" class="img-responsive">
                                        </div>
                                    </div>
                                    <div>
                                            <span class="btn btn-raised btn-round btn-default btn-file">
                                                <span class="fileinput-new">Editar foto</span>
                                            <input type="file" name="foto"/></span>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $pessoa->id ?>">
                                <input type="hidden" name="id_pesoAltura" value="<?php echo $stmt->id ?>">
                                <input type="hidden" name="usuarios_master_id"
                                       value="<?php echo $_SESSION['id'] ?>">
                                <button type="submit" name="edit" id="btnamarelo"
                                        class="btn btn-primary pull-right">
                                    Editar
                                </button>

                                <div class="clearfix"></div>
                            </form>
                            <?php
                            } ?>
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
