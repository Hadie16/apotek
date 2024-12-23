<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar2">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?page=dashboard">
 <!-- href="index.html"  -->
    <div class="sidebar-brand-icon">



      <img src="../assets/img/logo_mahabbah-removebg-preview.png"  width="50">
    </div>
    <div class="sidebar-brand-text mx-3 text-left small">
      Apotek MAHABBAH
    
    </div>
  </a>




<?php $current_page = $_SERVER['REQUEST_URI'];
 ?>
  <hr class="sidebar-divider my-0"/>
<!-- added code  19-07-23--> 
<nav class="sidebar-scroll"  id="accordionSidebar">

  <li class="nav-item <?php echo ($current_page == '/mahabbah/admin/index.php?page=dashboard') ? 'active' : ''; ?>">
    <a class="nav-link " href="?page=dashboard">
      <i class="fas fa-fw fa-home"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <!-- <hr class="sidebar-divider" /> -->

  <?php
  session_start();
  if ($_SESSION['level'] != 'pimpinan') { ?>
    <!-- // echo ' -->
<div class="sidebar-heading">Layanan</div>

  <li class="nav-item <?php echo ($current_page == '/mahabbah/admin/index.php?page=penjualan_obat-show') ? 'active' : ''; ?>">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#penjualanObat" aria-expanded="true"
      aria-controls="collapsepenjualanObatTwo">
      <!-- <i class="fas fa-fw fa-user-graduate"></i> -->
      <i class="fas fa-fw fa-shopping-cart"></i>

      <span>Penj. Obat</span>
    </a>
    <div id="penjualanObat" class="collapse" aria-labelledby="penjualanObat" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="?page=penjualan_obat-show">Data Penjualan Obat</a>
        <a class="collapse-item" href="?page=penjualan_obat-add">Input Data</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#penjualanAlkes" aria-expanded="true"
      aria-controls="collapsepenjualanAlkesTwo">
      <i class="fas fa-fw fa-medkit"></i>
      <span>Penj. Alkes</span>
    </a>
    <div id="penjualanAlkes" class="collapse" aria-labelledby="penjualanAlkes" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="?page=penjualan_alkes-show">Data Penjualan Alkes</a>
        <a class="collapse-item" href="?page=penjualan_alkes-add">Input Data</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#cekKesehatan" aria-expanded="true"
      aria-controls="collapsecekKesehatanTwo">
      <i class="fas fa-fw fa-heartbeat"></i>
      <span>Cek Kesehatan</span>
    </a>
    <div id="cekKesehatan" class="collapse" aria-labelledby="cekKesehatan" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <!-- <a class="collapse-item" href="?page=cek_kesehatan-add">Cek </a> -->
        <a class="collapse-item" href="?page=cek_kesehatan-show">Data Cek Kesehatan</a>
        <a class="collapse-item" href="?page=cek_kesehatan-add">Input Data</a>
        <a class="collapse-item" href="?page=history-show">History Pasien</a>

      </div>
    </div>
  </li>

 
  
  

  <hr class="sidebar-divider" />

<!-- Heading -->
<!-- <a class="nav-item collapsed" href="#" data-toggle="collapse" data-target="#kk" aria-expanded="true"
      aria-controls="collapsekkTwo"> -->

      <!-- <span>sss</span> -->
<div class="sidebar-heading">Manajemen</div>
<!-- <a class="  > -->
<!-- <div id="kk" class="collapse" aria-labelledby="kk" data-parent="#accordionSidebar"> -->


  <li class="nav-item" id="stok_obat-link">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#stok" aria-expanded="true"
    aria-controls="collapsestokTwo">
    <i class="fas fa-fw fa-cubes"></i>
    <span>Stok</span>
  </a>
  <div id="stok" class="collapse" aria-labelledby="stok" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="?page=stok_obat-show" id="stok_obat-link2">Obat</a>
      <a class="collapse-item" href="?page=stok_alkes-show" id="stok_alkes-link">ALKES</a>
      <a class="collapse-item" href="?page=stok_obat-expired" id="expired-link">Expired</a>

    </div>
  </div>
</li>


  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ketersediaan" aria-expanded="true"
      aria-controls="collapseketersediaanTwo">
      <i class="fas fa-fw fa-clipboard-list"></i>
      <span>Ketersediaan</span>
    </a>
    <div id="ketersediaan" class="collapse" aria-labelledby="ketersediaan" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="?page=ketersediaan_obat-show">Obat</a>
        <a class="collapse-item" href="?page=ketersediaan_alkes-show">ALKES</a>
 

      </div>
    </div>
  </li>
<?php
}
?>
   <!-- Divider -->
   <?php
  session_start();
  if ($_SESSION['level'] == 'administrator') {
    echo '
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#returnBarang" aria-expanded="true"
      aria-controls="collapsereturnBarangTwo">
      <i class="fas fa-fw fa-undo"></i>

      <span>Retur</span>
    </a>
    <div id="returnBarang" class="collapse" aria-labelledby="returnBarang" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <!-- <a class="collapse-item" href="?page=cek_kesehatan-add">Cek </a> -->
        <a class="collapse-item" href="?page=retur_obat-show">Obat</a>
        <a class="collapse-item" href="?page=retur_alkes-show">Alkes</a>
      </div>
    </div>
  </li>

<!-- </script> -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#penerimaan" aria-expanded="true"
      aria-controls="collapsepenerimaanTwo">
      <i class="fas fa-fw fa-receipt"></i>
      <span>Penerimaan</span>
    </a>
    <div id="penerimaan" class="collapse" aria-labelledby="penerimaan" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="?page=penerimaan_obat-show">Obat</a>
        <a class="collapse-item" href="?page=penerimaan_alkes-show">ALKES</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pengadaan" aria-expanded="true"
      aria-controls="collapsepengadaanTwo">
      <i class="fas fa-fw fa-truck"></i>
      <span>Pengadaan</span>
    </a>
    <div id="pengadaan" class="collapse" aria-labelledby="pengadaan" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="?page=pengadaan_obat-show">Obat</a>
        <a class="collapse-item" href="?page=pengadaan_alkes-show">ALKES</a>
      </div>
    </div>
  </li>


  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan" aria-expanded="true"
      aria-controls="laporan">
      <!-- <i class="fas fa-fw fa-file"></i> -->
      <i class="fas fa-fw fa-chart-bar"></i>

      <span>Laporan Penjualan</span>
    </a>
    <div id="laporan" class="collapse" aria-labelledby="laporan" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item"  href="?page=laporan_penjualan-showGrafik">Grafik</a>
        <a class="collapse-item"  href="?page=laporan_penjualan-showTabel">Tabel</a>
        <a class="collapse-item"  href="?page=laporan_penjualan-laba">Laba</a>

  

      </div>
    </div>
  </li>
   ';
  }
  ?>


<?php
  session_start();
  if ($_SESSION['level'] == 'pimpinan') {
    echo '
    <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan" aria-expanded="true"
      aria-controls="laporan">
      <!-- <i class="fas fa-fw fa-file"></i> -->
      <i class="fas fa-fw fa-chart-bar"></i>

      <span>Laporan Penjualan</span>
    </a>
    <div id="laporan" class="collapse" aria-labelledby="laporan" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item"  href="?page=laporan_penjualan-showGrafik">Grafik</a>
        <a class="collapse-item"  href="?page=laporan_penjualan-showTabel">Tabel</a>
        <a class="collapse-item"  href="?page=laporan_penjualan-laba">Laba</a>

  

      </div>
    </div>
  </li>
   ';
  }
  ?>

   <?php
  session_start();
  if ($_SESSION['level'] == 'administrator') {
    echo '
   <hr class="sidebar-divider" />

<!-- Heading -->
<div class="sidebar-heading">Tambah Data</div>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tambahData" aria-expanded="true"
      aria-controls="collapsetambahDataTwo">
      <i class="fas fa-fw fa-database"></i>
      <span>Master Data</span>
    </a>
    <div id="tambahData" class="collapse" aria-labelledby="tambahData" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="?page=obat-show">Data Obat</a>
        <a class="collapse-item" href="?page=alkes-show">Data ALKES</a>
        <a class="collapse-item" href="?page=supplier-show">Data Supplier</a>
         <a class="collapse-item" href="?page=ttk-show">Data TTK </a>
        <!-- <a class="collapse-item" href="?page=dosen-show">Data Dosen</a>
        <a class="collapse-item" href="?page=dosen-add">Data</a> -->
      </div>
    </div>
  </li>


    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#user" aria-expanded="true"
        aria-controls="user">
        <i class="fas fa-fw fa-user"></i>
        <span>User</span>
      </a>
      <div id="user" class="collapse" aria-labelledby="user" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="?page=user-show">Data User</a>
          <a class="collapse-item" href="?page=user-add">Input User</a>
        </div>
      </div>
    </li>
    ';
  }
  ?>


  <hr class="sidebar-divider d-none d-md-block" />
  <!-- <div class="text-center d-none d-md-inline"> -->
  <div class="text-center">

    <button aria-label="toggle" type="button" class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

  </nav>
<!-- end added code -->

</ul>
