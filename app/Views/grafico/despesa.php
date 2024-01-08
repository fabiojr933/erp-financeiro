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
                    <h1 class="m-0">Graficos</h1>
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
            <div class="card no-print">
                <div class="card-body">
                    <form action="/grafico/despesa" method="get">
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
                    <div class="card">

                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <div class="card card-primary card-tabs">
                                    <div class="card-header p-0 pt-1">
                                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Relatorios de despesas</a>
                                            </li>                                           
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-two-tabContent">
                                            <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                                <div class="card-body table-responsive p-0">

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div>
                                                                <div id="DespesaPieChart" style="width: 800px; height: 400px"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div>
                                                            <div id="DespesaPieChart2" style="width: 600px; height: 350px"></div>
                                                            </div>
                                                        </div>
                                                    </div>
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
</div>

<?php

$dataDespesa = [['Nome', 'Total']];
foreach ($valoresDespesa as $value) {
    $dataDespesa[] = [$value['nome'], floatval(number_format($value['total'], 2, ',', '.'))];
}
$dados_json = json_encode($dataDespesa);
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
        var chart = new google.visualization.PieChart(document.getElementById('DespesaPieChart'));
        chart.draw(data, options);
    }
</script>


<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {

        var dados_do_backend = <?php echo $dados_json; ?>;

        var data = new google.visualization.arrayToDataTable(dados_do_backend);

       

        var options = {
          width: 800,
          legend: { position: '' },
          chart: {
            title: '',
            subtitle: '' },
          axes: {
            x: {
              0: { side: 'top', label: ''} // Top x-axis.
            }
          },
          bar: { groupWidth: "80%" }
        };

        var chart = new google.charts.Bar(document.getElementById('DespesaPieChart2'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
    </script>


