<?php
require_once 'header.php';

require_once 'assets/php/classes/classConsultas.php';
$consulta = new Consultas();

if (isset($_POST['search'])) {
    $resultado = $consulta->consultasRealizadas($_POST['bebe_id'],$_POST['data_inicial'],$_POST['data_final']);
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="orange">
                        <h4 class="title">Relatório</h4>
                        <p class="category">Consultas</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>
                                    Data
                                </th>
                                <th>
                                    Medico
                                </th>
                                <th>
                                    Local
                                </th>
                                <th>
                                    Observação
                                </th>

                                </thead>
                                <tbody>
                                <?php while($row = $resultado->fetch(PDO::FETCH_OBJ)) { ?>
                                    <tr>
                                        <td>
                                            <?php echo date('d/m/Y', strtotime($row->dia)); ?>
                                        </td>
                                        <td>
                                            <?php echo $row->medico; ?>
                                        </td>

                                         <td>
                                            <?php echo $row->local; ?>
                                        </td>
                                         <td>
                                            <?php echo $row->observacao; ?>
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


