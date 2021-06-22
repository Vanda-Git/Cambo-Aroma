<?php
include '../config/database.php';
include "../config/Auth.php";
$new_order_message = count_new_order($conn);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../Asset/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../Asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../Asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../Asset/plugins/jqvmap/jqvmap.min.css">
  <!-- DataTables -->
  <!-- <link rel="stylesheet" href="../Asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"> -->
  <!-- <link rel="stylesheet" href="../Asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"> -->
  <link rel="stylesheet" type="text/css" href="../Asset/plugins/datatables/jquery.dataTables.min.css" />
  <link rel="stylesheet" type="text/css" href="../Asset/plugins/datatables/buttons.dataTables.min.css" />
  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.css"/> -->

  <!-- Theme style -->
  <link rel="stylesheet" href="../Asset/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../Asset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../Asset/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../Asset/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- select2 -->
  <link rel="stylesheet" href="../Asset/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../Asset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="../dashboard" class="nav-link">Home</a>
          
        </li>
      </ul>
      <a href="../order/" class="btn text-bold"><?=@$new_order_message?></a>

      <!-- Right navbar links -->
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../Asset/images/user/<?= @$_SESSION["User"]["us_image"] ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= @$_SESSION["User"]["us_fullname"] ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="../dashboard/" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Home
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  User managerment
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../position" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Position</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../user" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>User</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Product managerment 
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../unit" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Unit</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../category" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Category</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../brand" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Brand</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../product" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../discount" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product Discount</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../order" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product Order </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Stock managerment
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../stockBalance" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stock Balance</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../stockIn" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stock In</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../stockOut" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stock Out</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../stockOutToMember" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Stock Out to Member</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  System Paramater
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../Slide_show" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Slide Show</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../Colors" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Colors</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="../Logout.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Logout
                </p>
              </a>
            </li>
            <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-sticky-note"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">1</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sell Report</p>
                </a>
              </li>
          </li> -->


          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>