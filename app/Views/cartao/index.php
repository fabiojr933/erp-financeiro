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
                    <h1 class="m-0">Lista de cartões</h1>
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
                        <div class="card-header">
                            <a class="btn btn-primary" href="/cartao/novo"> <i class="nav-icon fas fa-plus"></i></a>
                        </div> <br>
                        <div class="row">                           
                            <div class="col-12 col-sm-12">
                                <div class="card card-primary card-tabs">
                                    <div class="card-header p-0 pt-1">
                                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">                                            
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Cartões</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Pagar fatura do cartão credito</a>
                                            </li>                                           
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-two-tabContent">
                                            <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                                <div class="card-body table-responsive p-0">
                                                    <table id="tabelaDados" class="table table-hover text-nowrap table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 35px">#</th>
                                                                <th>Nome</th>
                                                                <th>Agencia</th>
                                                                <th>Conta</th>
                                                                <th>Vencimento</th>
                                                                <th>Tipo</th>
                                                                <th>Saldo</th>
                                                                <th>limite</th>
                                                                <th class="no-print" style="width: 130px">Ações</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (!empty($cartao)) : ?>
                                                                <?php foreach ($cartao as $data) : ?>
                                                                    <tr>
                                                                        <td><?php echo $data['id_cartao'] ?></td>
                                                                        <td><?php echo $data['nome'] ?></td>
                                                                        <td><?php echo $data['agencia'] ?></td>
                                                                        <td><?php echo $data['conta'] ?></td>
                                                                        <td>Dia <?php echo $data['vencimento'] ?></td>
                                                                        <td><?php echo $data['tipo'] ?></td>
                                                                        <?php if ($data['saldo']) : ?>
                                                                            <td><?php echo $data['saldo'] ?></td>
                                                                        <?php endif; ?>
                                                                        <?php if ($data['limite']) : ?>
                                                                            <td><?php echo $data['limite'] ?></td>
                                                                        <?php endif; ?>
                                                                        <td>
                                                                            <a href="/cartao/visualizar/<?php echo $data['id_cartao'] ?>" class="btn btn-primary btn-xs"><i class="fas fa-search"></i></a>
                                                                            <a href="/cartao/editar/<?php echo $data['id_cartao'] ?>" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                                                                            <button type="button" onclick="document.getElementById('id_cartao').value = '<?php echo  $data['id_cartao'] ?>'" data-toggle="modal" data-target="#modal-default" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach ?>
                                                            <?php else : ?>
                                                                <tr>
                                                                    <td colspan="3">Nenhum cartão cadastrada</td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                                                Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                                            </div>                                          
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
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
            <form action="/cartao/excluir" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Deseja realmente excluir ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_cartao" name="id_cartao" value="" />
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                    <button type="submit" class="btn btn-primary">Sim</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--
<script>
    function confirmaExclusao(id_receita) {
        var conf = confirm('Deseja realmente excluir ?', 'Atenção');
        if (conf) {
            $.ajax({
                url: '',
                method: 'get',
                success: function(response) {
                    window.location.href = '';
                },
                error: function(error) {
                    // Lógica em caso de erro
                    console.error(error);
                }
            });
        }
    }
</script>  -->