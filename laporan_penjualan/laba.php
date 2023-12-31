<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>




<!-- ================total pendapatan================ -->

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <!-- Penjualan Obat,Alkes dan Cek Kesehatan -->
        <h6 class="m-0 font-weight-bold text-info">Data Laba Penjualan</h6>

      </div>
<div class="card-body">
<div class="row">
      <div class="col-sm-3" id="printContainer">
        <!-- <div id="selectMonth">
        </div>
        <scrip

        <div id="selectYear">
        </div> -->
      
        <a href="../laporan_penjualan/print.php?month="+month class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a>
          </div>
<?php
 $currentMonth = date('n');
$currentYear = date('Y');
?>
          <form id="filterForm">
          <!-- <div class="col-8 col-md-4"> -->
      <!-- <div class="col-sm-3"> -->
      <div class="row">   
      
        <label for="month" style="margin-left: 10px;margin-top:4px;margin-right:4px">Bulan:</label>
     

        <!-- <div class="col-sm-5"> -->
        <div  style="width:120px">

        <select id="month" name="month" class="custom-select custom-select-sm">
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

        <select id="year" name="year" class="custom-select custom-select-sm">
        <?php
       $query = mysqli_query($con, "SELECT *,year(po.tanggal_penjualan_obat) as cy,sum(dpo.jumlah_detail_penjualan_obat) as sj from
       detail_penjualan_obat as dpo join penjualan_obat as po on dpo.id_penjualan_obat=po.id_penjualan_obat 
        join ketersediaan_obat as ko on dpo.id_obat=ko.id_obat join obat as o on dpo.id_obat=o.id_obat
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

    <!-- <div id="tableContainer" style="width: 100%;"> -->
        <!-- Dynamic table will be displayed here -->
    <!-- </div> -->
   

          <!-- <label for="monthInput">Select Month:</label>
<input type="date" id="monthInput" name="month" /> -->
<!-- 
          <button onclick="toggleDivs('myDiv1', 'myDiv2','myDiv3','myDiv4','myDivBtn')" class="btn btn-sm" style="background:skyblue;color:white"  id="myDivBtn" ><i class="fas fa-filter"></i></button> -->
          <!-- </div> -->
       
        <hr>
   
    
<div class="table-responsive mt-3" >
<div id="tableContainer" style="width: 100%;">
        <!-- Dynamic table will be displayed here -->
    <!-- </div> -->

          <table class="table table-bordered table-hover" id="vieObat" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->

              <tr align="center">

                <th >No</th>
                <th >Nama</th>


                <th >Jumlah</th>
                <th >Satuan</th>

                  <th >Pendapatan</th>
                  <th >Pengeluaran</th>
                <th >Profit</th>

              </tr>
              <!-- <tr align="center">
                <th colspan="6">Penjualan Obat</th>
              </tr> -->
            </thead>

            <tbody>
              <?php
              include '../connection.php';

// $currentMonth = date('n');
$currentMonth = date('n');


$monthlyQuery = "SELECT *,sum(dpo.jumlah_detail_penjualan_obat) as sj from
detail_penjualan_obat as dpo join penjualan_obat as po on dpo.id_penjualan_obat=po.id_penjualan_obat 
 join ketersediaan_obat as ko on dpo.id_obat=ko.id_obat join obat as o on dpo.id_obat=o.id_obat where month(po.tanggal_penjualan_obat)=$currentMonth group by dpo.id_obat
";

$monthlyResult = mysqli_query($con, $monthlyQuery);

              $no=1;
              while ($data = mysqli_fetch_array($monthlyResult)) {
                 ?>

              <tr>
                <td><?php echo $no++; ?></td>


                <td><?php echo $data['nama_obat']; ?></td>

                <td><?php echo $data['sj'];?></td>
                <td><?php echo $data['satuan']; ?></td>

                <td><?php echo "Rp".number_format($v1t = $data['harga_detail_penjualan_obat']*$data['sj'],'0','.','.'); ?></td>
                <td class="d-none"><?php echo $v1tx+=$v1t; ?></td>

                <td><?php echo "Rp".number_format($v2t = $data['harga_beli_obat']*$data['sj'],'0','.','.'); ?></td>
                <td class="d-none"><?php echo $v2tx+=$v2t; ?></td>

                <td><?php echo "Rp".number_format($v1t-$v2t,'0','.','.'); ?></td>

              </tr>
      


              <?php
              }
              ?>
                <tr>
             
                <td colspan="4" class="text-center font-weight-bold" style="border-bottom:1px solid">
                  Total
                </td>
                <!-- <td></td>
                <td></td>
                <td></td>
                <td></td> -->

                <td class="font-weight-bold" style="border-bottom:1px solid"><?php echo "Rp".number_format($v1tx,'0','.','.'); ?></td>

                <td class="font-weight-bold" style="border-bottom:1px solid"><?php echo "Rp".number_format($v2tx,'0','.','.'); ?></td>

                <td class="font-weight-bold" style="border-bottom:1px solid"><?php echo "Rp".number_format($v1tx-$v2tx,'0','.','.'); ?></td>

              </tr>
              <?php
              include '../connection.php';

// $currentMonth = date('n');
$currentMonths = date('n');

$monthlyQuerys = "SELECT *,sum(dpo.jumlah_detail_penjualan_alkes) as sj from
detail_penjualan_alkes as dpo join penjualan_alkes as po on dpo.id_penjualan_alkes=po.id_penjualan_alkes 
 join ketersediaan_alkes as ko on dpo.id_alkes=ko.id_alkes join alkes as o on dpo.id_alkes=o.id_alkes where month(po.tanggal_penjualan_alkes)=$currentMonths group by dpo.id_alkes
";

// $monthlyQuery = "SELECT *,sum(dpo.jumlah_detail_penjualan_alkes) as sj from
// detail_penjualan_alkes as dpo join penjualan_alkes as po on dpo.id_penjualan_alkes=po.id_penjualan_alkes 
//  join ketersediaan_alkes as ko on dpo.id_alkes=ko.id_alkes join alkes a on dpo.id_alkes=a.id_alkes where month(po.tanggal_penjualan_alkes)=$currentMonth group by dpo.id_alkes
// ";

$monthlyResults = mysqli_query($con, $monthlyQuerys);

              $no=1;
              while ($data = mysqli_fetch_array($monthlyResults)) {
                 ?>

              <tr>
                <td><?php echo $no++; ?></td>

                <td><?php echo $data['nama_alkes']; ?></td>
     

                <td><?php echo $data['sj']; ?></td>
                <td><?php echo $data['satuan']; ?></td>

                <td><?php echo "Rp".number_format($alkesv1t = $data['harga_detail_penjualan_alkes']*$data['sj'],'0','.','.'); ?></td>
                <td class="d-none"><?php echo $alkesv1tx+=$alkesv1t; ?></td>

                <td><?php echo "Rp".number_format($alkesv2t = $data['harga_beli_alkes']*$data['sj'],'0','.','.'); ?></td>
                <td class="d-none"><?php echo $alkesv2tx+=$alkesv2t; ?></td>

                <td><?php echo "Rp".number_format($alkesv1t-$alkesv2t,'0','.','.'); ?></td>

              </tr>
              <?php } ?>
              <tr>
                <td colspan="4" class="text-center font-weight-bold" style="border-bottom:1px solid">
                  Total
                </td>
                <!-- <td></td>
                <td></td>
                <td></td>
                <td></td> -->

                <td class="font-weight-bold" style="border-bottom:1px solid"><?php echo "Rp".number_format($alkesv1tx,'0','.','.'); ?></td>

                <td class="font-weight-bold" style="border-bottom:1px solid"><?php echo "Rp".number_format($alkesv2tx,'0','.','.'); ?></td>

                <td class="font-weight-bold" style="border-bottom:1px solid"><?php echo "Rp".number_format($alkesv1tx-$alkesv2tx,'0','.','.'); ?></td>

              </tr>


              <tr>
              <td colspan="4" class="text-center font-weight-bold" style="border-bottom:1px solid">
                  Grand Total
                </td>


                <td class="font-weight-bold" style="border-bottom:1px solid"><?php echo "Rp".number_format($grandtotal1=$v1tx+$alkesv1tx+$cekv1tx,'0','.','.'); ?></td>

                <td class="font-weight-bold" style="border-bottom:1px solid"><?php echo "Rp".number_format($grandtotal2=$v2tx+$alkesv2tx+$cekv2tx,'0','.','.'); ?></td>

                <td class="font-weight-bold" style="border-bottom:1px solid"><?php echo "Rp".number_format($grandtotal1-$grandtotal2,'0','.','.'); ?></td>

              </tr>

            </tbody>
          </table>
          </div>


        </div>
        </div>

        </div>
        </div>
        </div>
            </div>
            
