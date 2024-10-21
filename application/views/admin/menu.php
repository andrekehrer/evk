<style>
    .sidebar .nav .nav-item .nav-link {padding: 0.5rem 0 0.5rem 0 !important;}
    .sidebar .nav .nav-item.nav-profile .nav-link .nav-profile-text {margin-left: 0.3rem !important;margin-top: 10px;}
</style>
<?php 
  if($_SESSION['backend']['foto']  == ''){
    $foto = "https://cdn-icons-png.flaticon.com/512/149/149071.png";
  }else{
    $foto = base_url().'assets/funcionarios/'.$_SESSION['backend']['foto'];
  }
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="<?=$foto?>" alt="profile">
          <span class="login-status online"></span>
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2"><?=($_SESSION['backend']['nome']);  ?></span>
        </div>
      </a>
    </li>
    <br>
    <li class="nav-item">
      <a class="nav-link" href="<?=base_url(); ?>admin/dashboard">
        <span class="menu-title">Início</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?=base_url(); ?>admin/login/alt_senha">
        <span class="menu-title">Alterar Senha</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>
    <hr>
    <?php if($_SESSION['backend']['permissao']==1 || $_SESSION['backend']['permissao']==99){ ?>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url(); ?>admin/funcionarios/funcionarios_ativo">
          <span class="menu-title">Funcionarios</span>
          <i class="mdi mdi-human menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url(); ?>admin/clientes">
          <span class="menu-title">Clientes</span>
          <i class="mdi mdi-format-list-bulleted-type menu-icon"></i>
        </a>
      </li>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?=base_url(); ?>admin/frotas">
          <span class="menu-title">Frotas</span>
          <i class="mdi mdi-car menu-icon"></i>
        </a>
      </li>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?=base_url(); ?>admin/equipamentos">
          <span class="menu-title">Equipamentos</span>
          <i class="mdi mdi-book-open menu-icon"></i>
        </a>
      </li>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?=base_url(); ?>admin/produtos">
          <span class="menu-title">Produtos</span>
          <i class="mdi mdi-cart menu-icon"></i>
        </a>
      </li>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?=base_url(); ?>admin/obras">
          <span class="menu-title">Obras</span>
          <i class="mdi mdi-home-map-marker menu-icon"></i>
        </a>
      </li>
    </li>
    
    <?php } ?>  
    <hr>
    <?php if($_SESSION['backend']['permissao']==99){ ?>

      <p style="color:white;margin: 0 auto;">Lista de todos Relatórios</p>
    <?php } ?>  
      <!-- <p style="color:white;margin: 0 auto;">Lista de todos Relatórios</p> -->
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url(); ?>admin/rdo">
          <span class="menu-title">RDO</span>
          <i class="mdi mdi-format-list-bulleted-type menu-icon"></i>
        </a>
      </li>

      <?php if($_SESSION['backend']['permissao'] != 3){ ?>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url(); ?>admin/rdf">
          <span class="menu-title">RDF</span>
          <i class="mdi mdi-format-list-bulleted-type menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url(); ?>admin/rds">
          <span class="menu-title">RDS</span>
          <i class="mdi mdi-format-list-bulleted-type menu-icon"></i>
        </a>
      </li>
      <?php } ?>
    <?php if($_SESSION['backend']['permissao']==99){ ?>
      
      <hr>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url(); ?>admin/config">
          <span class="menu-title">Configurações</span>
          <i class="mdi mdi-bullseye menu-icon"></i>
        </a>
      </li>
    <?php } ?>
    <!--
    <li class="nav-item">
      <a class="nav-link" href="<?=base_url(); ?>/admin/viagens">
        <span class="menu-title">Viagens</span>
        <i class="mdi mdi-format-list-bulleted-type menu-icon"></i>
      </a>
    </li> -->
    <!-- <li class="nav-item">
      <a class="nav-link" href="<?=base_url(); ?>/admin/compras">
        <span class="menu-title">Minhas compras</span>
        <i class="mdi mdi-format-list-bulleted-type menu-icon"></i>
      </a>
    </li> -->
    <!-- <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-title">Criar Viagem</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-crosshairs-gps menu-icon"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
        </ul>
      </div>
    </li> -->
    <!-- <li class="nav-item">
      <a class="nav-link" href="pages/icons/mdi.html">
        <span class="menu-title">Icons</span>
        <i class="mdi mdi-contacts menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pages/forms/basic_elements.html">
        <span class="menu-title">Forms</span>
        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pages/charts/chartjs.html">
        <span class="menu-title">Charts</span>
        <i class="mdi mdi-chart-bar menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pages/tables/basic-table.html">
        <span class="menu-title">Tables</span>
        <i class="mdi mdi-table-large menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
        <span class="menu-title">Sample Pages</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-medical-bag menu-icon"></i>
      </a>
      <div class="collapse" id="general-pages">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
        </ul>
      </div>
    </li>-->
    <br><br>
    <!-- <li class="nav-item">
        <a class="nav-link" href="<?=base_url(); ?>admin/funcionarios/resetar_senha">
          <span class="menu-title">Alterar senha</span>
          <i class="mdi mdi-format-list-bulleted-type menu-icon"></i>
        </a>
      </li> -->
    <li class="nav-item sidebar-actions">
      <span class="nav-link">
        <div class="border-bottom"></div>
        <a class="nav-link" href="<?=base_url().'admin/logout'?>">
        <i class="mdi mdi-power"></i> SAIR
        </a>
      </span>
    </li>
  </ul>
</nav>