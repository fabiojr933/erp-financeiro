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
                    <h1 class="m-0">Pagamento de contas a PAGAR</h1>
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
                            <a class="btn btn-primary" href="/contasPagar/pagamento"> <i class="nav-icon fas fa-plus"></i></a>
                        </div><br>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table id="tabelaDados" class="table table-hover text-nowrap table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 35px">#</th>
                                        <th>Fornecedor</th>
                                        <th>Vencimento</th>
                                        <th>Valor</th>
                                        <th>Status</th>
                                        <th class="no-print" style="width: 130px">Pagar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($contasPagar)) : ?>
                                        <?php foreach ($contasPagar as $data) : ?>
                                            <tr>
                                                <td><?php echo $data['id_contasPagar'] ?></td>
                                                <td><?php echo $data['nome'] == null ? $data['razao_social'] : $data['nome'] ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($data['vencimento'])); ?></td>
                                                <td>R$: <?php echo number_format($data['valor'], 2, ',', '.'); ?></td>
                                                <td><?php echo $data['status'] ?></td>
                                                <td>
                                                    <button type="button" onclick="document.getElementById('id_contasPagar').value = '<?php echo  $data['id_contasPagar'] ?>'" data-toggle="modal" data-target="#modal-default" class="btn btn-danger btn-xs"><i class="fas fa-dollar-sign"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="5">Nenhuma conta a pagar cadastrada</td>
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


<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/contasPagar/pagamento" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Deseja Pagar esse documento ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_contasPagar" name="id_contasPagar" value="" />
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>É uma Despesa ou uma Receita?</label>
                            <select class="form-control select2bs4" name="ip_tipo" id="ip_tipo" style="width: 100%;" onchange="alteraTipo()">
                                <option value="despesa">Despesa</option>
                                <option value="receita">Receita</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12" id="id_fluxo">
                        <div class="form-group">
                            <label>Escolha o Fluxo Financeiro</label>
                            <select class="form-control select2bs4" name="id_fluxo" id="id_fluxo" style="width: 100%;">
                                <?php foreach ($fluxo as $data) {  ?>
                                 <option value="<?php echo $data['id_contaFluxo'] ?>"><?php echo $data['nome'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12" id="id_receita">
                        <div class="form-group">
                            <label>Escolha a Receita</label>
                            <select class="form-control select2bs4" name="id_receita" id="id_receita" style="width: 100%;">
                                <?php foreach ($receita as $re) {  ?>
                                 <option value="<?php echo $re['id_receita'] ?>"><?php echo $re['nome'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">PAGAR</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function alteraTipo() {
        tipo = document.getElementById('ip_tipo').value;       
        if (tipo == 'despesa') {
            document.getElementById('id_receita').hidden = true;
            document.getElementById('id_fluxo').hidden = false;
        } else {
            document.getElementById('id_receita').hidden = false;
            document.getElementById('id_fluxo').hidden = true;
        }
    }
    alteraTipo();
</script>