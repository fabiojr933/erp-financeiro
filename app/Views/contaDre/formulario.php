<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Nova conta Dre</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a class="btn btn-primary btn-group" style="margin-right: 15px;" href="/contaDre"><i class="fas fa-share"></i></a>
                        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="/contaDre">contaDre</a></li>
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
                        <form action="<?php base_url() ?>/contaDre/store" method="POST">
                            <div class="card-body">
                                <?php if (isset($contaDre)) : ?>
                                    <input type="hidden" class="form-control" id="id_contaDre" name="id_contaDre" value="<?php echo (isset($contaDre)) ? $contaDre['id_contaDre'] : '' ?>">
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Nome da conta do Dre</label>
                                            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $contaDre['nome'] ?>" required="">
                                        </div>
                                    </div>                                   

                                <?php if ($contaDre == null) : ?>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="ativo" checked>
                                        <label for="customCheckbox2" class="custom-control-label">Ativo ?</label>
                                    </div>
                                <?php endif; ?>
                                <?php if ($contaDre) : ?>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="ativo" <?php echo $contaDre['ativo'] == 'S' ? 'checked' : '' ?>>
                                        <label for="customCheckbox2" class="custom-control-label">Ativo ?</label>
                                    </div>
                                <?php endif; ?>

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