<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Novo cliente</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a class="btn btn-primary btn-group" style="margin-right: 15px;" href="/cliente"><i class="fas fa-share"></i></a>
                        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="/cliente">cliente</a></li>
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
                        <form action="<?php base_url() ?>/cliente/store" method="POST">
                            <div class="card-body">
                                <?php if (isset($cliente)) : ?>
                                    <input type="hidden" class="form-control" id="id_cliente" name="id_cliente" value="<?php echo (isset($cliente)) ? $cliente['id_cliente'] : '' ?>">
                                <?php endif; ?>



                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Tipo</label>
                                            <select class="form-control select2" id="tipo" name="tipo" style="width: 100%;" onchange="alteraTipo()">
                                                <option value="fisica" <?php echo $cliente['tipo'] == 'fisica' ? 'selected' : '' ?>>Pessoa Física</option>
                                                <option value="juridica" <?php echo $cliente['tipo'] == 'juridica' ? 'selected' : '' ?>>Pessoa Jurídica</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Nome</label>
                                            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $cliente['nome'] ?>" required="">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">CPF</label>
                                            <input type="text" class="form-control cpf" id="cpf" name="cpf" value="<?php echo $cliente['cpf'] ?>" required="">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Razão social</label>
                                            <input type="text" class="form-control" id="razao_social" name="razao_social" value="<?php echo $cliente['razao_social'] ?>" required="">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">CNPJ</label>
                                            <input type="text" class="form-control cnpj" id="cnpj" name="cnpj" value="<?php echo $cliente['cnpj'] ?>" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="">Isento</label>
                                            <select class="form-control select2" id="isento" name="isento" style="width: 100%" onchange="alteraIsento()">
                                                <option value="sim" <?php echo $cliente['isento'] == 'sim' ? 'selected' : '' ?>>Sim</option>
                                                <option value="nao" <?php echo $cliente['isento'] == 'não' ? 'selected' : '' ?>>Não</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4" style="">
                                        <div class="form-group">
                                            <label for="">I.E.</label>
                                            <input type="text" class="form-control" id="input-ie" name="ie" value="<?php echo $cliente['ie'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 class="m-0 text-dark"><i class="fa fa-user-plus"></i> Endereço</h6>
                                </div><!-- /.col -->
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">CEP</label>
                                        <input type="text" class="form-control cep" id="cep" name="cep" value="<?php echo $cliente['cep'] ?>" required="">
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <label for="">Logradouro</label>
                                        <input type="text" class="form-control" name="logradouro" value="<?php echo $cliente['logradouro'] ?>" required="">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <label for="">Número</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $cliente['numero'] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="">Complemento</label>
                                        <input type="text" class="form-control" id="complemento" name="complemento" value="<?php echo $cliente['complemento'] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Bairro</label>
                                        <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $cliente['bairro'] ?>" required="">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <label for="">Estado</label>
                                    <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $cliente['estado'] ?>" required="">
                                </div>
                                <div class="col-lg-4">
                                    <label for="">Cidade</label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $cliente['cidade'] ?>" required="">
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6><i class="fa fa-phone-square"></i> Contato</h6>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Fixo</label>
                                        <input type="text" class="form-control fixo" name="fixo" value="<?php echo $cliente['fixo'] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Celular 1</label>
                                        <input type="text" class="form-control celular" name="celular_1" value="<?php echo $cliente['celular_1'] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Celular 2</label>
                                        <input type="text" class="form-control celular" name="celular_2" value="<?php echo $cliente['celular_2'] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">E-mail</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo $cliente['email'] ?>">
                                    </div>
                                </div>
                            </div>

                            <?php if ($cliente == null) : ?>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="ativo" checked>
                                    <label for="customCheckbox2" class="custom-control-label">Ativo ?</label>
                                </div>
                            <?php endif; ?>
                            <?php if ($cliente) : ?>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="ativo" <?php echo $cliente['ativo'] == 'S' ? 'checked' : '' ?>>
                                    <label for="customCheckbox2" class="custom-control-label">Ativo ?</label>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    function alteraTipo() {
        tipo = document.getElementById('tipo').value;

        if (tipo == 'fisica') {
            // Reabilita campos PESSOA FÍSICA
            document.getElementById('nome').disabled = false;
            document.getElementById('cpf').disabled = false;

            // Desabilita e limpa campos PESSOA JURÍDICA
            document.getElementById('razao_social').disabled = true;
            document.getElementById('cnpj').disabled = true;
            document.getElementById('razao_social').value = "";
            document.getElementById('cnpj').value = "";
        } else {
            // Desabilita e limpa campos PESSOA FÍSICA
            document.getElementById('nome').disabled = true;
            document.getElementById('cpf').disabled = true;
            document.getElementById('nome').value = "";
            document.getElementById('cpf').value = "";

            // Reabilita os campos para uso PESSOA JURÍDICA
            document.getElementById('razao_social').disabled = false;
            document.getElementById('cnpj').disabled = false;
        }
    }

    function alteraIsento() {
        isento = document.getElementById('isento').value;

        if (isento == 'sim') {
            // Desabilita campo
            document.getElementById('input-ie').disabled = true;
            // Limpa campo
            document.getElementById('input-ie').value = "";
        } else {
            // Desabilita campo
            document.getElementById('input-ie').disabled = false;
        }
    }

    // Chama as funções para trabalhar nos campos
    alteraTipo();
    alteraIsento();
</script>
<!-- /.content-wrapper -->