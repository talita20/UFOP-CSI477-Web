<?php session_start(); ?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png"/>
    <link rel="icon" type="image/jpg" href="assets/img/logo6.jpg"/>
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

<body>
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-1.jpg" align="center">

        <a href="./admin.php" class="simple-text">
            <img class="logo1" src="assets/img/logo5.jpg">
        </a>

        <div class="sidebar-wrapper">
            <ul class="nav">
                <li id="dashboard">
                    <a href="./admin.php">
                        <i class="material-icons">dashboard</i>
                        <p>Página Inicial</p>
                    </a>
                </li>
                <li id="dados">
                    <a href="cadastrar_dados.php">
                        <i class="material-icons">perm_identity</i>
                        <p>Dados</p>
                    </a>
                </li>
                <li id="alimentacao">
                    <a href="cadastrar_consulta.php">
                        <i class="material-icons">
                            local_hospital
                        </i>
                        <p>Consultas</p>
                    </a>
                </li>
                <li id="alimentacao">
                    <a href="cadastrar_alimentacao.php">
                        <i class="material-icons">
                            local_dining
                        </i>
                        <p>Alimentação</p>
                    </a>
                </li>
                <li id="fraldas">
                    <a href="cadastrar_fraldas.php">
                        <i class="material-icons">
                            child_care
                        </i>
                        <p>Fraldas</p>
                    </a>
                </li>
                <li id="banho">
                    <a href="cadastrar_banho.php">
                        <i class="material-icons">store</i>
                        <p>Banhos</p>
                    </a>
                </li>
                <li id="sono">
                    <a href="cadastrar_sono.php">
                        <i class="material-icons">
                            hotel
                        </i>
                        <p>Sono</p>
                    </a>
                </li>
                <!--<li id="contas">
                    <a href="">
                        <i class="material-icons">
                            contacts
                        </i>
                        <p>Contas</p>
                    </a>
                </li>-->
                <li id="sono">
                    <a href="relatorios.php">
                        <i class="material-icons">
                            bar_chart
                        </i>
                        <p>Relatórios</p>
                    </a>
                </li>
                <li id="sair">
                    <a href="./index.php">
                        <i class="material-icons">exit_to_app</i>
                        <p>Sair</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">