<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Visualizar conta do Fluxo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a class="btn btn-primary btn-group" style="margin-right: 15px;" href="/contaFluxo"><i class="fas fa-share"></i></a>
                        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="/contaFluxo">Conta Fluxo</a></li>
                        <li class="breadcrumb-item active">visualizar</li>
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
                            <h3 class="card-title">registro abaixo</h3>
                        </div>
                        <form action="/contaFluxo/update" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <input class="form-control" type="hidden" value="<?php echo $contaFluxo['id_contaFluxo']; ?>" name="id_contaFluxo">
                                </div>
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" disabled name="nome" value="<?php echo $contaFluxo['nome']; ?>" name="nome" placeholder="Digite a nome da conta do Fluxo" required>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox2" disabled name="ativo" <?php echo $contaFluxo['ativo'] == 'S' ? 'checked' : '' ?>>
                                    <label for="customCheckbox2" class="custom-control-label">Ativo ?</label>
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