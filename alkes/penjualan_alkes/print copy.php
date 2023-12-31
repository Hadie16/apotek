<!-- <link rel="stylesheet" href="../css/sb-admin-2.min.css"> -->
<style>
* {
  font-family: Arial, Helvetica, sans-serif;
}

table {
  border-collapse: collapse;
  border-color: black;
}
</style>
<h2 align="center">Laporan Detail Mahasiswa</h2>
<div class="table-responsive mt-3">
  <table border="1" width="70%" align="center" cellpadding="8">
    <tbody><?php
include '../template/headerPrint.php';
?>
<br>
<h2 align="center">Laporan Data Penjualan Obat</h2>
<div class="table-responsive mt-3">
  <table border="1" width="100%" align="center" cellpadding="8">
    <thead>
      <tr>
        <th width="5%">No</th>
 
        <th >Kode Penjualan</th>
                <th >Tanggal</th>
          
                <th >Pendapatan</th>
                <th >TTK</th>


<!-- align="center" -->
        <!-- <th width="10%">Email</th>
        <th width="5%">Status</th> -->

      </tr>
    </thead>

    <tbody>
      <?php
//error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// $keyword = $_GET['keyword'];
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';


      include '../connection.php';

  //     if(!empty($_GET['keyword'])){
  // $keyword = $_GET['keyword'];
      $query = mysqli_query($con, "SELECT a.*,b.nama_ttk nama FROM penjualan_obat a join ttk b on a.id_ttk=b.id_ttk WHERE nama_ttk LIKE '%$keyword%'  OR kode_penjualan_obat LIKE '%$keyword%'");
  //     }else{
        // $query = mysqli_query($con, "SELECT a.*,b.nama_ttk nama FROM penjualan_obat a join ttk b on a.id_ttk=b.id_ttk");
      



//   if ($query) {
//      echo "<p>query berhasil<p/>";
//  } else {
//      die('invalid Query : ' . mysqli_error($con));
//  }

  
$no = 1;
    
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
      <td><?php echo $no++ ?></td>
                        
      <td><?php echo $data['kode_penjualan_obat']; ?></td>
                <td class="text-nowrap"><?php echo $data['tanggal_penjualan_obat']; ?></td>
                <td><?php echo $data['total_harga']; ?></td>
                <td><?php echo $data['nama']; ?></td>

      </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>
<?php include '../template/footerPrint.php';?>
</div>
<script>
window.print();
</script>
      <?php
      $id = $_GET['id'];
      // $id = 11;
      include '../connection.php';
      $query = mysqli_query($con, "SELECT * FROM mahasiswa WHERE id = $id");
      while ($data = mysqli_fetch_array($query)) { ?>
      <tr>
        <td width=25%>NIM</td>
        <td width=75%><?php echo $data['nim'] ?></td>
      </tr>
      <tr>
        <td>Nama Lengkap</td>
        <td><?php echo $data['nama'] ?></td>
      </tr>
      <tr>
        <td>Jurusan</td>
        <td>
          <?php
            if ($data['jurusan'] == "TI") {
              echo "Teknik Informatika";
            } else {
              echo "Sistem Informasi";
            }
            ?>
        </td>
      </tr>
      <tr>
        <td>Jenis Kelamin</td>
        <td>

          <?php
            if ($data['jenis_kelamin'] == "L") {
              echo "Laki-laki";
            } else {
              echo "Perempuan";
            }
            ?>
        </td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td><?php echo $data['alamat'] ?></td>
      </tr>
      <tr>
        <td>Telepon</td>
        <td><?php echo $data['telepon'] ?></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><?php echo $data['email'] ?></td>
      </tr>



      <!-- <tr>

        <td align="center"><?php echo $data['nim']; ?></td>
        <td><?php echo $data['nama']; ?></td>
        <td align="center"><?php echo $data['jurusan']; ?></td>
        <td align="center"><?php echo $data['jenis_kelamin']; ?></td>
        <td><?php echo $data['alamat']; ?></td>
        <td align="center"><?php echo $data['telepon']; ?></td>
        <td><?php echo $data['email']; ?></td>
      </tr> -->
      <?php
      }
      ?>
    </tbody>
  </table>
</div>

<script>
window.print();
</script>