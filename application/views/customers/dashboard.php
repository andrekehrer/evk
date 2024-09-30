<?php include('header.php'); ?>
    <style>
      .mb-5 {margin-bottom: 0.5rem !important;}
      p {margin-bottom: 0rem !important}
    </style>
    <div class="container-scroller">
      <?php include('nav.php'); ?>
      <div class="container-fluid page-body-wrapper">
        <?php include('menu.php'); ?>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary2 text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <!-- <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i> -->
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <?php if(isset($proxima_viagem) && $proxima_viagem > 0){ ?>
                <?php if(count($proxima_viagem)>0){ ?>
                  <div class="col-md-4 stretch-card grid-margin" style="cursor:pointer" id="prox_v" data-id-v="<?=$proxima_viagem[0]->id?>">
                    <div class="card bg-gradient-danger card-img-holder text-white">
                      <div class="card-body">
                        <img src="<?=base_url(); ?>dash/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal">
                            Próxima viagem
                        </h4>
                        <p class="font-weight-normal mb-3"><?=date('d/m/Y', $proxima_viagem[0]->data);?></p>
                        <h2 class="mb-5"><i class="mdi mdi-airplane-takeoff mdi-24px float-right"></i> <?=$proxima_viagem[0]->origem?></h2>
                        <h4 class="card-text"><i class="mdi mdi-airplane-landing mdi-24px float-right"></i> <?=$proxima_viagem[0]->destino?></h4>
                      </div>
                    </div>
                  </div>
                <?php } ?>  
                
              <?php } ?>  
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="<?=base_url(); ?>dash/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">
                        Meu dados 
                    </h4>
                    <h2 class="mb-5">Alterar</h2>
                    <h6 class="card-text"><i class="mdi mdi-account-settings mdi-24px float-right"></i> meu cadastro</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin" id="add_" style="cursor:pointer">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="<?=base_url(); ?>dash/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Criar viagem 
                    </h4>
                    <h2 class="mb-5">Começar</h2>
                    <h6 class="card-text"><i class="mdi mdi-beach mdi-24px float-right"></i> Cadastre!</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php include('footer.php'); ?>
        </div>
      </div>
    </div>

    <script src="<?=base_url(); ?>dash/assets/vendors/js/vendor.bundle.base.js"></script>

    <script src="<?=base_url(); ?>dash/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="<?=base_url(); ?>dash/assets/js/jquery.cookie.js" type="text/javascript"></script>

    <script src="<?=base_url(); ?>dash/assets/js/off-canvas.js"></script>
    <script src="<?=base_url(); ?>dash/assets/js/hoverable-collapse.js"></script>
    <script src="<?=base_url(); ?>dash/assets/js/misc.js"></script>

    <script src="<?=base_url(); ?>dash/assets/js/dashboard.js"></script>
    <script src="<?=base_url(); ?>dash/assets/js/todolist.js"></script>
    <script>
      $("#add_").click(function(){
        window.location.href = "<?=base_url(); ?>customers/add_viagens";
      });
      $("#prox_v").click(function(){
        var id = $(this).data("id-v");
        window.location.href = "<?=base_url(); ?>customers/edit_viagem/"+id;
      });
    </script>              
  </body>
</html>