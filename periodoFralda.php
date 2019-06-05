<?php
require_once 'header.php';
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
                    <div class="card-content">
                        <form action="relatorioFralda.php" method="post">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Período Inicial</label>
                                        <input type="date" name="data_inicial" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Período Final</label>
                                        <input type="date" name="data_final" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="bebe_id" value="1">
                            <button type="submit" name="search" id="btnamarelo" class="btn btn-primary pull-right">
                                Pesquisar
                            </button>

                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
