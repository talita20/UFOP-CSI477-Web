<?php
session_start();
ob_start();
require_once 'assets/php/classes/classUsuarioMaster.php';
require_once 'assets/php/classes/classUsuarioSecundarios.php';

$user = new Usuarios_master();
$user_secundario = new Usuarios_secundarios();

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $usuario = $user->setEmail($email);
    $usuario = $user->locate();

    $usuario_secundario = $user_secundario->setEmail($email);
    $usuario_secundario = $user_secundario->locate();

    if((is_null($usuario) || empty($usuario)) && (is_null($usuario_secundario) || empty($usuario_secundario))){
        $error = "E-mail inválido";
    }else{
        if(sha1($senha) == $usuario->senha || sha1($senha) == $usuario_secundario->senha){
            if(!isset($_SESSION)){
                session_start();
            }

            if(sha1($senha) == $usuario->senha){
                $_SESSION['email'] = $usuario->email;
                $_SESSION['id'] = $usuario->id;
            }else{
                $_SESSION['email'] = $usuario_secundario->email;
                $_SESSION['id'] = $usuario_secundario->id;
            }
            header("Location: admin.php");
        }else{
            $error = "Senha inválida";
        }
    }

    // Testando se é o primeiro acesso do usuário secundário
    if(sha1($senha) == sha1(123456)){
        header("Location: primeiro_acesso.php?id=". $usuario_secundario->id ."&usuarios_master_id=".$usuario_secundario->usuarios_master_id);
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
        <form class="form-signin" action="index.php" method="post">

            <span id="reauth-email" class="reauth-email"></span>

            <input type="email" class="form-control" name="email" placeholder="E-mail" required autofocus>

            <input type="password" class="form-control" name="senha" placeholder="Senha" required>


            <button class="btn btn-lg btn-primary btn-block btn-signin" id="btnentrar" type="submit" name="login">
                Entrar
            </button>
            <a href="cadastrarMaster.php">Cadastrar Usuário</a>

        </form><!-- /form -->

        <p class="text-center text-danger">
        </p>

        <!-- <a href="esqueceuSenha.php" data-toggle="modal" data-target="#senha-modal">
          Esqueceu a senha?
        </a> -->
    </div><!-- /card-container -->
</div><!-- /container -->


<!-- Modal Esqueci Senha-->
<!-- <div class="modal fade" id="senha-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
  <div class="modal-dialog" modal-lg role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalLabel">Digite seu e-mail</h4>
        <div class="modal-body"> -->
<!-- Text input-->
<!-- <div id="pf">
 <div class="form-group">
   <label class="col-md-4 control-label" for="textinput">E-mail</label>
   <div class="col-md-8">
     <form action="">
     <input placeholder="Seu e-mail" name="e-mail" type="text">
     <p></p>
   </div>
 </div>
</div>
<div id=>
 <div class="form-group">
   <div id="botao" align="center">
     <button type="button" class="btn btn-primary">Enviar</button>
   </div>
 </div>
</div>
</div>
</div>
</div>
</div>
</div>  -->

</body>
</html>
<?php
require_once 'footer.php';
?>