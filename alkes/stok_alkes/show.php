<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Stok Alkes</h6>

      </div>
      <div class="card-body">
      <div class="row">
      <div class="col-sm-4">

        <a href="?page=stok_alkes-add" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a>
        <a href="../alkes/stok_alkes/print.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a>
          <button onclick="toggleDiv('myDivStok1', 'myDivStok2','myDivStok3','myDivStok4','toggleDivs')" id="toggleDivs" class="btn btn-sm" style="background:skyblue;color:white"   data-bs-toggle="tooltip" data-bs-placement="top" title="Filter"><i class="fas fa-filter"></i></button>
          <!-- <div> -->
          </div>


          <div class="row">   
     <div class="col-5" style="display: none;" id="myDivStok1">
      <input type="date" id="startDateSO" name="min" class="form-control" >
      <input type="hidden" data-page="SOALK">


    
</div>
<div class="col-1" style="display: none;" id="myDivStok4">
<label for="endDateStok" class="col-form-label">To</label>
</div> 
      <div class="col-5" style="display: none;" id="myDivStok2">
<input type="date" id="endDateSO" name="max" class="form-control">
</div>
<div class="col-1" style="display: none;" id="myDivStok3">
<button id="filterButtonSOALK" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Hasil Filter"><i class="fas fa-print"></i></button>
</div>       
</div>


        <hr>

    <!-- ori -->
        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewSO" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
                <th >No</th>
                <th >Nama Alkes</th>
                <th > Jumlah Stok Alkes</th>
                <th > Satuan</th>

                <th > Harga Jual (Rp)</th>

                             <th >Tanggal Kedaluwarsa</th>

                <th >Expired</th>

                <!-- <th >Aksi</th> -->
                <th >Aksi</th>

              </tr>
            </thead>

            <tbody>
              <?php
              // $currentDate = date("Y-m-d H:i:s"); // Get the current date and time
              // echo $currentDate;                 // Print the current date and time
              
              include '../connection.php';
              // $query = mysqli_query($con, 'SELECT a.*,b.nama_alkes alkess from stok_alkes a join alkes b on a.id_alkes=b.id_alkes ');
              
              // $query = mysqli_query($con, 'SELECT a.*,b.nama_alkes alkess,(select tanggal_kadaluarsa from stok_alkes WHERE jumlah_stok_alkes > 0 AND tanggal_kadaluarsa >= CURDATE() ORDER BY tanggal_kadaluarsa DESC LIMIT 1) as tanggal_kadaluarsa_alkes from stok_alkes a join alkes b on a.id_alkes=b.id_alkes');


    //           $query = mysqli_query($con, 'SELECT
    // a.*,
    // b.nama_alkes AS alkess, (SELECT sum(jumlah_stok_alkes) as j FROM stok_alkes dso WHERE dso.id_alkes = a.id_alkes AND dso.jumlah_stok_alkes > 0) AS jumlah_stok_alkes,
    // (SELECT tanggal_kadaluarsa FROM stok_alkes dso WHERE dso.id_alkes = a.id_alkes AND dso.jumlah_stok_alkes > 0 AND dso.tanggal_kadaluarsa >= CURDATE() ORDER BY dso.tanggal_kadaluarsa DESC LIMIT 1) AS tanggal_kadaluarsa_alkes
    // FROM stok_alkes a
    // JOIN alkes b ON a.id_alkes = b.id_alkes');

    // $query = mysqli_query($con, 'SELECT * stok_alkes group ')

    $query = mysqli_query($con, 'SELECT a.*, sum(a.jumlah_stok_alkes) as jumlah_stok_alkes,(SELECT tanggal_kadaluarsa_alkes FROM stok_alkes dso WHERE dso.id_alkes = a.id_alkes AND dso.jumlah_stok_alkes > 0 AND dso.tanggal_kadaluarsa_alkes >= CURDATE() ORDER BY dso.tanggal_kadaluarsa_alkes ASC LIMIT 1) AS tanggal_kadaluarsa_alkesss,b.nama_alkes alkess FROM stok_alkes a join alkes b on a.id_alkes=b.id_alkes group by id_alkes ');

            
//   if ($c) {
//     echo "<p>query berhasil<p/>";
   
// } else {
//     die('invalid Query : ' . mysqli_error($con));
// }

              // where tanggal_kadaluarsa_alkes > NOW()

              // $query = mysqli_query($con, 'SELECT a.*,b.nama_alkes alkess ,c.tanggal_kadaluarsa tgl from stok_alkes a join alkes b on a.id_alkes=b.id_alkes join stok_alkes c on a.id_stok_alkes=c.id_stok_alkes ');
              // $row = mysqli_fetch_assoc($query2);
              // $query = mysqli_query($con, 'SELECT a.*, b.nama_alkes AS alkess, MIN(c.tanggal_kadaluarsa) AS tgl 
              // FROM stok_alkes a 
              // JOIN alkes b ON a.id_alkes = b.id_alkes 
              // JOIN stok_alkes c ON a.id_stok_alkes = c.id_stok_alkes
              // WHERE a.jumlah_stok_alkes != 0
              // GROUP BY a.id_stok_alkes');

              // $query = mysqli_query($con, 'SELECT a.*, b.nama_alkes AS alkess, MIN(c.tanggal_kadaluarsa) AS tgl 
              // FROM stok_alkes a 
              // JOIN alkes b ON a.id_alkes = b.id_alkes 
              // JOIN (
              //   SELECT id_stok_alkes, MIN(tanggal_kadaluarsa) AS tanggal_kadaluarsa
              //   FROM stok_alkes
              //   WHERE jumlah_stok_alkes != 0
              //   GROUP BY id_stok_alkes
              // ) c ON a.id_stok_alkes = c.id_stok_alkes');


            $no = 1;
        
              while ($data = mysqli_fetch_array($query)) { 

                if($expirationDate = $data['tanggal_kadaluarsa_alkesss']==""){
                  $expirationDate='2023-01-01';}else{
                    $expirationDate= $data['tanggal_kadaluarsa_alkesss'];
                  }   
                
                $id = $data['id_stok_alkes'];

        
                ?>

              <tr>
              
          <td> <?php echo $no++?></td>
                <td ><?php echo $data['alkess']; ?></td>
                <td><?php echo $data['jumlah_stok_alkes']; ?></td>
                <td><?php echo $data['satuan']; ?></td>

             
                <td><?php echo number_format($data['harga_jual_alkes'], 0, '.', '.'); ?></td>

                <td><?php if($data['tanggal_kadaluarsa_alkesss']==""){
echo '2023-01-01';}else{
  echo $data['tanggal_kadaluarsa_alkesss'];
} ?></td>
               

              
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
      countdownElement.style.color = 'gray';

    } else {
      countdownElement.style.backgroundColor = 'green';
    }
  }

  updateCountdown_<?php echo $id; ?>();
  var countdownInterval_<?php echo $id; ?> = setInterval(updateCountdown_<?php echo $id; ?>, 1000);
</script>
<!-- <td><?php echo date('m-d-Y', strtotime($data['tanggal_kadaluarsa'])); ?></td> -->

                <td>
                <a class="btn text-primary" href="?page=stok_alkes-detail&id=<?php echo $data['id_alkes']; ?>"
                   data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Data"><i class="fas fa-eye"></i>
                  </a>
                  <!-- <a class="btn text-info" href="?page=stok_alkes-edit&id=<?php echo $data['id_alkes']; ?>"><i
                      class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data"></i>
                  </a> -->
                  <a class="btn text-danger" href="?page=stok_alkes-delete&id=<?php echo $data['id_alkes']; ?>"
                    onclick="return confirm('Anda yakin mau menghapus item ini ?')" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data"><i class="fas fa-trash"></i>
                  </a>
                  <!-- <a class="btn text-success" href="../stok_alkes/print3.php?id=<?php echo $data['id_alkes']; ?>"
                    target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Data"><i class="fas fa-print"></i>
                  </a> -->

               

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