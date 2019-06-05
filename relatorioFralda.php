<?php
require_once 'header.php';

require_once 'assets/php/classes/classFraldas.php';
$fralda = new Fraldas();

if (isset($_POST['search'])) {
    $resultado = $fralda->trocaDeFraldas($_POST['bebe_id'],$_POST['data_inicial'],$_POST['data_final']);
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Relatório</h4>
                        <p class="category">Troca de fraldas</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>
                                    Data
                                </th>
                                <th>
                                    Quantidade
                                </th>
                                </thead>
                                <tbody>
                                <?php while($row = $resultado->fetch(PDO::FETCH_OBJ)) { ?>
                                    <tr>
                                        <td>
                                            <?php echo date('d/m/Y', strtotime($row->dia)); ?>
                                        </td>
                                        <td>
                                            <?php echo $row->quantidade; ?>
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


