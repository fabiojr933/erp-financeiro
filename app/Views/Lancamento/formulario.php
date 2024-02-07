<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lançamento manual</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a class="btn btn-primary btn-group" style="margin-right: 15px;" href="/contasPagar"><i class="fas fa-share"></i></a>
                        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="/lancamento">Lancamento</a></li>
                        <li class="breadcrumb-item active">Novo</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">



            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Digite os campos abaixo</h3>
                        </div>
                        <form action="/lancamento/store" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Tipo</label>
                                            <select class="form-control" id="tipo" name="tipo" style="width: 100%;" onchange="alteraTipo()" required>
                                                <option value="despesa">Despesa</option>
                                                <option value="receita">Receita</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="">Descrição</label>
                                            <input type="text" class="form-control" name="descricao" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Data pagamento</label>
                                            <input type="date" class="form-control" name="data_pagamento" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group" id="valor">
                                            <label for="">Valor</label>
                                            <input type="text" class="form-control" id="valor" name="valor" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Pagamento</label>
                                            <select class="form-control select2bs4" id="pagamento" name="pagamento" style="width: 100%;" onchange="alteraTipo2()" required>
                                                <option value="dinheiro">Dinheiro</option>
                                                <option value="outros">Cartão/Pix</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-5" id="dinheiro">
                                        <div class="form-group">
                                            <label>Dinheiro</label>
                                            <select class="form-control select2bs4" id="dinheiro" name="dinheiro" style="width: 100%;" required>
                                                <?php foreach ($caixa as $data) {  ?>
                                                    <option value="<?php echo $data['id_caixa'] ?>"><?php echo $data['nome'] ?> </option>
                                                <?php } ?>
                                            </select>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-5" id="outros">
                                        <div class="form-group">
                                            <label>Cartão/Pix</label>
                                            <select class="form-control select2bs4" id="outros" name="outros" style="width: 100%;" required>
                                                <?php foreach ($cartao as $data) {  ?>
                                                    <option value="<?php echo $data['id_cartao'] ?>"><?php echo $data['nome'] ?> - <?php echo $data['tipo']  ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>É Cliente ou Fornecedor</label>
                                            <select class="form-control select2bs4" id="tipo_cli_for" name="tipo_cli_for" style="width: 100%;" onchange="alteraTipo3()" required>
                                              
                                                    <option value="cliente">Cliente</option>
                                                    <option value="fornecedor">Fornecedor</option>
                                              
                                            </select>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="id_fornecedor">
                                        <div class="form-group">
                                            <label>Fornecedor</label>
                                            <select class="form-control select2bs4" id="id_fornecedor" name="id_fornecedor" style="width: 100%;" required>
                                                <?php foreach ($fornecedor as $data) {  ?>
                                                    <option value="<?php echo $data['id_fornecedor'] ?>"><?php echo $data['nome'] == null ? $data['razao_social'] : $data['nome'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="id_cliente">
                                        <div class="form-group">
                                            <label>Cliente</label>
                                            <select class="form-control select2bs4" id="id_cliente" name="id_cliente" style="width: 100%;" required>
                                                <?php foreach ($cliente as $data) {  ?>
                                                    <option value="<?php echo $data['id_cliente'] ?>"><?php echo $data['nome'] == null ? $data['razao_social'] : $data['nome'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="id_receita">
                                        <div class="form-group">
                                            <label>Receita</label>
                                            <select class="form-control select2bs4" name="id_receita" style="width: 100%;" required>
                                                <?php foreach ($receita as $data) {  ?>
                                                    <option value="<?php echo $data['id_receita'] ?>"><?php echo $data['nome'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="id_despesa">
                                        <div class="form-group">
                                            <label>Despesa</label>
                                            <select class="form-control select2bs4" id="id_despesa" name="id_despesa" style="width: 100%;" required>
                                                <?php foreach ($despesa as $data) {  ?>
                                                    <option value="<?php echo $data['id_contaFluxo'] ?>"><?php echo $data['nome'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Observações</label>
                                            <textarea class="form-control" rows="5" name="observacao"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Aplica a máscara ao campo de saldo
        $('#valor input[name="valor"]').inputmask('currency', {
            radixPoint: ',',
            groupSeparator: '.',
            allowMinus: false, // Descomente esta linha se quiser permitir números negativos
            prefix: '',
            autoUnmask: true
        });
    });
</script>

<script>
    function alteraTipo() {
        tipo = document.getElementById('tipo').value;
        if (tipo == 'despesa') {
            document.getElementById('id_receita').hidden = true;
            document.getElementById('id_despesa').hidden = false;
        } else {
            document.getElementById('id_receita').hidden = false;
            document.getElementById('id_despesa').hidden = true;
        }
    }
    alteraTipo();
</script>

<script>
    function alteraTipo2() {
        tipo = document.getElementById('pagamento').value;
        if (tipo == 'dinheiro') {
            document.getElementById('outros').hidden = true;
            document.getElementById('dinheiro').hidden = false;
        } else {
            document.getElementById('outros').hidden = false;
            document.getElementById('dinheiro').hidden = true;
        }
    }
    alteraTipo2();
</script>

<script>
    function alteraTipo3() {
        tipo = document.getElementById('tipo_cli_for').value;
        if (tipo == 'fornecedor') {
            document.getElementById('id_cliente').hidden = true;
            document.getElementById('id_fornecedor').hidden = false;
        } else {
            document.getElementById('id_cliente').hidden = false;
            document.getElementById('id_fornecedor').hidden = true;
        }
    }
    alteraTipo3();
</script>