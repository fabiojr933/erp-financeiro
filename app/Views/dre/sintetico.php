<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a class="btn btn-primary btn-group" style="margin-right: 15px;" href="/dre/sintetico"><i class="fas fa-share"></i></a>
                        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="/dre/sintetico">dre</a></li>
                        <li class="breadcrumb-item active">Novo</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="card no-print">
                <div class="card-body">
                    <form action="/dre/sintetico" method="get">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Data Inicio</label>
                                    <input type="date" class="form-control" name="data_inicio" value="<?php echo $data['data_inicio'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Data Final</label>
                                    <input type="date" class="form-control" name="data_final" value="<?php echo $data['data_final'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <button type="submit" class="btn btn-info" style="margin-top: 30px">Gerar Relatório</button>
                                <button type="button" class="btn btn-default" onclick="print()" style="margin-top: 30px"><i class="fas fa-print"></i> Imprimir</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">DRE SINTETICO</h3>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th colspan="3" style="text-align: center">DEMONSTRAÇÃO DE RESULTADO DO EXERCÍCIO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="background: lightgrey">
                                                <td><b> FATURAMENTO</b></td>                                              
                                                <td><b>TOTAL</b></td>
                                                <td><b></b></td>
                                            </tr>
                                            <?php $totalReceita = 0; ?>
                                            <?php foreach ($receita as $dataReceita) { ?>
                                                <tr>
                                                    <td style="padding-left: 50px">(+) <?php echo $dataReceita['nome'] ?></td>
                                                    <?php foreach ($valoresReceita as $dataValor) { ?>
                                                        <?php if ($dataValor['nome'] == $dataReceita['nome']) : ?>
                                                            <?php $totalReceita += $dataValor['total'] ?>
                                                            <td style="color: blue;">R$: <?php echo number_format($dataValor['total'], 2, ',', '.'); ?> </td>
                                                       
                                                        <?php endif; ?>

                                                    <?php } ?>
                                                    <td></td>
                                                </tr>
                                            <?php } ?>
                                            <tr style="background: lightgrey">
                                                <td><b>(=) TOTAL FATURAMENTO</b></td>
                                                <td>
                                                    <b>R$: <?php echo number_format($totalReceita, 2, ',', '.'); ?></b>
                                                </td>
                                                <td><b></b></td>
                                            </tr>
                                            <tr style="background: lightgrey">
                                                <td><b> DESPESAS</b></td>
                                                <td><b></b></td>
                                                <td><b></b></td>
                                            </tr>
                                            <?php $totalDespesa = 0; ?>
                                            <?php foreach ($contaDre as $dataContaDre) { ?>
                                                <tr>
                                                    <td style="padding-left: 50px">(-) <?php echo $dataContaDre['nome'] ?></td>
                                                    <?php foreach ($valoresDespesa as $dataDespesa) { ?>
                                                        <?php if ($dataDespesa['nome'] == $dataContaDre['nome']) : ?>
                                                            <?php $totalDespesa += $dataDespesa['total'] ?>
                                                            <td style="color: red;">R$: <?php echo number_format($dataDespesa['total'], 2, ',', '.'); ?> </td>
                                                       
                                                        <?php endif; ?>

                                                    <?php } ?>
                                                    <td></td>
                                                </tr>
                                            <?php } ?>
                                            <tr style="background: lightgrey">
                                                <td><b>(=) TOTAL DESPESAS</b></td>
                                                <td>
                                                    <b>R$: <?php echo number_format($totalDespesa, 2, ',', '.'); ?></b>
                                                </td>
                                                <td><b></b></td>
                                            </tr>
                                            <tr style="background: lightgrey">
                                                <td><b>(=) LUCRO LÍQUIDO</b></td>
                                                <td>
                                                    <b>R$: <?php echo number_format(($totalReceita - $totalDespesa), 2, ',', '.'); ?></b>
                                                </td>
                                                <td><b></b></td>
                                            </tr>
                                        </tbody>
                                    </table>
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