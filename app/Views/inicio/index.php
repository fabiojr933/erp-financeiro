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
            <div class="small-box bg-info">
              <div class="inner">
                <h3 style="font-size: 30px;">R$: <?php echo number_format($contasCredito, 2, ',', '.') ?></h3>
                <p>Cartão de creditos a pagar</p>
              </div>
              <div class="icon">
                <i class="fas fa-hand-holding-usd"></i>
              </div>
              <a href="/clientes" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a>
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
            <div class="small-box bg-purple">
              <div class="inner">
                <h3 style="font-size: 30px;">R$: <?php echo number_format($contasPagas, 2, ',', '.') ?></h3>
                <p>Contas Pagas</p>
              </div>
              <div class="icon">
                <i class="fas fa-hand-holding-usd"></i>
              </div>
              <a href="#" class="small-box-footer">Acessar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.content-wrapper -->