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
        <a href="../stok_obat/print.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a>
          <button onclick="toggleDiv('myDivStok1', 'myDivStok2','myDivStok3','myDivStok4','toggleDivs','startDateSO','endDateSO')" id="toggleDivs" class="btn btn-sm" style="background:skyblue;color:white"   data-bs-toggle="tooltip" data-bs-placement="top" title="Filter"><i class="fas fa-filter"></i></button>
          <!-- <div> -->
          </div>


          <div class="row">   
     <div class="col-5" style="display: none;" id="myDivStok1">
      <input type="date" id="startDateSO" name="min" class="form-control" >
      <input type="hidden" data-page="SO">


</div>
<div class="col-1" style="display: none;" id="myDivStok4">
<label for="endDateStok" class="col-form-label">To</label>
</div> 
      <div class="col-5" style="display: none;" id="myDivStok2">
<input type="date" id="endDateSO" name="max" class="form-control">
</div>
<div class="col-1" style="display: none;" id="myDivStok3">
<!-- <input type="hidden" id="displayDateSO" readonly> -->
<button id="filterButtonSO" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Hasil Filter"><i class="fas fa-print"></i></button>
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
                <th >Nama Obat</th>
                <th > Jumlah Stok Obat</th>
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
              // $query = mysqli_query($con, 'SELECT a.*,b.nama_obat obats from stok_obat a join obat b on a.id_obat=b.id_obat ');
              
              // $query = mysqli_query($con, 'SELECT a.*,b.nama_obat obats,(select tanggal_kadaluarsa from stok_obat WHERE jumlah_stok_obat > 0 AND tanggal_kadaluarsa >= CURDATE() ORDER BY tanggal_kadaluarsa DESC LIMIT 1) as tanggal_kadaluarsa_obat from stok_obat a join obat b on a.id_obat=b.id_obat');


    //           $query = mysqli_query($con, 'SELECT
    // a.*,
    // b.nama_obat AS obats, (SELECT sum(jumlah_stok_obat) as j FROM stok_obat dso WHERE dso.id_obat = a.id_obat AND dso.jumlah_stok_obat > 0) AS jumlah_stok_obat,
    // (SELECT tanggal_kadaluarsa FROM stok_obat dso WHERE dso.id_obat = a.id_obat AND dso.jumlah_stok_obat > 0 AND dso.tanggal_kadaluarsa >= CURDATE() ORDER BY dso.tanggal_kadaluarsa DESC LIMIT 1) AS tanggal_kadaluarsa_obat
    // FROM stok_obat a
    // JOIN obat b ON a.id_obat = b.id_obat');

    // $query = mysqli_query($con, 'SELECT * stok_obat group ')

    $query = mysqli_query($con, 'SELECT a.*, sum(a.jumlah_stok_obat) as jumlah_stok_obat,

     (SELECT sum(jumlah_stok_obat) FROM stok_obat dsos WHERE dsos.id_obat = a.id_obat AND dsos.jumlah_stok_obat > 0 AND dsos.tanggal_kadaluarsa_obat >= CURDATE() ORDER BY dsos.tanggal_kadaluarsa_obat ASC LIMIT 1) AS jumlah_stok_obats,

    (SELECT tanggal_kadaluarsa_obat FROM stok_obat dso WHERE dso.id_obat = a.id_obat AND dso.jumlah_stok_obat > 0 AND dso.tanggal_kadaluarsa_obat >= CURDATE() ORDER BY dso.tanggal_kadaluarsa_obat ASC LIMIT 1) AS tanggal_kadaluarsa_obatss,b.nama_obat obats, MAX(a.tanggal_kadaluarsa_obat) as max FROM stok_obat a join obat b on a.id_obat=b.id_obat where tanggal_kadaluarsa_obat >= CURDATE() group by id_obat ');

            
//   if ($c) {
//     echo "<p>query berhasil<p/>";
   
// } else {
//     die('invalid Query : ' . mysqli_error($con));
// }

              // where tanggal_kadaluarsa_obat > NOW()

              // $query = mysqli_query($con, 'SELECT a.*,b.nama_obat obats ,c.tanggal_kadaluarsa tgl from stok_obat a join obat b on a.id_obat=b.id_obat join stok_obat c on a.id_stok_obat=c.id_stok_obat ');
              // $row = mysqli_fetch_assoc($query2);
              // $query = mysqli_query($con, 'SELECT a.*, b.nama_obat AS obats, MIN(c.tanggal_kadaluarsa) AS tgl 
              // FROM stok_obat a 
              // JOIN obat b ON a.id_obat = b.id_obat 
              // JOIN stok_obat c ON a.id_stok_obat = c.id_stok_obat
              // WHERE a.jumlah_stok_obat != 0
              // GROUP BY a.id_stok_obat');

              // $query = mysqli_query($con, 'SELECT a.*, b.nama_obat AS obats, MIN(c.tanggal_kadaluarsa) AS tgl 
              // FROM stok_obat a 
              // JOIN obat b ON a.id_obat = b.id_obat 
              // JOIN (
              //   SELECT id_stok_obat, MIN(tanggal_kadaluarsa) AS tanggal_kadaluarsa
              //   FROM stok_obat
              //   WHERE jumlah_stok_obat != 0
              //   GROUP BY id_stok_obat
              // ) c ON a.id_stok_obat = c.id_stok_obat');


            $no = 1;
        
              while ($data = mysqli_fetch_array($query)) { 

                if(($expirationDate = $data['tanggal_kadaluarsa_obatss'])==""){
                  $expirationDate=$data['max'];}else{
                    $expirationDate= $data['tanggal_kadaluarsa_obatss'];
                  }   
                
                  if($d = $data['jumlah_stok_obats']==0 or ""){
                    $d='0';}else{
                      $d= $data['jumlah_stok_obats'];
                    }   

                $id = $data['id_stok_obat'];

        
                ?>

              <tr>
              
          <td> <?php echo $no++?></td>
                <td class="text-nowrap"><?php echo $data['obats']; ?></td>
                <!-- <td><?php echo $data['jumlah_stok_obats']; ?></td> -->
                <td><?php echo $d; ?></td>

                <td><?php echo $data['satuan']; ?></td>

             
                <td><?php echo number_format($data['harga_jual_obat'], 0, '.', '.'); ?></td>

                <td><?php echo $data['tanggal_kadaluarsa_obatss']; ?></td>
        <!-- <td><?php if($data['tanggal_kadaluarsa_obatss']==""){
echo $data['max'];}else{
  echo $data['tanggal_kadaluarsa_obatss'];
} ?></td> -->
               

              
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
                <a class="btn text-primary" href="?page=stok_obat-detail&id=<?php echo $data['id_obat']; ?>"
                   data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Data"><i class="fas fa-eye"></i>
                  </a>
                  <!-- <a class="btn text-info" href="?page=stok_obat-edit&id=<?php echo $data['id_obat']; ?>"><i
                      class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data"></i>
                  </a> -->
                  <a class="btn text-danger" href="?page=stok_obat-delete&id=<?php echo $data['id_obat']; ?>"
                    onclick="return confirm('Anda yakin mau menghapus item ini ?')" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data"><i class="fas fa-trash"></i>
                  </a>
                  <!-- <a class="btn text-success" href="../stok_obat/print3.php?id=<?php echo $data['id_obat']; ?>"
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