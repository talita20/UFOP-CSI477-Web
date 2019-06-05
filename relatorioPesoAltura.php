<?php
require_once 'header.php';

require_once 'assets/php/classes/classPesoAltura.php';
$info = new PesoAltura();

$resultado = $info->historico($_GET['id']);

?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Relatório</h4>
                        <p class="category">Pesos e alturas do bebê</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>
                                    Peso
                                </th>
                                <th>
                                    Altura
                                </th>
                                </thead>
                                <tbody>
                                <?php while($row = $resultado->fetch(PDO::FETCH_OBJ)) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $row->peso; ?> gramas
                                        </td>
                                        <td>
                                            <?php echo $row->altura; ?> cm
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


