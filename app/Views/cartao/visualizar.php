<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Novo cartão</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a class="btn btn-primary btn-group" style="margin-right: 15px;" href="/cartao"><i class="fas fa-share"></i></a>
                        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="/cartao">cartao</a></li>
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
                        <form action="<?php base_url() ?>/cartao/store" method="POST">
                            <div class="card-body">
                                <label>Nome</label>                               
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Tipo</label>
                                            <select class="form-control select2" id="tipo" name="tipo" style="width: 100%;">
                                                <option disabled value="<?php echo $cartao['tipo'] == 'debito' ? 'debito' : 'credito' ?>" selected=""><?php echo $cartao['tipo'] == 'debito' ? 'debito' : 'credito' ?></option>                                              
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group" id="saldo">
                                            <label for="">Saldo</label>
                                            <input type="text" class="form-control" name="saldo" value="<?php echo $cartao['saldo'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group" id="limite">
                                            <label for="">Limite</label>
                                            <input type="text" class="form-control" name="limite" value="<?php echo $cartao['limite'] ?>">
                                        </div>
                                    </div>

                                </div>

                                

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Nome do cartão</label>
                                            <input type="text" class="form-control" id="nome" name="nome" disabled value="<?php echo $cartao['nome'] ?>" required="">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Agencia</label>
                                            <input type="number" class="form-control" name="agencia" disabled value="<?php echo $cartao['agencia'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Nº da conta</label>
                                            <input type="number" class="form-control" name="conta" disabled value="<?php echo $cartao['conta'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Vencimento</label>
                                            <input type="number" class="form-control" name="vencimento" disabled value="<?php echo $cartao['vencimento'] ?>">
                                        </div>
                                    </div>
                                </div>
                                    <?php if ($cartao) : ?>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" disabled id="customCheckbox2" name="ativo" <?php echo $cartao['ativo'] == 'S' ? 'checked' : '' ?>>
                                            <label for="customCheckbox2" class="custom-control-label">Ativo ?</label>
                                        </div>
                                    <?php endif; ?>                               

                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function alteraTipo() {
        tipo = document.getElementById('tipo').value;

        if (tipo == 'debito') {
            document.getElementById('limite').hidden = true;
            document.getElementById('saldo').hidden = false;
        } else {
            document.getElementById('limite').hidden = false;
            document.getElementById('saldo').hidden = true;
        }
    }

    // Chama as funções para trabalhar nos campos
    alteraTipo();
</script>

<script>
    $(document).ready(function() {
        // Aplica a máscara ao campo de saldo
        $('#saldo input[name="saldo"]').inputmask('currency', {
            radixPoint: ',',
            groupSeparator: '.',
            allowMinus: false, // Descomente esta linha se quiser permitir números negativos
            prefix: 'R$ ',
            autoUnmask: true
        });
        $('#limite input[name="limite"]').inputmask('currency', {
            radixPoint: ',',
            groupSeparator: '.',
            allowMinus: false, // Descomente esta linha se quiser permitir números negativos
            prefix: 'R$ ',
            autoUnmask: true
        });
    });
</script>