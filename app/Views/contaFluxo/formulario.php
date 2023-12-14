<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nova conta do Fluxo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a class="btn btn-primary btn-group" style="margin-right: 15px;" href="/contaFluxo"><i class="fas fa-share"></i></a>
                        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="/contaFluxo">contaFluxo</a></li>
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
                        <form action="<?php base_url() ?>/contaFluxo/store" method="POST">
                            <div class="card-body">
                                <?php if (isset($contaFluxo)) : ?>
                                    <input type="hidden" class="form-control" id="id_contaFluxo" name="id_contaFluxo" value="<?php echo (isset($contaFluxo)) ? $contaFluxo['id_contaFluxo'] : '' ?>">
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nome da conta do Fluxo</label>
                                            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $contaFluxo['nome'] ?>" required="">
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Essa conta esta vinculado com?</label>
                                            <select class="form-control select2bs4" name="id_contaDre" style="width: 100%;">
                                                <?php foreach ($contaDre as $conta) {  ?>
                                                    <option value="<?php echo $conta['id_contaDre'] ?>" <?php echo $conta['id_contaDre'] == $contaFluxo['id_contaDre'] ? 'SELECTED' : $conta['id_contaDre'] ?>><?php echo $conta['nome'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <?php if ($contaFluxo == null) : ?>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="ativo" checked>
                                            <label for="customCheckbox2" class="custom-control-label">Ativo ?</label>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($contaFluxo) : ?>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="ativo" <?php echo $contaFluxo['ativo'] == 'S' ? 'checked' : '' ?>>
                                            <label for="customCheckbox2" class="custom-control-label">Ativo ?</label>
                                        </div>
                                    <?php endif; ?>

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
    </div>
</div>
<!-- /.content-wrapper -->