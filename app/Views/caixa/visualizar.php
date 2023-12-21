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
                        <a class="btn btn-primary btn-group" style="margin-right: 15px;" href="/caixa"><i class="fas fa-share"></i></a>
                        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="/caixa">caixa</a></li>
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
                        <form action="<?php base_url() ?>/caixa/store" method="POST">
                            <div class="card-body">
                                <label>Nome</label>
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label for="">Nome do cartão</label>
                                            <input type="text" class="form-control" id="nome" name="nome" disabled value="<?php echo $caixa['nome'] ?>" required="">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group" id="saldo">
                                            <label for="">Saldo</label>
                                            <input type="text" class="form-control" name="saldo" value="<?php echo $caixa['saldo'] ?>" onkeypress="return allowOnlyNumbers(event)">
                                        </div>
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

<script>
    function allowOnlyNumbers(event) {
        // Obtem o código da tecla pressionada
        var keyCode = event.which || event.keyCode;

        // Permite apenas números (0-9) e algumas teclas especiais
        if ((keyCode >= 48 && keyCode <= 57) || // Números
            (keyCode >= 96 && keyCode <= 105) || // Números no teclado numérico
            keyCode == 8 || // Backspace
            keyCode == 9 || // Tab
            keyCode == 37 || // Seta para a esquerda
            keyCode == 39 || // Seta para a direita
            keyCode == 46) { // Delete
            return true;
        } else {
            // Impede a entrada de outras teclas
            event.preventDefault();
            return false;
        }
    }
</script>