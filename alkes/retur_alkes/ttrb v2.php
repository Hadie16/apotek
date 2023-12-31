<link rel="stylesheet" href="../css/sb-admin-2.min.css">

<style>
* {
  font-family: Arial, Helvetica, sans-serif;
}

.container {
  display: flex;
  align-items: flex-end;
  color: black; 
}

.logo {
  width: 120px;
  height: 150px;
  margin-right: 20px;
}

table {
  border-collapse: collapse;
  border-color: black;
  color: black; 
}

h2 {
  margin-top: 5px;
  margin-bottom: 5px;
  color: black; 
}

h3 {
  margin-top: 5px;
  margin-bottom: 5px;
  color: black; 
}

p {
  margin-top: 5px;
  margin-bottom: 5px;
  color: black; 
}
</style>

<div class="container">
  <img class="logo" src="../assets/img/logo_mahabbah-removebg-preview.png">

  <div>
    <!-- <h3 align="center">PEMERINTAH PROVINSI KALIMANTAN SELATAN</h3>
    <h2 align="center">DINAS KEHUTANAN</h2> -->

    <h2 align="center">APOTEK MAHABBAH</h2>
    <!-- <h2 align="center">-</h2> -->

    <p align="center"> Jalan Makam RT.006/RW.003 Pasayangan Selatan Kecamatan Martapura Kode Pos 70619 Telepon 0823 58813379</p>
    <p align="center"> Email : mahabbah.pharmacy@gmail.com Website : www.mahabbah.com</p>
  </div>
</div>

<hr style="border: none; border-top: 3px solid black; font-weight: bold;">

<br>
<h2 align="center" style="text-decoration: underline; text-decoration-skip-ink: none;">TANDA TERIMA RETUR BARANG</h2>
<!-- <div align="left">
  <p>Mohon dikirimkan alkes-alkesan untuk keperluan Apotek, sebagai berikut :</p>
</div> -->
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_GET['id'];
// include '../connection.php';

      include '../connection.php';
      $querys = mysqli_query($con, "SELECT po.*,s.nama_supplier from retur_alkes po join detail_retur_alkes dpo on po.id_retur_alkes=dpo.id_retur_alkes join alkes o on dpo.id_alkes=o.id_alkes join supplier s on po.id_supplier=s.id_supplier where po.id_retur_alkes='$id'");
      if ($querys) {
        // echo "<p>query berhasil<p/>";
    } else {
        die('invalid Query : ' . mysqli_error($con));
    }   
    while ($datas = mysqli_fetch_array($querys)) {
$supp = $datas['nama_supplier'];
$kodes = $datas['kode_retur_alkes'];

    }
    ?>
<div class="table-responsive mt-3">
<!-- <p style="margin-left: 35px;">Kepada Yth: <?php echo $supp ?></p> -->
<p style="margin-left: 35px;">No. <?php echo $kodes?></p>
  <br>
<p style="margin-left: 35px;">Dengan ini kami mengembalikan alkes-alkesan, sebagai berikut :</p>
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead>
      <tr>
        
        <th width="5%">No</th>
 
        <th >Nama alkes</th>
                <th >Jumlah</th>
          
                <th >Satuan</th>
                <th >Batch Number</th>
                <th >Expired</th>

                <!-- <th >Kasir</th> -->


<!-- align="center" -->
        <!-- <th width="10%">Email</th>
        <th width="5%">Status</th> -->

      </tr>
    </thead>

    <tbody>
      <?php

// $id = $_GET['id'];

      // include '../connection.php';
      $query = mysqli_query($con, "SELECT * from retur_alkes po join detail_retur_alkes dpo on po.id_retur_alkes=dpo.id_retur_alkes join alkes o on dpo.id_alkes=o.id_alkes where po.id_retur_alkes='$id'");
      if ($query) {
        // echo "<p>query berhasil<p/>";
    } else {
        die('invalid Query : ' . mysqli_error($con));
    }     
    
     
    

$no = 1;
    
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
      <td><?php echo $no++ ?></td>
                        
      <td><?php echo $data['nama_alkes']; ?></td>
                <td class="text-nowrap"><?php echo $data['jumlah']; ?></td>
      <td><?php echo $data['satuan']; ?></td>

                <td><?php echo $data['batch_number']; ?></td>
                <td><?php echo $data['tanggal_kadaluarsa']; ?></td>

      </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>

<div align="center" style="position: relative; top: 50px; right: 500px;">
  <p>Yang Menyerahkan</p>
  <br>
    <br>

    <p>Apotek Mahabbah</p>

    </div>




    <div align="center" style="position: relative; bottom: 65px; left: 500px;">
    <p>Yang Menerima</p>
    <br>
    <br>

    <p><?php echo $supp ?></p>


    </div>

</div>
<script>
window.print();
</script>