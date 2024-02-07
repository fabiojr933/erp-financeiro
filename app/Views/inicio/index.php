<?php
$session = session();
$email = $session->get('usuario');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h5 class="mb-2">Bem vindo <?php echo $email ?></h5>
      <div class="container-fluid">
      <div class="card no-print">
                <div class="card-body">
                    <form action="/" method="get">
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
                            </div>
                        </div>
                    </form>
                </div>
        <h5 style="text-align: center;" class="mb-2">Dados baseado no mês atual</h5>
        
        <div class="row">

          <div class="col-lg-2 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3 style="font-size: 30px;">R$: <?php echo number_format($contasReceber, 2, ',', '.') ?></h3>
                <p>Contas a receber</p>
              </div>
              <div class="icon">
                <i class="fas fa-hand-holding-usd"></i>
              </div>
              <a href="/lancamentos" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 style="font-size: 30px;">R$: <?php echo number_format($contasPagar, 2, ',', '.') ?></h3>
                <p>Contas a pagar</p>
              </div>
              <div class="icon">
                <i class="fas fa-hand-holding-usd"></i>
              </div>
              <a href="/lancamentos" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3 style="font-size: 30px;">R$: <?php echo number_format($totalReceita, 2, ',', '.') ?></h3>
                <p>Receita</p>
              </div>
              <div class="icon">
                <i class="fas fa-hand-holding-usd"></i>
              </div>
              <a href="/produtos" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6">
            <div class="small-box bg-olive">
              <div class="inner">
                <h3 style="font-size: 30px;">R$: <?php echo number_format($totalDespesa, 2, ',', '.') ?></h3>
                <p>Despesas</p>
              </div>
              <div class="icon">
                <i class="fas fa-hand-holding-usd"></i>
              </div>
              <a href="/vendas" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3 style="font-size: 30px;">R$: <?php echo number_format($contasRecebido, 2, ',', '.') ?></h3>
                <p>Total Recebido</p>
              </div>
              <div class="icon">
                <i class="fas fa-hand-holding-usd"></i>
              </div>
              <a href="/clientes" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6">
            <div class="small-box bg-purple">
              <div class="inner">
                <h3 style="font-size: 30px;">R$: <?php echo number_format($contasPagas, 2, ',', '.') ?></h3>
                <p>Contas Paga</p>
              </div>
              <div class="icon">
                <i class="fas fa-hand-holding-usd"></i>
              </div>
              <a href="#" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>










          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Contas a receber</h3>
                  <a href="javascript:void(0);">Graficos</a>
                </div>
              </div>
              <div class="card-body">
               
                <div class="position-relative mb-4">
                <div id="graficoReceberDespesaPieChart" style="width: 100%; height: 270px"></div>
                </div>               
              </div>
            </div>

            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Ultimos lançamentos</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                    <tr>
                      <th>Fluxo financeiro</th>
                      <th>Valor</th>
                      <th>Tipo</th>
                      <th>Data</th>
                    </tr>
                  </thead>
                  <tbody>        

                    <?php foreach ($valoresReceita as $data) { ?>
                      <tr>
                        <td>
                          <?php echo $data['nome'] ?>
                        </td>
                        <td> R$: <?php echo $data['valor'] ?></td>
                        <td>
                          <small class="text-primary mr-1">
                            <i class="fas fa-arrow-up"></i>
                            Receita
                          </small>                         
                        </td>
                        <td>
                          <a href="#" class="text-muted">
                          <?php echo date('d/m/Y', strtotime($data['data_pagamento'])); ?>
                          </a>
                        </td>
                      </tr>
                    <?php } ?>

                    <?php foreach ($valoresDespesas as $data) { ?>
                      <tr>
                        <td>
                          <?php echo $data['nome'] ?>
                        </td>
                        <td> R$: <?php echo $data['valor'] ?></td>              
                        <td>
                          <small class="text-danger mr-1">
                          <i class="fas fa-arrow-down"></i>
                            Receita
                          </small>                        
                        </td>
                        <td>
                          <a href="#" class="text-muted">
                          <?php echo date('d/m/Y', strtotime($data['data_pagamento'])); ?>
                          </a>
                        </td>
                      </tr>
                    <?php } ?>

                  </tbody>
                </table>
              </div>
            </div>

          </div>




          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Contas a pagar</h3>
                  <a href="javascript:void(0);">Grafico</a>
                </div>
              </div>
              <div class="card-body">               

                <div class="position-relative mb-4">
                <div id="graficoPagarDespesaPieChart" style="width: 100%; height: 270px"></div>
                </div>               
              </div>
            </div>


            

            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Contas a receber e pagar mais proximos</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                    <tr>
                      <th>Cliente</th>
                      <th>Valor</th>
                      <th>Tipo</th>
                      <th>Vencimento</th>
                    </tr>
                  </thead>
                  <tbody>        

                    <?php foreach ($ContasPendenteCliente as $data) { ?>
                      <tr>
                        <td>
                          <?php echo $data['nome'] ?>
                        </td>
                        <td> R$: <?php echo $data['valor_pendente'] ?></td>
                        <td>
                          <small class="text-primary mr-1">
                            <i class="fas fa-arrow-up"></i>
                            Contas a receber
                          </small>                         
                        </td>
                        <td>
                          <a href="#" class="text-muted">
                          <?php echo date('d/m/Y', strtotime($data['vencimento'])); ?>
                          </a>
                        </td>
                      </tr>
                    <?php } ?>

                    <?php foreach ($ContasPendenteFornecedor as $data) { ?>
                      <tr>
                        <td>
                          <?php echo $data['nome'] ?>
                        </td>
                        <td> R$: <?php echo $data['valor_pendente'] ?></td>              
                        <td>
                          <small class="text-danger mr-1">
                          <i class="fas fa-arrow-down"></i>
                            Contas a pagar
                          </small>                        
                        </td>
                        <td>
                          <a href="#" class="text-muted">
                          <?php echo date('d/m/Y', strtotime($data['vencimento'])); ?>
                          </a>
                        </td>
                      </tr>
                    <?php } ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php

$graficoPagarDespesa = [['Tipo', 'Valor']];
foreach ($graficoPagar as $value) {
    $graficoPagarDespesa[] = [$value['tipo'], floatval($value['valor'])];
}
$dados_json = json_encode($graficoPagarDespesa);
?>

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var dados_do_backend = <?php echo $dados_json; ?>;
        var data = google.visualization.arrayToDataTable(dados_do_backend);
        var options = {
            title: ''
        };
        var chart = new google.visualization.PieChart(document.getElementById('graficoPagarDespesaPieChart'));
        chart.draw(data, options);
    }
</script>






<?php

$graficoReceberDespesa = [['Tipo', 'Valor']];
foreach ($graficoReceber as $value) {
    $graficoReceberDespesa[] = [$value['tipo'], floatval($value['valor'])];
}
$dados_json = json_encode($graficoReceberDespesa);
?>

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var dados_do_backend = <?php echo $dados_json; ?>;
        var data = google.visualization.arrayToDataTable(dados_do_backend);   
        var options = {
            title: ''
        };
        var chart = new google.visualization.PieChart(document.getElementById('graficoReceberDespesaPieChart'));
        chart.draw(data, options);
    }
</script>
