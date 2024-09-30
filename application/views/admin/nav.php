
    <style>
        .navbar .navbar-brand-wrapper .navbar-brand img {/* width: calc(260px - 120px); */height: 100%; vertical-align: middle;}
        .navbar .navbar-brand-wrapper .navbar-brand.brand-logo-mini img {width: 100% !important;height: 100% !important;}
        .dataTables_wrapper {font-size: 12px;}
        .card .card-body {padding: 0.5rem 0.5rem !important;}
        .dataTables_info{margin-top: 30px;}
        @media (max-width: 991px){
            .navbar .navbar-menu-wrapper {height: 50px !important;}
            .navbar .navbar-brand-wrapper {height: 50px !important;}
            .navbar.fixed-top + .page-body-wrapper {padding-top: 50px !important;}
            .menu-65-ak{width: 65px !important;}
            .content-wrapper {padding: 0.75rem 1.25rem !important;}
            .dataTables_wrapper {font-size: 10px !important;}
            .dataTables_wrapper .dataTables_length{float:left !important;}
            .dataTables_wrapper .dataTables_filter {float:asd !important;}
            .sidebar-offcanvas {top: 50px !important;}
        }
        
    </style>

    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center menu-65-ak justify-content-center">
            <a class="navbar-brand brand-logo" href=""><img src="<?=base_url(); ?>assets/img/logo-white-evk.png" alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href=""><img src="<?=base_url(); ?>assets/img/logo-white-evk.png" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>
             <li class="nav-item nav-logout d-none d-lg-block">
                <a class="nav-link" href="<?=base_url().'admin/logout'?>">
                <i class="mdi mdi-power"></i>
                </a>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>