<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Visualizar conta a receber</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a class="btn btn-primary btn-group" style="margin-right: 15px;" href="/contasReceber"><i class="fas fa-share"></i></a>
                        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="/contasReceber">Conta a receber</a></li>
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
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" id="status" name="status" style="width: 100%;" required="">
                                            <option value="Aberta" selected>Aberta</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Descrição</label>
                                        <input type="text" class="form-control" name="descricao" value="<?php echo $contasReceber['descricao'] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Data de Venc.</label>
                                        <input type="date" class="form-control" name="vencimento" value="<?php echo $contasReceber['vencimento'] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group" id="valor">
                                        <label for="">Valor</label>
                                        <input type="text" class="form-control" id="valor" name="valorr" value="<?php echo $contasReceber['valor'] ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Cliente</label>
                                        <select class="form-control select2bs4" name="id_cliente" style="width: 100%;">
                                            <option value="<?php echo $contasReceber['id_cliente'] ?>"><?php echo $contasReceber['nome'] ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">Observações</label>
                                        <textarea class="form-control" rows="5" name="observacao"><?php echo $contasReceber['observacao'] ?></textarea>
                                    </div>
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