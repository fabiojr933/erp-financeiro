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
                    <h1 class="m-0">Lista de caixa</h1>
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
                            <a class="btn btn-primary" href="/caixa/novo"> <i class="nav-icon fas fa-plus"></i></a>
                        </div> <br>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table id="tabelaDados" class="table table-hover text-nowrap table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 35px">#</th>
                                        <th>Nome</th>                                        
                                        <th>Saldo</th>
                                        <th class="no-print" style="width: 130px">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($caixa)) : ?>
                                        <?php foreach ($caixa as $data) : ?>
                                            <tr>
                                                <td><?php echo $data['id_caixa'] ?></td>
                                                <td><?php echo $data['nome'] ?></td>                                               
                                                <?php if ($data['saldo']) : ?>
                                                    <td><?php echo $data['saldo'] ?></td>
                                                <?php endif; ?>                                                    
                                                <td>
                                                    <a href="/caixa/visualizar/<?php echo $data['id_caixa'] ?>" class="btn btn-primary btn-xs"><i class="fas fa-search"></i></a>
                                                    <a href="/caixa/editar/<?php echo $data['id_caixa'] ?>" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                                                    <button type="button" onclick="document.getElementById('id_caixa').value = '<?php echo  $data['id_caixa'] ?>'" data-toggle="modal" data-target="#modal-default" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>
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
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/caixa/excluir" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Deseja realmente excluir ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_caixa" name="id_caixa" value="" />
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