<?php include('header.php'); ?>

    <div class="container-scroller">
      <?php include('nav.php'); ?>
      <div class="container-fluid page-body-wrapper">
        <?php include('menu.php'); ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary2 text-white me-2">
                        <i class="mdi mdi-airplane-takeoff"></i>
                        </span> Adicionar viagem
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
                    <div class="col-lg-12 stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Adicione sua próxima viagem!</h4>
                                <form class="forms-sample" action="<?=base_url()?>customers/add_viagem_gravar" method="POST">
                                    <div class="form-group">
                                        <label for="origem">Origem</label>
                                        <input type="text" class="form-control" id="origem" name="origem" placeholder="Origem">
                                    </div>
                                    <div class="form-group">
                                        <label for="destino">Destino</label>
                                        <input type="text" class="form-control" id="destino" name="destino" placeholder="Destino">
                                    </div>
                                    <div class="form-group">
                                        <label for="data">Data</label>
                                        <input type="date" class="form-control" id="data" name="data">
                                    </div>
                                    <button type="submit" class="btn btn-gradient-primary me-2">Salvar</button>
                                </form>
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
  </body>
</html>