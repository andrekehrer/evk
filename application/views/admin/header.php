<!DOCTYPE html>
<html lang="en">
  <head>
    <style>
        .btn-gradient-primary {
            background: -webkit-gradient(linear, left top, right top, from(#4cc5c0), to(#2d2e47)) !important;
            background: linear-gradient(to right, #4cc5c0, #2d2e47) !important;
            border: 0;
            -webkit-transition: opacity 0.3s ease;
            transition: opacity 0.3s ease;
        }
        .bg-gradient-primary2 {
            background: -webkit-gradient(linear, left top, right top, from(#4cc5c0), to(#2d2e47)) !important;
            background: linear-gradient(to right, #4cc5c0, #2d2e47) !important;
        }
        .sidebar .nav .nav-item.active > .nav-link .menu-title {
            color: #2d2e47 !important;
        }
        .sidebar .nav .nav-item.active > .nav-link i {
            color: #2d2e47 !important;
        }
        .navbar .navbar-brand {width: 110px !important;}
        .sidebar {background: #3a3b53 !important;}
        .sidebar .nav .nav-item .nav-link{color: #ffffff !important;}
        .navbar .navbar-brand-wrapper{background: #4ac4bf !important;}
        .navbar{background: #4ac4bf !important;}
        .navbar .navbar-menu-wrapper .navbar-toggler{color: white !important}
        .navbar .navbar-menu-wrapper .navbar-nav .nav-item .nav-link{color: white !important}
        .navbar .navbar-brand-wrapper .navbar-brand {color: #ffffff !important;font-weight: 900 !important;}
        [data-tooltip]:hover::after {
            display: block;
            position: absolute;
            content: attr(data-tooltip);
            border: 1px solid black;
            background: #eee;
            padding: .25em;
            }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=$title?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?=base_url(); ?>dash/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?=base_url(); ?>dash/assets/vendors/css/vendor.bundle.base.css">

    <link rel="apple-touch-icon" sizes="180x180" href="/favicon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?=base_url(); ?>dash/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?=base_url(); ?>assets/img/favicon.png" />
    
  </head>
  <body>