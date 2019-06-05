<?php
session_start();
ob_start();
require_once 'assets/php/classes/classUsuarioSecundarios.php';

$user_secundario = new Usuarios_secundarios();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha2 = $_POST['senha2'];

    $usuario_secundario = $user_secundario->setEmail($email);
    $usuario_secundario = $user_secundario->locate();

    if (is_null($usuario_secundario) || empty($usuario_secundario)) {
        $error = "E-mail inválido";
    } else {
        if (sha1($senha) != sha1($senha2)) {
            $error = "As senhas não coincidem.";
        } else {
            $user_secundario->setId($_POST['id']);
            $user_secundario->setEmail($email);
            $user_secundario->setSenha(sha1($senha));
            $user_secundario->setUsuariosMasterId($_POST['usuarios_master_id']);

            if ($user_secundario->edit() == 1) {
                $result = "Senha do usuário editada com sucesso!";
            } else {
                $error = "Erro ao editar senha do usuário. Tente novamente";
            }
        }
    }
}

?>
    <!doctype html>
    <html lang="pt-BR">

    <head>
        <meta charset="utf-8"/>
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/logo6.jpg"/>
        <link rel="icon" type="image/png" href="assets/img/logo6.jpg"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>Baby Life</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
        <meta name="viewport" content="width=device-width"/>
        <!-- Bootstrap core CSS     -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
        <!--  Material Dashboard CSS    -->
        <link href="assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet"/>
        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="assets/css/demo.css" rel="stylesheet"/>
        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet'
              type='text/css'>
    </head>


    <body style="height: 100%; background-repeat: no-repeat; background-image: linear-gradient(#FA5858, #fcf3d1);padding-bottom:200px;position:relative; ">
    <div class="container" align="center">
        <div class="card card-container" id="login">
            <img style="width: 150px;height: 84px; margin-bottom: 10px; " src="assets/img/logo5.jpg">
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
            <form class="form-signin" action="primeiro_acesso.php" method="post">
                <?php if (isset($result)) { ?>
                    <p>Clique <a href="index.php"> aqui </a> para logar no sistema.</p>
                <?php } else { ?>
                    <p>Troque a senha para poder acessar o sistema.</p>
                <?php } ?>
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" class="form-control" name="email" placeholder="E-mail" required autofocus>
                <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                <input type="password" class="form-control" name="senha2" placeholder="Confirmar Senha" required>
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                <input type="hidden" name="usuarios_master_id" value="<?php echo $_GET['usuarios_master_id'] ?>">
                <button class="btn btn-lg btn-primary btn-block btn-signin" id="btnentrar" type="submit" name="login">
                    Alterar senha
                </button>
            </form>
        </div>
    </div>
    </body>
    </html>
<?php
require_once 'footer.php';
?>