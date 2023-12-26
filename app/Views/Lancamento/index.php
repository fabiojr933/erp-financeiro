<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <?php
            $session = session();
            $alert = $session->get('alert');
            ?>

            <?php if (isset($alert)) : ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-<?php echo $alert['cor'] ?> alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php echo $alert['titulo'] ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lista de lançamentos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-primary" href="/lancamento/novo"> <i class="nav-icon fas fa-plus"></i></a>
                        </div><br>
                        <!-- /.card-header -->

                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <div class="card card-primary card-tabs">
                                    <div class="card-header p-0 pt-1">
                                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Lançamentos</a>
                                            </li>                                           
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-one-tabContent">
                                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                                <div class="card-body table-responsive p-0">
                                                    <table id="tabelaDados" class="table table-hover text-nowrap table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 35px">#</th>
                                                                <th>Tipo</th>
                                                                <th>Descricao</th>
                                                                <th>valor</th>
                                                                <th>Data pagamento</th>
                                                                <th class="no-print" style="width: 130px">Ações</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (!empty($lancamento)) : ?>
                                                                <?php foreach ($lancamento as $data) : ?>
                                                                    <tr>
                                                                        <td><?php echo $data['id_lancamento'] ?></td>
                                                                        <td><?php echo $data['tipo'] ?></td>
                                                                        <td><?php echo $data['descricao'] ?></td>
                                                                        <td>R$: <?php echo number_format($data['valor'], 2, ',', '.'); ?></td>
                                                                        <td><?php echo date('d/m/Y', strtotime($data['data_pagamento'])); ?></td>
                                                                        <td>
                                                                            <button type="button" onclick="document.getElementById('id_lancamento').value = '<?php echo  $data['id_lancamento'] ?>'" data-toggle="modal" data-target="#modal-default" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach ?>
                                                            <?php else : ?>
                                                                <tr>
                                                                    <td colspan="6">Nenhuma conta a pagar cadastrada</td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/lancamento/excluir" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Deseja realmente excluir ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_lancamento" name="id_lancamento" value="" />
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                    <button type="submit" class="btn btn-primary">Sim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-default2">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/lancamento/cancelamento" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Deseja realmente cancelar essa Baixa ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_lancamento2" name="id_lancamento2" value="" />
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                    <button type="submit" class="btn btn-primary">Sim</button>
                </div>
            </form>
        </div>
    </div>
</div>

