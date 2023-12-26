<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <a href="/inicio" class="brand-link">
    <img src=<?php echo isset($perfil['foto']) ? base_url('/uploads/') . $perfil['logo'] :  base_url('theme/dist/img/AdminLTELogo.png') ?> alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Fox Sistemas</span>
  </a>

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src=<?php echo isset($perfil['foto']) ? base_url('/uploads/') . $perfil['foto'] :  base_url('theme/dist/img/user2-160x160.jpg') ?> class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $perfil['nome'] ?></a>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">

        <li class="nav-item menu-open">
          <a href="/inicio" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="nav-icon fas fa-home"></i>
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <p>
              Cadastros
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
              <a href="/caixa" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>Caixa</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/cartao" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>Cartão</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/receita" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>Receita</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/contaDre" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>Conta do Dre</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/contaFluxo" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>Conta do Fluxo</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/cliente" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>Cliente</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/fornecedor" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>Fornecedor</p>
              </a>
            </li>
          </ul>
        </li>



        <li class="nav-item">
          <a href="#" class="nav-link">
            <p>
              financeiro
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/lancamento" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>Lançamento manual</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>Lançamento por OFX</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/contasReceber" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>Contas a receber</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/contasPagar" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>Contas a pagar</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/contasReceber/recebimento" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>Baixa contas a receber</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/contasPagar/recebimento" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>Baixa contas pagar</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>Extrato bancario</p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-item">
          <a href="#" class="nav-link">
            <p>
              Dre
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>DRE analitico</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>DRE sintetico</p>
              </a>
            </li>
          </ul>
        </li>




        <li class="nav-item">
          <a href="#" class="nav-link">
            <p>
              Relatorios
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>+</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>+</p>
              </a>
            </li>
          </ul>
        </li>



        <li class="nav-item">
          <a href="#" class="nav-link">
            <p>
              Graficos
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>+</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>+</p>
              </a>
            </li>
          </ul>
        </li>



        <li class="nav-item">
          <a href="#" class="nav-link">
            <p>
              Usuario
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/usuario/perfil" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>Perfil</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/usuario/trocar_senha" class="nav-link">
                <i class="nav-icon fas fa-key"></i>
                <p>Trocar senha</p>
              </a>
            </li>
          </ul>
        </li>


      </ul>
    </nav>
  </div>
</aside>