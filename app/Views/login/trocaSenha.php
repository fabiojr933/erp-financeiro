<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            <?php
            $session = session();
            $alert = $session->get('alert');
            ?>

            <?php if (isset($alert)) : ?>

                <?php if ($alert == 'success_troca_senha') : ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-primary alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Senha alterado com sucesso!
                            </div>
                        </div>
                    </div>
                <?php elseif ($alert == 'erro_troca_senha') : ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                A senha nova e a Confirma senha, não são iguais!
                            </div>
                        </div>
                    </div>
                <?php elseif ($alert == 'erro_troca_senha2') : ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Sua senha atual esta errada!
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            <?php endif; ?>


            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Trocar senha</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a class="btn btn-primary btn-group" style="margin-right: 15px;" href="/"><i class="fas fa-share"></i></a>
                        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="/usuario/senha">Senha</a></li>
                        <li class="breadcrumb-item active">trocar</li>
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
                        <form action="<?php base_url() ?>/usuario/mudarSenha" method="POST">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Digite sua senha atual</label>
                                        <input type="text" class="form-control" id="senha_atual" name="senha_atual" placeholder="Digite sua senha atual" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Digite sua senha nova</label>
                                        <input type="text" class="form-control" id="senha_nova" name="senha_nova" placeholder="Digite sua senha nova" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Confirma sua senha nova</label>
                                        <input type="text" class="form-control" id="senha_confirma" name="senha_confirma" placeholder="Confirma sua senha nova" required>
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
<!-- /.content-wrapper -->