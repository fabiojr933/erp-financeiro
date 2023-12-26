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
                    <h1 class="m-0">Contas a receber</h1>
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
                            <a class="btn btn-primary" href="/contasReceber/novo"> <i class="nav-icon fas fa-plus"></i></a>
                        </div><br>

                        <!-- ./row -->
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <div class="card card-primary card-tabs">
                                    <div class="card-header p-0 pt-1">
                                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Abertas</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Pagas</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Messages</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Settings</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-one-tabContent">
                                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                                <div class="row">
                                                    <!-- /.card-header -->
                                                    <div class="card-body table-responsive p-0">
                                                        <table id="tabelaDados" class="table table-hover text-nowrap table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 35px">#</th>
                                                                    <th>Cliente</th>
                                                                    <th>Vencimento</th>
                                                                    <th>Valor</th>
                                                                    <th class="no-print" style="width: 130px">Ações</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if (!empty($contasReceber)) : ?>
                                                                    <?php foreach ($contasReceber as $data) : ?>
                                                                        <tr>
                                                                            <td><?php echo $data['id_contasreceber'] ?></td>
                                                                            <td><?php echo $data['nome'] ?></td>
                                                                            <td><?php echo date('d/m/Y', strtotime($data['vencimento'])); ?></td>
                                                                            <td>R$: <?php echo number_format($data['valor'], 2, ',', '.'); ?></td>
                                                                            <td>
                                                                                <a href="/contasReceber/visualizar/<?php echo $data['id_contasreceber'] ?>" class="btn btn-primary btn-xs"><i class="fas fa-search"></i></a>
                                                                                <!-- <button type="button" onclick="confirmaExclusao('<php echo $data['id_receita'] ?>')" class="btn btn-danger btn-xs">Excluir</button> -->
                                                                                <button type="button" onclick="document.getElementById('id_contasreceber').value = '<?php echo  $data['id_contasreceber'] ?>'" data-toggle="modal" data-target="#modal-default" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endforeach ?>
                                                                <?php else : ?>
                                                                    <tr>
                                                                        <td colspan="5">Nenhuma conta a receber cadastrada</td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                                <div class="row">
                                                    <!-- /.card-header -->
                                                    <div class="card-body table-responsive p-0">
                                                        <table id="tabelaDados2" class="table table-hover text-nowrap table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 35px">#</th>
                                                                    <th>Cliente</th>
                                                                    <th>Vencimento</th>
                                                                    <th>Valor</th>
                                                                    <th>Status</th>
                                                                    <th class="no-print" style="width: 130px">Ações</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if (!empty($contasReceberPagos)) : ?>
                                                                    <?php foreach ($contasReceberPagos as $data) : ?>
                                                                        <tr>
                                                                            <td><?php echo $data['id_contasreceber'] ?></td>
                                                                            <td><?php echo $data['nome'] ?></td>
                                                                            <td><?php echo date('d/m/Y', strtotime($data['vencimento'])); ?></td>
                                                                            <td>R$: <?php echo number_format($data['valor'], 2, ',', '.'); ?></td>
                                                                            <td><?php echo $data['status'] ?></td>
                                                                            <td>
                                                                                <button type="button" onclick="document.getElementById('id_contasreceber2').value = '<?php echo  $data['id_contasreceber'] ?>'" data-toggle="modal" data-target="#modal-default2" class="btn btn-danger btn-xs"><i class="fa fa-undo"></i></button>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endforeach ?>
                                                                <?php else : ?>
                                                                    <tr>
                                                                        <td colspan="5">Nenhuma conta a receber baixada</td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                                Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                                                Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
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
            <form action="/contasReceber/excluir" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Deseja realmente excluir ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_contasreceber" name="id_contasreceber" value="" />
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                    <button type="submit" class="btn btn-primary">Sim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-default2">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/contasReceber/cancelamento" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Deseja realmente cancelar essa BAIXA ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_contasreceber2" name="id_contasreceber2" value="" />
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