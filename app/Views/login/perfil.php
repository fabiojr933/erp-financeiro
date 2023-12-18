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
                    <h1 class="m-0">Atualização dados</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a class="btn btn-primary btn-group" style="margin-right: 15px;" href="/"><i class="fas fa-share"></i></a>
                        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="/usuario/perfil">Usuario</a></li>
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
                        <form action="<?php base_url() ?>/usuario/atualizar_perfil" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" class="form-control" name="id_usuario" value="<?php echo $usuario['id_usuario'] ?>">
                                    <div class="col-lg-4">
                                        <label>Nome</label>
                                        <input type="text" class="form-control" name="nome" value="<?php echo $usuario['nome'] ?>" placeholder="Digite o seu nome" required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" value="<?php echo $usuario['email'] ?>" disabled>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Data nascimento</label>
                                        <input type="date" class="form-control" name="data_nascimento" value="<?php echo $usuario['data_nascimento'] ?>" placeholder="Digite a data">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Endereço</label>
                                        <input type="text" class="form-control" value="<?php echo $usuario['endereco'] ?>" name="endereço" placeholder="Digite o seu endereço">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Cep</label>
                                        <input type="text" class="form-control" value="<?php echo $usuario['cep'] ?>" name="cep" placeholder="Digite o cep">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Bairro</label>
                                        <input type="text" class="form-control" value="<?php echo $usuario['bairro'] ?>" name="bairro" placeholder="Digite o bairro">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-4">
                                        <label>Telefone</label>
                                        <input type="text" class="form-control" value="<?php echo $usuario['fone'] ?>" name="fone" placeholder="Digite o seu telefone">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Numero</label>
                                        <input type="text" class="form-control" value="<?php echo $usuario['numero'] ?>" name="numero" placeholder="Digite o numero">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Dia do pagamento</label>
                                        <input type="text" class="form-control" value="<?php echo $usuario['dia_pagamento'] ?>" name="dia_pagamento" placeholder="Digite o dia pagamento">
                                    </div>
                                </div><br>

                                <div class="col-lg-12">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" id="foto" name="foto">
                                    <label class="custom-file-label" for="exampleInputFile">Foto do perfil</label>
                                </div><br>

                                <div class="col-lg-12">                                   
                                    <input type="file" class="custom-file-input" id="exampleInputFile" id="logo" name="logo">
                                    <label class="custom-file-label" for="exampleInputFile">Logo da empresa</label>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bullhorn"></i>
                    Atenção
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="callout callout-danger">
                    <h5>Importante!</h5>

                    <p>FOX SISTEMAS é uma ferramenta de controle financeiro com diversas funcionalidades focadas na necessidade do empreendedor nacional e pessoal.
                        Com ele você poderá gerir diversas áreas de sua empresa, realizar o controle de contas e, até mesmo, emitir boletos(futuramente)
                        para seus clientes pelo próprio sistema de gestão financeiro. Teste gratuitamente e sem compromisso agora mesmo!</p>
                </div>
                <div class="callout callout-success">
                    <h5>Importante!</h5>

                    <p>Após a completa funcionalidade do sistema atingir 100%, será aplicada uma taxa simbólica para o seu uso, destinada a cobrir as despesas associadas ao sistema.
                        Essa prática viabiliza a implementação de novas funcionalidades em nosso sistema.</p>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>


</div>
<!-- /.content-wrapper -->