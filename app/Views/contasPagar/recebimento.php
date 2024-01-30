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
                        <br>
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
                                                <td>  <?php echo (isset($data['vencimento']) && $data['vencimento'] > date('Y-m-d')) ? '<span class="badge bg-danger">Vencido</span>' : '<span class="badge bg-success">A vencer</span>'; ?></td>
                                                <td>
                                                    <a type="button" onclick="setContasPagarValues('<?php echo $data['id_contasPagar']; ?>', '<?php echo $data['valor']; ?>')" data-toggle="modal" data-target="#modal-default" class=""><span class="badge bg-success">PAGAR</span></button>
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
                    <input type="hidden" id="valor_contasPagar" name="valor_contasPagar" value="" />
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tipo</label>
                            <select class="form-control select2bs4" name="ip_tipo" id="ip_tipo" style="width: 100%;" onchange="alteraTipo()">
                                <option selected value="despesa">Despesa</option>                             
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tipo pagamento</label>
                            <select class="form-control select2bs4" name="id_pagamento" id="id_pagamento" style="width: 100%;" onchange="alteraTipo2()">                             
                                    <option value="1">Dinheiro</option>   
                                    <option value="2">Cartão/Deposito/Pix</option>                             
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12" id="id_caixa">
                        <div class="form-group">
                            <label>Seleciona</label>
                            <select class="form-control select2bs4" name="id_caixa" id="id_caixa" style="width: 100%;">
                                <?php foreach ($caixa as $cai) {  ?>
                                    <option value="<?php echo $cai['id_caixa'] ?>"><?php echo $cai['nome'] ?></option>
                                <?php } ?>                               
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12" id="id_cartao">
                        <div class="form-group">
                            <label>Seleciona</label>
                            <select class="form-control select2bs4" name="id_cartao" id="id_cartao" style="width: 100%;">                               
                                <?php foreach ($cartao as $car) {  ?>
                                    <option value="<?php echo $car['id_cartao'] ?>"><?php echo $car['nome'] ?> - <?php echo $car['tipo'] ?></option>
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
    function setContasPagarValues(idContasPagar, valorContasPagar) {
        document.getElementById('id_contasPagar').value = idContasPagar;
        document.getElementById('valor_contasPagar').value = valorContasPagar;
    }
</script>

<script>
    function alteraTipo2() {
        tipo = document.getElementById('id_pagamento').value;
        if (tipo == '1') {
            document.getElementById('id_cartao').hidden = true;
            document.getElementById('id_caixa').hidden = false;
        } else {
            document.getElementById('id_cartao').hidden = false;
            document.getElementById('id_caixa').hidden = true;
        }
    }
    alteraTipo2();
</script>