<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>





            <!-- </div> -->

            <!-- table -->

            <div class="row">
<!-- Bootstrap styles -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

<!-- HTML form with Bootstrap styling -->
<!-- <div class="container mt-4"> -->
 
<!-- </div> -->

  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-info" id="h6ContTabelObat">
                     <?php $date = date("F Y"); // get current date in desired format
$date = str_replace(
    array('January', 'February', 'March', 'April', 'May', 'June', 
          'July', 'August', 'September', 'October', 'November', 'December'),
    array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
          'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'),
    $date); // replace month name in English with Indonesian
// echo $date; // output the date?>
                       Penjualan Obat Tertinggi Periode (<?php echo $date ?>)
                    </h6>
        <!-- <h6 class="m-0 font-weight-bold text-info">Penjualan Tertinggi Periode </h6> -->
      </div>
     
      <div class="card-body">
      <div class="row">
      <div class="col-sm-3" id="printContainerTabel">
        <!-- <div id="selectMonth">
        </div>
        <scrip

        <div id="selectYear">
        </div> -->
      
        <a href="../laporan_penjualan/printTop.php?month="+month class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a>
          </div>
<?php
 $currentMonth = date('n');
$currentYear = date('Y');
?>
          <form id="tabelFilterForm">
          <!-- <div class="col-8 col-md-4"> -->
      <!-- <div class="col-sm-3"> -->
      <div class="row">   
      
        <label for="month" style="margin-left: 10px;margin-top:4px;margin-right:4px">Bulan:</label>
     

        <!-- <div class="col-sm-5"> -->
        <div  style="width:120px">

        <select id="monthTabel" name="monthTabel" class="custom-select custom-select-sm">
        <option value="0" <?php if ($currentMonth == '0') echo 'selected'; ?>>None</option>

        <option value="1" <?php if ($currentMonth == '1') echo 'selected'; ?>>January</option>
            <option value="2"  <?php if ($currentMonth == '2') echo 'selected'; ?>>February</option>
            <option value="3" <?php if ($currentMonth == '3') echo 'selected'; ?>>March</option>
            <option value="4" <?php if ($currentMonth == '4') echo 'selected'; ?>>April</option>
            <option value="5" <?php if ($currentMonth == '5') echo 'selected'; ?>>May</option>
            <option value="6" <?php if ($currentMonth == '6') echo 'selected'; ?>>June</option>
            <option value="7" <?php if ($currentMonth == '7') echo 'selected'; ?>>July</option>
            <option value="8" <?php if ($currentMonth == '8') echo 'selected'; ?>>August</option>
            <option value="9" <?php if ($currentMonth == '9') echo 'selected'; ?>>September</option>
            <option value="10" <?php if ($currentMonth == '10') echo 'selected'; ?>>October</option>
            <option value="11" <?php if ($currentMonth == '11') echo 'selected'; ?>>November</option>
            <option value="12" <?php if ($currentMonth == '12') echo 'selected'; ?>>December</option>
        </select>
          </div>
        

        
    
        <label for="year" style="margin-left: 10px;margin-top:4px;margin-right:4px">Tahun:</label>
        <!-- <div class="col-sm-4"> -->
        <div  style="width:80px">

        <select id="yearTabel" name="yearTabel" class="custom-select custom-select-sm">
        <?php
       $query = mysqli_query($con, "SELECT *,year(po.tanggal_penjualan_obat) as cy,sum(dpo.jumlah_detail_penjualan_obat) as sj from
       detail_penjualan_obat as dpo join penjualan_obat as po on dpo.id_penjualan_obat=po.id_penjualan_obat 
        join ketersediaan_obat as ko on dpo.id_obat=ko.id_obat join obat as o on dpo.id_obat=o.id_obat group by cy
       ");
       while ($row = mysqli_fetch_assoc($query)) {
           $cy = $row['cy'];
          //  $nama_ttk = $row['nama_ttk'];

            if ($cy == $currentYear) {
              echo '<option value="' . $cy . '" selected>' . $cy . '</option>';
          } else {
            echo '<option value="' . $cy . '">' . $cy . '</option>';
        }
      }

        ?>
        </select>
    </div>
 

        <!-- class="btn btn-sm" style="background:skyblue;color:white"  id="myDivBtn" ><i class="fas fa-filter"></i></button> -->
        <input type="submit" value="Filter" class="btn btn-sm" style="background:skyblue;color:white;margin-left:10px;margin-bottom:5px">
        </div>
    </form>
    <div class="table-responsive mt-3" >
<div id="tableContainerTabel" style="width: 100%;">

        <table class="table table-bordered" id="viewTop" style="width: 100%;">
          <thead>
            <tr>
            <th>No</th>

            <th>Nama Obat</th>
              <th>Jumlah</th>
              <th>Satuan</th>

              <th>Harga (Rp)</th>
              <th>Total Harga (Rp)</th>
            </tr>
          </thead>
          <tbody>
          <?php

include '../connection.php';

$query = mysqli_query($con, 'SELECT a.satuan,a.id_obat,c.nama_obat, SUM(jumlah_detail_penjualan_obat) AS jumlah,harga_detail_penjualan_obat, SUM(harga_detail_penjualan_obat) as total_harga FROM detail_penjualan_obat as a join penjualan_obat as b on a.id_penjualan_obat=b.id_penjualan_obat join obat c on a.id_obat=c.id_obat WHERE MONTH(tanggal_penjualan_obat) = MONTH(CURRENT_DATE())
GROUP BY nama_obat
ORDER BY jumlah');


if (!$query) {
  die('Query Error: ' . mysqli_error($con));
}
$no=1;
while ($data = mysqli_fetch_array($query)) {  ?>

<tr>
<td><?php echo $no++?></td>

  <td><?php echo $data['nama_obat']; ?></td>
  <td><?php echo $data['jumlah']; ?></td>
  <td><?php echo $data['satuan']; ?></td>

  <td><?php echo number_format($data['harga_detail_penjualan_obat'],0,'.'); ?></td>

  <td><?php echo number_format($data['jumlah']*$data['harga_detail_penjualan_obat'],0,'.'); ?></td>

</tr>

<?php
}
?>
          </tbody>
        </table>
      </div>
      </div>

      </div>

    </div>
  </div>
  </div>


  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-info" id="h6ContTabelAlkes">
                     <?php $date2 = date("F Y"); // get current date2 in desired format
$date2 = str_replace(
    array('January', 'February', 'March', 'April', 'May', 'June', 
          'July', 'August', 'September', 'October', 'November', 'December'),
    array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
          'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'),
    $date2); // replace month name in English with Indonesian
// echo $date2; // output the date2?>
                       Penjualan Alat Kesehatan Tertinggi Periode (<?php echo $date2 ?>)
                    </h6>
        <!-- <h6 class="m-0 font-weight-bold text-info">Penjualan Tertinggi Periode </h6> -->
      </div>
     
      <div class="card-body">
      <div class="row">
      <div class="col-sm-3" id="printContainerTabel2">
        <!-- <div id="selectMonth">
        </div>
        <scrip

        <div id="selectYear">
        </div> -->
      
        <a href="../laporan_penjualan/printTop2.php?month="+month class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a>
          </div>
<?php
 $currentMonth2 = date('n');
$currentYear2 = date('Y');
?>
          <form id="tabelFilterForm2">
          <!-- <div class="col-8 col-md-4"> -->
      <!-- <div class="col-sm-3"> -->
      <div class="row">   
      
        <label for="month" style="margin-left: 10px;margin-top:4px;margin-right:4px">Bulan:</label>
     

        <!-- <div class="col-sm-5"> -->
        <div  style="width:120px">

        <select id="monthTabel2" name="monthTabel2" class="custom-select custom-select-sm">
        <option value="0" <?php if ($currentMonth2 == '0') echo 'selected'; ?>>None</option>

        <option value="1" <?php if ($currentMonth2 == '1') echo 'selected'; ?>>January</option>
            <option value="2"  <?php if ($currentMonth2 == '2') echo 'selected'; ?>>February</option>
            <option value="3" <?php if ($currentMonth2 == '3') echo 'selected'; ?>>March</option>
            <option value="4" <?php if ($currentMonth2 == '4') echo 'selected'; ?>>April</option>
            <option value="5" <?php if ($currentMonth2 == '5') echo 'selected'; ?>>May</option>
            <option value="6" <?php if ($currentMonth2 == '6') echo 'selected'; ?>>June</option>
            <option value="7" <?php if ($currentMonth2 == '7') echo 'selected'; ?>>July</option>
            <option value="8" <?php if ($currentMonth2 == '8') echo 'selected'; ?>>August</option>
            <option value="9" <?php if ($currentMonth2 == '9') echo 'selected'; ?>>September</option>
            <option value="10" <?php if ($currentMonth2 == '10') echo 'selected'; ?>>October</option>
            <option value="11" <?php if ($currentMonth2 == '11') echo 'selected'; ?>>November</option>
            <option value="12" <?php if ($currentMonth2 == '12') echo 'selected'; ?>>December</option>
        </select>
          </div>
        

        
    
        <label for="year" style="margin-left: 10px;margin-top:4px;margin-right:4px">Tahun:</label>
        <!-- <div class="col-sm-4"> -->
        <div  style="width:80px">

        <select id="yearTabel2" name="yearTabel2" class="custom-select custom-select-sm">
        <?php
       $query = mysqli_query($con, "SELECT *,year(po.tanggal_penjualan_alkes) as cy,sum(dpo.jumlah_detail_penjualan_alkes) as sj from
       detail_penjualan_alkes as dpo join penjualan_alkes as po on dpo.id_penjualan_alkes=po.id_penjualan_alkes 
        join ketersediaan_alkes as ko on dpo.id_alkes=ko.id_alkes join alkes as o on dpo.id_alkes=o.id_alkes group by cy
       ");
       while ($row = mysqli_fetch_assoc($query)) {
           $cy = $row['cy'];
          //  $nama_ttk = $row['nama_ttk'];

            if ($cy == $currentYear2) {
              echo '<option value="' . $cy . '" selected>' . $cy . '</option>';
          } else {
            echo '<option value="' . $cy . '">' . $cy . '</option>';
        }
      }

        ?>
        </select>
    </div>
 

        <!-- class="btn btn-sm" style="background:skyblue;color:white"  id="myDivBtn" ><i class="fas fa-filter"></i></button> -->
        <input type="submit" value="Filter" class="btn btn-sm" style="background:skyblue;color:white;margin-left:10px;margin-bottom:5px">
        </div>
    </form>
    <div class="table-responsive mt-3" >
<div id="tableContainerTabel2" style="width: 100%;">

        <table class="table table-bordered" id="viewTop2" style="width: 100%;">
          <thead>
            <tr>
            <th>No</th>

            <th>Nama Alkes</th>
              <th>Jumlah</th>
              <th>Satuan</th>

              <th>Harga (Rp)</th>
              <th>Total Harga (Rp)</th>
            </tr>
          </thead>
          <tbody>
          <?php

include '../connection.php';

$query = mysqli_query($con, 'SELECT a.satuan,a.id_alkes,c.nama_alkes, SUM(jumlah_detail_penjualan_alkes) AS jumlah,harga_detail_penjualan_alkes, SUM(harga_detail_penjualan_alkes) as total_harga FROM detail_penjualan_alkes as a join penjualan_alkes as b on a.id_penjualan_alkes=b.id_penjualan_alkes join alkes c on a.id_alkes=c.id_alkes WHERE MONTH(tanggal_penjualan_alkes) = MONTH(CURRENT_DATE())
GROUP BY nama_alkes
ORDER BY jumlah');


if (!$query) {
  die('Query Error: ' . mysqli_error($con));
}
$no=1;
while ($data = mysqli_fetch_array($query)) {  ?>

<tr>
<td><?php echo $no++?></td>

  <td><?php echo $data['nama_alkes']; ?></td>
  <td><?php echo $data['jumlah']; ?></td>
  <td><?php echo $data['satuan']; ?></td>

  <td><?php echo number_format($data['harga_detail_penjualan_alkes'],0,'.'); ?></td>

  <td><?php echo number_format($data['jumlah']*$data['harga_detail_penjualan_alkes'],0,'.'); ?></td>

</tr>

<?php
}
?>
          </tbody>
        </table>
      </div>
      </div>

      </div>

    </div>
  </div>
  </div>
  </div>


