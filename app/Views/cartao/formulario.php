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
                                <?php if (isset($cartao)) : ?>
                                    <input type="hidden" class="form-control" id="id_cartao" name="id_cartao" value="<?php echo (isset($cartao)) ? $cartao['id_cartao'] : '' ?>">
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Tipo</label>
                                            <select class="form-control select2" id="tipo" name="tipo" style="width: 100%;" >
                                                <option value="debito" <?php echo $cartao['tipo'] == 'debito' ? 'selected' : '' ?>>Debito</option>
                                                <option value="credito" <?php echo $cartao['tipo'] == 'credito' ? 'selected' : '' ?>>Credito</option>
                                            </select>
                                        </div>
                                    </div>   
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="">Nome do cartão</label>
                                            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $cartao['nome'] ?>" required="">
                                        </div>
                                    </div>                                
                                </div>
                               
                                <?php if ($cartao == null) : ?>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="ativo" checked>
                                        <label for="customCheckbox2" class="custom-control-label">Ativo ?</label>
                                    </div>
                                <?php endif; ?>
                                <?php if ($cartao) : ?>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="ativo" <?php echo $cartao['ativo'] == 'S' ? 'checked' : '' ?>>
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
