<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Ketersediaan Obat Masuk</h6>

      </div>
      <!-- <div class="row"> -->

      <div class="card-body">
      <div class="row">
      <div class="col-sm-4">

        <!-- <div>   -->
        <!-- <a href="?page=detail_ketersediaan_obat-add" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a> -->
        <!-- <a href="../detail_ketersediaan_obat/print.php" class="btn btn-sm btn-info" target="_blank"><i class="fas fa-print"></i>
          Cetak
          FPDF</a> -->
        <a href="../detail_ketersediaan_obat/print.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a>
          <button onclick="toggleDivs('myDiv1', 'myDiv2','myDiv3','myDiv4','myDivBtn')" class="btn btn-sm" style="background:skyblue;color:white"  id="myDivBtn" ><i class="fas fa-filter"></i></button>
          <!-- <button onclick="toggleDiv()" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-filter"></i></button> -->
          <!-- <div class="row mb-3"> -->
          <!-- </div> -->
          </div>
          <!-- </div> -->


          <div class="row">   
   
            <!-- <label for="harga_jual_obat" class="col-form-label">From</label> -->
            <div class="col-5" style="display: none;" id="myDiv1">
            <!-- <label for="harga_jual_obat" class="col-form-label">From</label> -->
               <input type="date" id="startDateKobatMasuk" name="min" class="form-control" >
  </div>
  <div class="col-1" style="display: none;" id="myDiv4">
  <label for="endDateKobatMasuk" class="col-form-label">To</label>
  </div> 
  <!-- <label for="harga_jual_obat" class="form-label">To</label> -->
               <div class="col-5" style="display: none;" id="myDiv2">
      <input type="date" id="endDateKobatMasuk" name="max" class="form-control">
  </div>
  <div class="col-1" style="display: none;" id="myDiv3">
  <button id="filterButtonKobatMasuk" class="btn btn-warning" ><i class="fas fa-print"></i></button>
  </div>       
  </div>
        <hr>
<!-- <script>window.addEventListener('scroll', function() {
  var navbar = document.querySelector('.navbar');
  var threshold = 100; // Set your desired scroll threshold here

  if (window.scrollY > threshold) {
    navbar.classList.add('sticky');
  } else {
    navbar.classList.remove('sticky');
  }
});
</script> -->


<!-- chat gpt -->
<!-- <div class="table-responsive mt-3" style="height: 400px; overflow-y: scroll;">
  <table class="table table-bordered table-hover" id="viewdetail_ketersediaan_obat" style="width: 100%;">
    <thead style="position: sticky; top: 0;"> -->
    <!-- ori -->
        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewKetersediaanObatMasuk" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
                <th >No</th>
                <th >Nama</th>            
                <th >Jumlah</th>
                <th >Unit</th>
                <th >Harga Beli (Rp)</th>
                <th >Total Harga Beli (Rp)</th>

             
                <th >Tanggal Kedaluwarsa</th>
                <th >Expired Dalam (Hari)</th>
                <th >Tanggal Masuk</th>
           

                <th >Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php
          //error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

              include '../connection.php';
              
              $query = mysqli_query($con, 'SELECT a.*,b.nama_obat obats FROM detail_ketersediaan_obat a join obat b on a.id_obat=b.id_obat');
         $no = 1;
        //  $obatSums = array(); // Array to store the summed values for each "id_obat"

              while ($data = mysqli_fetch_array($query)) { 

                $expirationDate = $data['tanggal_kadaluarsa'];
                $id = $data['id_detail_ketersediaan_obat'];

                ?>

              <tr>
                <td><?php echo $no++?></td>
           
                <td class="text-nowrap"><?php echo $data['obats']; ?></td>
           
                <td><?php echo $data['jumlah_obat_masuk']; ?></td>

                <td><?php echo $data['unit']; ?></td>
                <td><?php echo number_format($data['harga_beli_obat'], 0, '.', '.'); ?></td>
                <td><?php echo number_format($data['total_harga_beli_obat'], 0, '.', '.'); ?></td>

                <td><?php echo $expirationDate ?></td>
   <!-- Display the countdown element for each row -->
<td>
  <p style="color: white" align="center" id="countdown_<?php echo $id; ?>"></p>
</td>

<td><?php echo $data['tanggal_masuk_obat']; ?></td>

<!-- Include the JavaScript code -->
<script>
  var expirationDate_<?php echo $id; ?> = new Date("<?php echo $expirationDate; ?>");

  function updateCountdown_<?php echo $id; ?>() {
    var currentDate = new Date();
    var remainingTime = expirationDate_<?php echo $id; ?> - currentDate;
    var remainingDays = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
    var countdownElement = document.getElementById('countdown_<?php echo $id; ?>');
    countdownElement.textContent = remainingDays + ' Hari ';

    if (remainingDays <= 0) {
      countdownElement.style.backgroundColor = 'black';
      countdownElement.textContent = 'Expired';
      clearInterval(countdownInterval_<?php echo $id; ?>);
    } else if (remainingDays <= 10) {
      countdownElement.style.backgroundColor = 'red';
    } else if (remainingDays <= 100) {
      countdownElement.style.backgroundColor = 'yellow';
      countdownElement.style.color = 'gray';

    } else {
      countdownElement.style.backgroundColor = 'green';
    }
  }

  updateCountdown_<?php echo $id; ?>();
  var countdownInterval_<?php echo $id; ?> = setInterval(updateCountdown_<?php echo $id; ?>, 1000);
</script>



                <!-- <td> -->
                  <!-- <a class="btn text-info" href="?page=detail_ketersediaan_obat-edit&id=<?php echo $data['id_detail_ketersediaan_obat']; ?>"><i class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data"></i></a>

                  <a class="btn text-danger" href="?page=detail_ketersediaan_obat-delete&id=<?php echo $data['id_detail_ketersediaan_obat']; ?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data"><i class="fas fa-trash"></i></a>
                
                  <a class="btn text-success" href="../detail_ketersediaan_obat/print3.php?id=<?php echo $data['id_detail_ketersediaan_obat']; ?>"target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Data"><i class="fas fa-print"></i>
                  </a> -->

                  <!-- <button class="btn btn-primary btn-expand">Expand</button> -->
                <!-- </td> -->
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