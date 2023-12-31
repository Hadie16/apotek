<?php

if($_SESSION['level'] != ''){
  include('../logincheck.php');

}
// include('../logincheck.php');
session_start();
include '../template/header.php';
?>

<body id="page-top">
<!-- <div id="loader" class="loader"></div> -->
<div class="overlay" id="overlay"></div>
<div class="loading-container" id="loadingContainer">
        <div class="loading-spinner"></div>
        <p>Loading...</p>
    </div>
    <!-- <button id="showSpinner">Show Spinner</button>
    <button id="hideSpinner">Hide Spinner</button> -->
 
  <div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>

            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <strong>Halo, </strong> <?php echo $_SESSION['username']; ?>
                </span>
               
                <!-- <img class="img-profile rounded-circle" src="../img/undraw_profile.svg" alt="profile"/> -->
                <i style="color:gold" class="fas fa-fw fa-crown"></i>

              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
 
     
        <div class="container-fluid">
          <?php
          include '../connection.php';
          error_reporting(0);
          switch ($_GET['page']) {
            case 'dashboard':
              $title = 'Dashboard';
              include 'dashboard.php';
              break;

//supplier
              case 'supplier-show':
                $title = 'Data supplier';
                include '../supplier/show.php';
                break;
              case 'supplier-add':
                $title = 'Input Data supplier';
                include '../supplier/add.php';
                break;
              case 'supplier-delete':
                include '../supplier/delete.php';
                break;
              case 'supplier-edit':
                $title = 'Edit Data supplier';
                include '../supplier/edit.php';
                break;
              case 'supplier-print':
                include '../supplier/print.php';
                break;
              case 'supplier-print2':
                include '../supplier/print2.php';
                break;
              case 'supplier-print2':
                include '../supplier/print3.php';
                break;

//history
case 'history-show':
  $title = 'Data History Pasien';
  include '../history/show.php';
  break;
case 'history-add':
  $title = 'Input Data history';
  include '../history/add.php';
  break;
case 'history-delete':
  include '../history/delete.php';
  break;
case 'history-edit':
  $title = 'Edit Data history';
  include '../history/edit.php';
  break;
case 'history-print':
  include '../history/print.php';
  break;
case 'history-print2':
  include '../history/print2.php';
  break;
case 'history-detail':
  include '../history/detail.php';
  break;

//laporan_penjualan
case 'laporan_penjualan-showGrafik':
  $title = 'Data Laporan Penjualan';
  include '../laporan_penjualan/showGrafik.php';
  break;
  case 'laporan_penjualan-showTabel':
    $title = 'Data Laporan Penjualan';
    include '../laporan_penjualan/showTabel.php';
    break;
case 'laporan_penjualan-add':
  $title = 'Input Data Laporan Penjualan';
  include '../laporan_penjualan/add.php';
  break;
case 'laporan_penjualan-delete':
  include '../laporan_penjualan/delete.php';
  break;
case 'laporan_penjualan-edit':
  $title = 'Edit Data laporan_penjualan';
  include '../laporan_penjualan/edit.php';
  break;
case 'laporan_penjualan-print':
  include '../laporan_penjualan/print.php';
  break;
case 'laporan_penjualan-print2':
  include '../laporan_penjualan/print2.php';
  break;
case 'laporan_penjualan-print2':
  include '../laporan_penjualan/print3.php';
  break;
  case 'laporan_penjualan-laba':
    include '../laporan_penjualan/laba.php';
    break;

  //ttk
case 'ttk-show':
  $title = 'Data TTK';
  include '../ttk/show.php';
  break;
case 'ttk-add':
  $title = 'Input Data TTK';
  include '../ttk/add.php';
  break;
case 'ttk-delete':
  include '../ttk/delete.php';
  break;
case 'ttk-edit':
  $title = 'Edit Data TTK';
  include '../ttk/edit.php';
  break;
case 'ttk-print':
  include '../ttk/print.php';
  break;
case 'ttk-print2':
  include '../ttk/print2.php';
  break;
case 'ttk-print2':
  include '../ttk/print3.php';
  break;

//===========cek kesehatan====================

     //cek_kesehatan
  case 'cek_kesehatan-show':
    $title = 'Data Cek Kesehatan';
    include '../cek_kesehatan/show.php';
    break;
  case 'cek_kesehatan-add':
    $title = 'Input Data Cek Kesehatan';
    include '../cek_kesehatan/add.php';
    break;
  case 'cek_kesehatan-delete':
    include '../cek_kesehatan/delete.php';
    break;
  case 'cek_kesehatan-edit':
    $title = 'Edit Data Cek Kesehatan';
    include '../cek_kesehatan/edit.php';
    break;
  case 'cek_kesehatan-print':
    include '../cek_kesehatan/print.php';
    break;
  case 'cek_kesehatan-hasil_cek':
    include '../cek_kesehatan/hasil_cek.php';
    break;
  case 'cek_kesehatan-detail':
    include '../cek_kesehatan/detail.php';
    break;
    case 'cek_kesehatan-detail_delete':
      include '../cek_kesehatan/detail_delete.php';
      break;


     //detail_cek_kesehatan
  case 'detail_cek_kesehatan-show':
    $title = 'Data Cek Kesehatan';
    include '../detail_cek_kesehatan/show.php';
    break;
  case 'detail_cek_kesehatan-add':
    $title = 'Input Data Cek Kesehatan';
    include '../detail_cek_kesehatan/add.php';
    break;
  case 'detail_cek_kesehatan-delete':
    include '../detail_cek_kesehatan/delete.php';
    break;
  case 'detail_cek_kesehatan-edit':
    $title = 'Edit Data Cek Kesehatan';
    include '../detail_cek_kesehatan/edit.php';
    break;
  case 'detail_cek_kesehatan-print':
    include '../detail_cek_kesehatan/print.php';
    break;
  case 'detail_cek_kesehatan-print2':
    include '../detail_cek_kesehatan/print2.php';
    break;
  case 'detail_cek_kesehatan-print2':
    include '../detail_cek_kesehatan/print3.php';
    break;



  // =====================================obat=================================

//retur_obat
case 'retur_obat-show':
  $title = 'Data Retur Obat';
  include '../retur_obat/show.php';
  break;
case 'retur_obat-add':
  $title = 'Input Data Retur Obat';
  include '../retur_obat/add.php';
  break;
case 'retur_obat-delete':
  include '../retur_obat/delete.php';
  break;
case 'retur_obat-edit':
  $title = 'Edit Data Retur Obat';
  include '../retur_obat/edit.php';
  break;
case 'retur_obat-print':
  include '../retur_obat/print.php';
  break;
case 'retur_obat-print2':
  include '../retur_obat/print2.php';
  break;
case 'retur_obat-print2':
  include '../retur_obat/print3.php';
  break;

  case 'retur_obat-detail':
  include '../retur_obat/detail_show.php';
  break;


//obat
case 'obat-show':
  $title = 'Data obat';
  include '../obat/show.php';
  break;
case 'obat-add':
  $title = 'Input Data obat';
  include '../obat/add.php';
  break;
case 'obat-delete':
  include '../obat/delete.php';
  break;
case 'obat-edit':
  $title = 'Edit Data obat';
  include '../obat/edit.php';
  break;
case 'obat-print':
  include '../obat/print.php';
  break;
case 'obat-print2':
  include '../obat/print2.php';
  break;
case 'obat-print2':
  include '../obat/print3.php';
  break;

    //stok_obat
case 'stok_obat-show':
  $title = 'Data Stok obat';
  include '../stok_obat/show.php';
  break;
case 'stok_obat-add':
  $title = 'Input Data Stok obat';
  include '../stok_obat/add.php';
  break;
case 'stok_obat-delete':
  include '../stok_obat/delete.php';
  break;
case 'stok_obat-edit':
  $title = 'Edit Data Stok obat';
  include '../stok_obat/edit.php';
  break;
case 'stok_obat-print':
  include '../stok_obat/print.php';
  break;
case 'stok_obat-print2':
  include '../stok_obat/print2.php';
  break;
case 'stok_obat-print2':
  include '../stok_obat/print3.php';
  break;
  case 'stok_obat-detail':
    include '../stok_obat/detail_show.php';
    break;
    case 'stok_obat-detail_delete':
      include '../stok_obat/detail_delete.php';
      break;

    case 'stok_obat-expired':
      include '../stok_obat/expired.php';
      break;

       //penjualan_obat
case 'penjualan_obat-show':
  $title = 'Data Penjualan obat';
  include '../penjualan_obat/show.php';
  break;
case 'penjualan_obat-add':
  $title = 'Input Data Penjualan obat';
  include '../penjualan_obat/add.php';
  break;
case 'penjualan_obat-delete':
  include '../penjualan_obat/delete.php';
  break;
case 'penjualan_obat-edit':
  $title = 'Edit Data Penjualan obat ';
  include '../penjualan_obat/edit.php';
  break;
case 'penjualan_obat-print':
  include '../penjualan_obat/print.php';
  break;
case 'penjualan_obat-print2':
  include '../penjualan_obat/print2.php';
  break;
case 'penjualan_obat-print2':
  include '../penjualan_obat/print3.php';
  break;
  case 'penjualan_obat-faktur':
    include '../penjualan_obat/faktur.php';
    break;
    case 'penjualan_obat-detail_show':
      include '../penjualan_obat/detail_show.php';
      break;

     //detail_penjualan_obat
 case 'detail_penjualan_obat-show':
  $title = 'Data Detail Penjualan obat';
  include '../detail_penjualan_obat/show.php';
  break;
case 'detail_penjualan_obat-add':
  $title = 'Input Data Detail Penjualan obat';
  include '../detail_penjualan_obat/add.php';
  break;
case 'detail_penjualan_obat-delete':
  include '../detail_penjualan_obat/delete.php';
  break;
case 'detail_penjualan_obat-edit':
  $title = 'Edit Data Detail Penjualan obat';
  include '../detail_penjualan_obat/edit.php';
  break;
case 'detail_penjualan_obat-print':
  include '../detail_penjualan_obat/print.php';
  break;
case 'detail_penjualan_obat-print2':
  include '../detail_penjualan_obat/print2.php';
  break;
case 'detail_penjualan_obat-print2':
  include '../detail_penjualan_obat/print3.php';
  break;

     //pengadaan_obat
 case 'pengadaan_obat-show':
  $title = 'Data Pengadaan obat';
  include '../pengadaan_obat/show.php';
  break;
case 'pengadaan_obat-add':
  $title = 'Input Data Pengadaan obat';
  include '../pengadaan_obat/add.php';
  break;
case 'pengadaan_obat-delete':
  include '../pengadaan_obat/delete.php';
  break;
case 'pengadaan_obat-edit':
  $title = 'Edit Data Pengadaan obat';
  include '../pengadaan_obat/edit.php';
  break;
case 'pengadaan_obat-print':
  include '../pengadaan_obat/print.php';
  break;
case 'pengadaan_obat-print2':
  include '../pengadaan_obat/print2.php';
  break;
case 'pengadaan_obat-print2':
  include '../pengadaan_obat/print3.php';
  break;


   //detail_pengadaan_obat
 case 'detail_pengadaan_obat-show':
  $title = 'Data Detail Pengadaan obat';
  include '../detail_pengadaan_obat/show.php';
  break;
case 'detail_pengadaan_obat-add':
  $title = 'Input Data Detail Pengadaan obat';
  include '../detail_pengadaan_obat/add.php';
  break;
case 'detail_pengadaan_obat-delete':
  include '../detail_pengadaan_obat/delete.php';
  break;
case 'detail_pengadaan_obat-edit':
  $title = 'Edit Data Detail Pengadaan obat';
  include '../detail_pengadaan_obat/edit.php';
  break;
case 'detail_pengadaan_obat-print':
  include '../detail_pengadaan_obat/print.php';
  break;
case 'detail_pengadaan_obat-print2':
  include '../detail_pengadaan_obat/print2.php';
  break;
case 'pengadaan_obat-detail':
  include '../detail_pengadaan_obat/show.php';
  break;

      //penerimaan_obat
 case 'penerimaan_obat-show':
  $title = 'Data Penerimaan Obat';
  include '../penerimaan_obat/show.php';
  break;
case 'penerimaan_obat-add':
  $title = 'Input Data Penerimaan Obat';
  include '../penerimaan_obat/add.php';
  break;
  case 'penerimaan_obat-add_retur':
    $title = 'Input Data Penerimaan Obat Retur';
    include '../penerimaan_obat/add_retur.php';
    break;
case 'penerimaan_obat-delete':
  include '../penerimaan_obat/delete.php';
  break;
case 'penerimaan_obat-edit':
  $title = 'Edit Data Penerimaan Obat';
  include '../penerimaan_obat/edit.php';
  break;
case 'penerimaan_obat-print':
  include '../penerimaan_obat/print.php';
  break;
case 'penerimaan_obat-print2':
  include '../penerimaan_obat/print2.php';
  break;
case 'penerimaan_obat-detail':
  include '../penerimaan_obat/detail.php';
  break;
  case 'penerimaan_obat-detail_edit':
    include '../penerimaan_obat/detail_edit.php';
    break;
    case 'penerimaan_obat-detail_delete':
      include '../penerimaan_obat/detail_delete.php';
      break;
      case 'penerimaan_obat-detail_print':
        include '../penerimaan_obat/detail_print.php';
        break;

     //ketersediaan_obat
   case 'ketersediaan_obat-show':
    $title = 'Data Ketersediaan obat';
    include '../ketersediaan_obat/show.php';
    break;
  case 'ketersediaan_obat-add':
    $title = 'Input Data Ketersediaan obat';
    include '../ketersediaan_obat/add.php';
    break;
  case 'ketersediaan_obat-delete':
    include '../ketersediaan_obat/delete.php';
    break;
  case 'ketersediaan_obat-edit':
    $title = 'Edit Data Ketersediaan obat';
    include '../ketersediaan_obat/edit.php';
    break;
  case 'ketersediaan_obat-print':
    include '../ketersediaan_obat/print.php';
    break;
  case 'ketersediaan_obat-print2':
    include '../ketersediaan_obat/print2.php';
    break;
  case 'ketersediaan_obat-print2':
    include '../ketersediaan_obat/print3.php';
    break;
    case 'ketersediaan_obat-detail':
      include '../ketersediaan_obat/detail_show.php';
      break;
      case 'ketersediaan_obat-detail_delete':
        include '../ketersediaan_obat/detail_delete.php';
        break;

            //detail_ketersediaan_obat
  case 'detail_ketersediaan_obat-show':
    $title = 'Data obat Masuk';
    include '../detail_ketersediaan_obat/show.php';
    break;
  case 'detail_ketersediaan_obat-add':
    $title = 'Input Data obat Masuk';
    include '../detail_ketersediaan_obat/add.php';
    break;
  case 'detail_ketersediaan_obat-delete':
    include '../detail_ketersediaan_obat/delete.php';
    break;
  case 'detail_ketersediaan_obat-edit':
    $title = 'Edit Data obat Masuk';
    include '../detail_ketersediaan_obat/edit.php';
    break;
  case 'detail_ketersediaan_obat-print':
    include '../detail_ketersediaan_obat/print.php';
    break;
  case 'detail_ketersediaan_obat-print2':
    include '../detail_ketersediaan_obat/print2.php';
    break;
  case 'detail_ketersediaan_obat-print2':
    include '../detail_ketersediaan_obat/print3.php';
    break;

         //masuk_etalase_obat
        case 'masuk_etalase_obat-show':
          $title = 'Data obat Masuk';
          include '../masuk_etalase_obat/show.php';
          break;
        case 'masuk_etalase_obat-add':
          $title = 'Input Data obat Masuk';
          include '../masuk_etalase_obat/add.php';
          break;
        case 'masuk_etalase_obat-delete':
          include '../masuk_etalase_obat/delete.php';
          break;
        case 'masuk_etalase_obat-edit':
          $title = 'Edit Data obat Masuk';
          include '../masuk_etalase_obat/edit.php';
          break;
        case 'masuk_etalase_obat-print':
          include '../masuk_etalase_obat/print.php';
          break;
        case 'masuk_etalase_obat-print2':
          include '../masuk_etalase_obat/print2.php';
          break;
        case 'masuk_etalase_obat-print2':
          include '../masuk_etalase_obat/print3.php';
          break;

              //masuk_gudang_obat
        case 'masuk_gudang_obat-show':
          $title = 'Data obat Masuk';
          include '../masuk_gudang_obat/show.php';
          break;
        case 'masuk_gudang_obat-add':
          $title = 'Input Data obat Masuk';
          include '../masuk_gudang_obat/add.php';
          break;
        case 'masuk_gudang_obat-delete':
          include '../masuk_gudang_obat/delete.php';
          break;
        case 'masuk_gudang_obat-edit':
          $title = 'Edit Data obat Masuk';
          include '../masuk_gudang_obat/edit.php';
          break;
        case 'masuk_gudang_obat-print':
          include '../masuk_gudang_obat/print.php';
          break;
        case 'masuk_gudang_obat-print2':
          include '../masuk_gudang_obat/print2.php';
          break;
        case 'masuk_gudang_obat-print2':
          include '../masuk_gudang_obat/print3.php';
          break;

               //keluar_etalase_obat
        case 'keluar_etalase_obat-show':
          $title = 'Data obat Keluar';
          include '../keluar_etalase_obat/show.php';
          break;
        case 'keluar_etalase_obat-add':
          $title = 'Input Data obat Keluar';
          include '../keluar_etalase_obat/add.php';
          break;
        case 'keluar_etalase_obat-delete':
          include '../keluar_etalase_obat/delete.php';
          break;
        case 'keluar_etalase_obat-edit':
          $title = 'Edit Data obat Keluar';
          include '../keluar_etalase_obat/edit.php';
          break;
        case 'keluar_etalase_obat-print':
          include '../keluar_etalase_obat/print.php';
          break;
        case 'keluar_etalase_obat-print2':
          include '../keluar_etalase_obat/print2.php';
          break;
        case 'keluar_etalase_obat-print2':
          include '../keluar_etalase_obat/print3.php';
          break;

                //keluar_gudang_obat
        case 'keluar_gudang_obat-show':
          $title = 'Data obat Keluar';
          include '../keluar_gudang_obat/show.php';
          break;
        case 'keluar_gudang_obat-add':
          $title = 'Input Data obat Keluar';
          include '../keluar_gudang_obat/add.php';
          break;
        case 'keluar_gudang_obat-delete':
          include '../keluar_gudang_obat/delete.php';
          break;
        case 'keluar_gudang_obat-edit':
          $title = 'Edit Data obat Keluar';
          include '../keluar_gudang_obat/edit.php';
          break;
        case 'keluar_gudang_obat-print':
          include '../keluar_gudang_obat/print.php';
          break;
        case 'keluar_gudang_obat-print2':
          include '../keluar_gudang_obat/print2.php';
          break;
        case 'keluar_gudang_obat-print2':
          include '../keluar_gudang_obat/print3.php';
          break;

          //==========================alkes=================

//retur_alkes
case 'retur_alkes-show':
  $title = 'Data Retur Alkes';
  include '../alkes/retur_alkes/show.php';
  break;
case 'retur_alkes-add':
  $title = 'Input Data Retur Alkes';
  include '../alkes/retur_alkes/add.php';
  break;
case 'retur_alkes-delete':
  include '../alkes/retur_alkes/delete.php';
  break;
case 'retur_alkes-edit':
  $title = 'Edit Data Retur Alkes';
  include '../alkes/retur_alkes/edit.php';
  break;
case 'retur_alkes-print':
  include '../alkes/retur_alkes/print.php';
  break;
case 'retur_alkes-print2':
  include '../alkes/retur_alkes/print2.php';
  break;
case 'retur_alkes-print2':
  include '../alkes/retur_alkes/print3.php';
  break;


//alkes
case 'alkes-show':
  $title = 'Data alkes';
  include '../alkes/alkes/show.php';
  break;
case 'alkes-add':
  $title = 'Input Data alkes';
  include '../alkes/alkes/add.php';
  break;
case 'alkes-delete':
  include '../alkes/alkes/delete.php';
  break;
case 'alkes-edit':
  $title = 'Edit Data alkes';
  include '../alkes/alkes/edit.php';
  break;
case 'alkes-print':
  include '../alkes/alkes/print.php';
  break;
case 'alkes-print2':
  include '../alkes/alkes/print2.php';
  break;
case 'alkes-print2':
  include '../alkes/alkes/print3.php';
  break;

    //stok_alkes
case 'stok_alkes-show':
  $title = 'Data Stok alkes';
  include '../alkes/stok_alkes/show.php';
  break;
case 'stok_alkes-add':
  $title = 'Input Data Stok alkes';
  include '../alkes/stok_alkes/add.php';
  break;
case 'stok_alkes-delete':
  include '../alkes/stok_alkes/delete.php';
  break;
case 'stok_alkes-edit':
  $title = 'Edit Data Stok alkes';
  include '../alkes/stok_alkes/edit.php';
  break;
case 'stok_alkes-print':
  include '../alkes/stok_alkes/print.php';
  break;
case 'stok_alkes-print2':
  include '../alkes/stok_alkes/print2.php';
  break;
case 'stok_alkes-print2':
  include '../alkes/stok_alkes/print3.php';
  break;
  case 'stok_alkes-detail':
    include '../alkes/stok_alkes/detail_show.php';
    break;
    case 'stok_alkes-detail_delete':
      include '../alkes/stok_alkes/detail_delete.php';
      break;

       //penjualan_alkes
case 'penjualan_alkes-show':
  $title = 'Data Penjualan alkes';
  include '../alkes/penjualan_alkes/show.php';
  break;
case 'penjualan_alkes-add':
  $title = 'Input Data Penjualan alkes';
  include '../alkes/penjualan_alkes/add.php';
  break;
case 'penjualan_alkes-delete':
  include '../alkes/penjualan_alkes/delete.php';
  break;
case 'penjualan_alkes-edit':
  $title = 'Edit Data Penjualan alkes ';
  include '../alkes/penjualan_alkes/edit.php';
  break;
case 'penjualan_alkes-print':
  include '../alkes/penjualan_alkes/print.php';
  break;
case 'penjualan_alkes-print2':
  include '../alkes/penjualan_alkes/print2.php';
  break;
case 'penjualan_alkes-print2':
  include '../alkes/penjualan_alkes/print3.php';
  break;
  case 'penjualan_alkes-faktur':
    include '../alkes/penjualan_alkes/faktur.php';
    break;
    case 'penjualan_alkes-detail_show':
      include '../alkes/penjualan_alkes/detail_show.php';
      break;

     //detail_penjualan_alkes
 case 'detail_penjualan_alkes-show':
  $title = 'Data Detail Penjualan alkes';
  include '../alkes/detail_penjualan_alkes/show.php';
  break;
case 'detail_penjualan_alkes-add':
  $title = 'Input Data Detail Penjualan alkes';
  include '../alkes/detail_penjualan_alkes/add.php';
  break;
case 'detail_penjualan_alkes-delete':
  include '../alkes/detail_penjualan_alkes/delete.php';
  break;
case 'detail_penjualan_alkes-edit':
  $title = 'Edit Data Detail Penjualan alkes';
  include '../alkes/detail_penjualan_alkes/edit.php';
  break;
case 'detail_penjualan_alkes-print':
  include '../alkes/detail_penjualan_alkes/print.php';
  break;
case 'detail_penjualan_alkes-print2':
  include '../alkes/detail_penjualan_alkes/print2.php';
  break;
case 'detail_penjualan_alkes-print2':
  include '../alkes/detail_penjualan_alkes/print3.php';
  break;

     //pengadaan_alkes
 case 'pengadaan_alkes-show':
  $title = 'Data Pengadaan alkes';
  include '../alkes/pengadaan_alkes/show.php';
  break;
case 'pengadaan_alkes-add':
  $title = 'Input Data Pengadaan alkes';
  include '../alkes/pengadaan_alkes/add.php';
  break;
case 'pengadaan_alkes-delete':
  include '../alkes/pengadaan_alkes/delete.php';
  break;
case 'pengadaan_alkes-edit':
  $title = 'Edit Data Pengadaan alkes';
  include '../alkes/pengadaan_alkes/edit.php';
  break;
case 'pengadaan_alkes-print':
  include '../alkes/pengadaan_alkes/print.php';
  break;
case 'pengadaan_alkes-print2':
  include '../alkes/pengadaan_alkes/print2.php';
  break;
case 'pengadaan_alkes-print2':
  include '../alkes/pengadaan_alkes/print3.php';
  break;


   //detail_pengadaan_alkes
 case 'detail_pengadaan_alkes-show':
  $title = 'Data Detail Pengadaan alkes';
  include '../alkes/detail_pengadaan_alkes/show.php';
  break;
case 'detail_pengadaan_alkes-add':
  $title = 'Input Data Detail Pengadaan alkes';
  include '../alkes/detail_pengadaan_alkes/add.php';
  break;
case 'detail_pengadaan_alkes-delete':
  include '../alkes/detail_pengadaan_alkes/delete.php';
  break;
case 'detail_pengadaan_alkes-edit':
  $title = 'Edit Data Detail Pengadaan alkes';
  include '../alkes/detail_pengadaan_alkes/edit.php';
  break;
case 'detail_pengadaan_alkes-print':
  include '../alkes/detail_pengadaan_alkes/print.php';
  break;
case 'detail_pengadaan_alkes-print2':
  include '../alkes/detail_pengadaan_alkes/print2.php';
  break;
case 'pengadaan_alkes-detail':
  include '../alkes/detail_pengadaan_alkes/show.php';
  break;

      //penerimaan_alkes
 case 'penerimaan_alkes-show':
  $title = 'Data Penerimaan alkes';
  include '../alkes/penerimaan_alkes/show.php';
  break;
case 'penerimaan_alkes-add':
  $title = 'Input Data Penerimaan alkes';
  include '../alkes/penerimaan_alkes/add.php';
  break;
case 'penerimaan_alkes-delete':
  include '../alkes/penerimaan_alkes/delete.php';
  break;
case 'penerimaan_alkes-edit':
  $title = 'Edit Data Penerimaan alkes';
  include '../alkes/penerimaan_alkes/edit.php';
  break;
case 'penerimaan_alkes-print':
  include '../alkes/penerimaan_alkes/print.php';
  break;
case 'penerimaan_alkes-print2':
  include '../alkes/penerimaan_alkes/print2.php';
  break;
case 'penerimaan_alkes-detail':
  include '../alkes/penerimaan_alkes/detail.php';
  break;
  case 'penerimaan_alkes-detail_delete':
    include '../alkes/penerimaan_alkes/detail_delete.php';
    break;
  case 'penerimaan_alkes-detail_edit':
    include '../alkes/penerimaan_alkes/detail_edit.php';
    break;

     //ketersediaan_alkes
   case 'ketersediaan_alkes-show':
    $title = 'Data Ketersediaan alkes';
    include '../alkes/ketersediaan_alkes/show.php';
    break;
  case 'ketersediaan_alkes-add':
    $title = 'Input Data Ketersediaan alkes';
    include '../alkes/ketersediaan_alkes/add.php';
    break;
  case 'ketersediaan_alkes-delete':
    include '../alkes/ketersediaan_alkes/delete.php';
    break;
  case 'ketersediaan_alkes-edit':
    $title = 'Edit Data Ketersediaan alkes';
    include '../alkes/ketersediaan_alkes/edit.php';
    break;
  case 'ketersediaan_alkes-print':
    include '../alkes/ketersediaan_alkes/print.php';
    break;
  case 'ketersediaan_alkes-print2':
    include '../alkes/ketersediaan_alkes/print2.php';
    break;
  case 'ketersediaan_alkes-print2':
    include '../alkes/ketersediaan_alkes/print3.php';
    break;
    case 'ketersediaan_alkes-detail':
      include '../alkes/ketersediaan_alkes/detail_show.php';
      break;
      case 'ketersediaan_alkes-detail_delete':
        include '../alkes/ketersediaan_alkes/detail_delete.php';
        break;

            //detail_ketersediaan_alkes
  case 'detail_ketersediaan_alkes-show':
    $title = 'Data alkes Masuk';
    include '../alkes/detail_ketersediaan_alkes/show.php';
    break;
  case 'detail_ketersediaan_alkes-add':
    $title = 'Input Data alkes Masuk';
    include '../alkes/detail_ketersediaan_alkes/add.php';
    break;
  case 'detail_ketersediaan_alkes-delete':
    include '../alkes/detail_ketersediaan_alkes/delete.php';
    break;
  case 'detail_ketersediaan_alkes-edit':
    $title = 'Edit Data alkes Masuk';
    include '../alkes/detail_ketersediaan_alkes/edit.php';
    break;
  case 'detail_ketersediaan_alkes-print':
    include '../alkes/detail_ketersediaan_alkes/print.php';
    break;
  case 'detail_ketersediaan_alkes-print2':
    include '../alkes/detail_ketersediaan_alkes/print2.php';
    break;
  case 'detail_ketersediaan_alkes-print2':
    include '../alkes/detail_ketersediaan_alkes/print3.php';
    break;

         //masuk_etalase_alkes
        case 'masuk_etalase_alkes-show':
          $title = 'Data alkes Masuk';
          include '../alkes/masuk_etalase_alkes/show.php';
          break;
        case 'masuk_etalase_alkes-add':
          $title = 'Input Data alkes Masuk';
          include '../alkes/masuk_etalase_alkes/add.php';
          break;
        case 'masuk_etalase_alkes-delete':
          include '../alkes/masuk_etalase_alkes/delete.php';
          break;
        case 'masuk_etalase_alkes-edit':
          $title = 'Edit Data alkes Masuk';
          include '../alkes/masuk_etalase_alkes/edit.php';
          break;
        case 'masuk_etalase_alkes-print':
          include '../alkes/masuk_etalase_alkes/print.php';
          break;
        case 'masuk_etalase_alkes-print2':
          include '../alkes/masuk_etalase_alkes/print2.php';
          break;
        case 'masuk_etalase_alkes-print2':
          include '../alkes/masuk_etalase_alkes/print3.php';
          break;

              //masuk_gudang_alkes
        case 'masuk_gudang_alkes-show':
          $title = 'Data alkes Masuk';
          include '../alkes/masuk_gudang_alkes/show.php';
          break;
        case 'masuk_gudang_alkes-add':
          $title = 'Input Data alkes Masuk';
          include '../alkes/masuk_gudang_alkes/add.php';
          break;
        case 'masuk_gudang_alkes-delete':
          include '../alkes/masuk_gudang_alkes/delete.php';
          break;
        case 'masuk_gudang_alkes-edit':
          $title = 'Edit Data alkes Masuk';
          include '../alkes/masuk_gudang_alkes/edit.php';
          break;
        case 'masuk_gudang_alkes-print':
          include '../alkes/masuk_gudang_alkes/print.php';
          break;
        case 'masuk_gudang_alkes-print2':
          include '../alkes/masuk_gudang_alkes/print2.php';
          break;
        case 'masuk_gudang_alkes-print2':
          include '../alkes/masuk_gudang_alkes/print3.php';
          break;

               //keluar_etalase_alkes
        case 'keluar_etalase_alkes-show':
          $title = 'Data alkes Keluar';
          include '../alkes/keluar_etalase_alkes/show.php';
          break;
        case 'keluar_etalase_alkes-add':
          $title = 'Input Data alkes Keluar';
          include '../alkes/keluar_etalase_alkes/add.php';
          break;
        case 'keluar_etalase_alkes-delete':
          include '../alkes/keluar_etalase_alkes/delete.php';
          break;
        case 'keluar_etalase_alkes-edit':
          $title = 'Edit Data alkes Keluar';
          include '../alkes/keluar_etalase_alkes/edit.php';
          break;
        case 'keluar_etalase_alkes-print':
          include '../alkes/keluar_etalase_alkes/print.php';
          break;
        case 'keluar_etalase_alkes-print2':
          include '../alkes/keluar_etalase_alkes/print2.php';
          break;
        case 'keluar_etalase_alkes-print2':
          include '../alkes/keluar_etalase_alkes/print3.php';
          break;

                //keluar_gudang_alkes
        case 'keluar_gudang_alkes-show':
          $title = 'Data alkes Keluar';
          include '../alkes/keluar_gudang_alkes/show.php';
          break;
        case 'keluar_gudang_alkes-add':
          $title = 'Input Data alkes Keluar';
          include '../alkes/keluar_gudang_alkes/add.php';
          break;
        case 'keluar_gudang_alkes-delete':
          include '../alkes/keluar_gudang_alkes/delete.php';
          break;
        case 'keluar_gudang_alkes-edit':
          $title = 'Edit Data alkes Keluar';
          include '../alkes/keluar_gudang_alkes/edit.php';
          break;
        case 'keluar_gudang_alkes-print':
          include '../alkes/keluar_gudang_alkes/print.php';
          break;
        case 'keluar_gudang_alkes-print2':
          include '../alkes/keluar_gudang_alkes/print2.php';
          break;
        case 'keluar_gudang_alkes-print2':
          include '../alkes/keluar_gudang_alkes/print3.php';
          break;





//user
            case 'user-show':
              $title = 'Data User';
              include '../user/show.php';
              break;

            case 'user-add':
              $title = 'Input Data User';
              include '../user/add.php';
              break;
            case 'user-edit':
              $title = 'Edit Data User';
              include '../user/edit.php';
              break;

            case 'user-delete':
              include '../user/delete.php';
              break;

            case 'admin-logout':
              include 'logout.php';
              break;

            default:
              $title = 'Dashboard';
              include 'dashboard.php';
              break;
          }
          ?>
        </div>

        <?php include '../template/footer.php'; ?>

</body>

</html>