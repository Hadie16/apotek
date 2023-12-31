<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Stok Obat</h6>

      </div>
      <div class="card-body">
      <div class="row">
      <div class="col-sm-4">

        <a href="?page=stok_obat-add" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a>
        <a href="../stok_obat/print2.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a>
          <button onclick="toggleDivStoks('myDivStok1', 'myDivStok2','myDivStok3','myDivStok4','toggleDivs')" id="toggleDivs" class="btn btn-sm" style="background:skyblue;color:white"   data-bs-toggle="tooltip" data-bs-placement="top" title="Filter"><i class="fas fa-filter"></i></button>
          <!-- <div> -->
          </div>


          <div class="row">   
     <div class="col-5" style="display: none;" id="myDivStok1">
      <input type="date" id="startDateStok" name="min" class="form-control" >
</div>
<div class="col-1" style="display: none;" id="myDivStok4">
<label for="endDateStok" class="col-form-label">To</label>
</div> 
      <div class="col-5" style="display: none;" id="myDivStok2">
<input type="date" id="endDateStok" name="max" class="form-control">
</div>
<div class="col-1" style="display: none;" id="myDivStok3">
<button id="filterButtonStok" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Hasil Filter"><i class="fas fa-print"></i></button>
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
  <table class="table table-bordered table-hover" id="viewstok_obat" style="width: 100%;">
    <thead style="position: sticky; top: 0;"> -->
    <!-- <table cellspacing="5" cellpadding="5" border="0">
        <tbody><tr>
            <td>Minimum date:</td>
            <td><input type="date" id="startDate" class="datepicker" name="min"></td>
          

        </tr>
        <tr>
            <td>Maximum date:</td>
            <td><input type="date" id="endDates" name="max"></td>
        </tr>
    </tbody></table> -->
    <!-- <input type="text" id="datepicker" class="datepicker"> -->
    <!-- ori -->
        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewStokObat" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
                <!-- <th >NIM</th> -->
                <th >Nama</th>
                <th > Jumlah Obat</th>
                <th >Unit</th>

                <th >Harga Beli (Rp)</th>
                <th >Harga Jual (Rp)</th>
                <!-- <th >Unit</th> -->
                <!-- <th > Tanggal Kadaluarsa</th> -->
                <th >Expired</th>

                <!-- <th >Aksi</th> -->
                <th >Aksi</th>

              </tr>
            </thead>

            <tbody>
              <?php
              include '../connection.php';
              $query = mysqli_query($con, 'SELECT a.*,b.*,b.tanggal_kadaluarsa tgl,c.id_obat,c.nama_obat obat FROM ketersediaan_obat a inner join stok_obat b on a.id_ketersediaan_obat=b.id_ketersediaan_obat inner join obat c on a.id_obat=c.id_obat');
              while ($data = mysqli_fetch_array($query)) { 
                $expirationDate = $data['tanggal_kadaluarsa'];
                $id = $data['id_stok_obat'];
                ?>

              <tr>
              
              <!-- <td><?php echo $data['id_ketersediaan_obat']; ?></td> -->
                <td class="text-nowrap"><?php echo $data['obat']; ?></td>
                <td><?php echo $data['jumlah_ketersediaan_obat']; ?></td>
                <td><?php echo $data['unit']; ?></td>
                <td><?php echo number_format($data['harga_beli_obat'], 0, '.', '.'); ?></td>

                <!-- <td><?php echo $data['harga_ketersediaan_obat']; ?></td> -->
               
                <td><?php echo number_format($data['harga_jual_obat'], 0, '.', '.'); ?></td>

                <!-- <td><?php echo $data['harga_jual_obat']; ?></td> -->
               

              
                 <!-- Display the countdown element for each row -->
<td>
  <p style="color: white" align="center" id="countdown_<?php echo $id; ?>"></p>
</td>

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
    } else {
      countdownElement.style.backgroundColor = 'green';
    }
  }

  updateCountdown_<?php echo $id; ?>();
  var countdownInterval_<?php echo $id; ?> = setInterval(updateCountdown_<?php echo $id; ?>, 1000);
</script>
<!-- <td><?php echo date('m-d-Y', strtotime($data['tanggal_kadaluarsa'])); ?></td> -->

                <td>
                  <a class="btn text-info" href="?page=stok_obat-edit&id=<?php echo $data['id']; ?>"><i
                      class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data"></i>
                  </a>
                  <a class="btn text-danger" href="?page=stok_obat-delete&id=<?php echo $data['id']; ?>"
                    onclick="return confirm('Anda yakin mau menghapus item ini ?')" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data"><i class="fas fa-trash"></i>
                  </a>
                  <a class="btn text-success" href="../stok_obat/print3.php?id=<?php echo $data['id']; ?>"
                    target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Data"><i class="fas fa-print"></i>
                  </a>
                </td>
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