<?php
require_once 'header.php';
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Relatórios</h4>
                    </div>
                    <div class="card-content">
                        <ul class="nav nav-tabs justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link" href="periodoFralda.php">Fraldas</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="periodoBanhos.php">Banhos</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="relatorioPesoAltura.php?id=<?php echo $_SESSION['id']; ?>">Peso e Altura</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="periodoConsultas.php">Consultas</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'footer.php';
?>
