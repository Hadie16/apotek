<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">TTK</h6>

      </div>
      <div class="card-body">
        <a href="?page=ttk-add" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a>
        <!-- <a href="../ttk/print.php" class="btn btn-sm btn-info" target="_blank"><i class="fas fa-print"></i>
          Cetak
          FPDF</a> -->
        <a href="../ttk/print2.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a>
        <hr>

    <!-- ori -->
        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewttk" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
              <th >No</th>
              
                <th >Nama</th>
                <th >Telepon</th>
                <th >Email</th>
                <th >Alamat</th>
                <th >Status</th>
        
                <th >Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php
              include '../connection.php';
              $query = mysqli_query($con, 'SELECT * FROM ttk');
              $no=1;
              while ($data = mysqli_fetch_array($query)) { 
?>
              <tr>
              <td><?php echo $no++ ?></td>
          
                <td class="text-nowrap"><?php echo $data['nama_ttk']; ?></td>
                <td><?php echo $data['telepon_ttk']; ?></td>
                <td><?php echo $data['email_ttk']; ?></td>
                <td><?php echo $data['alamat_ttk']; ?></td>
                <td><?php echo $data['status_ttk']; ?></td>
                <!-- <td>Replace 'your_php_script.php' with the PHP script that will handle the status update -->
                <!-- <button class="btn <?php echo $data['status_ttk'] === 'Aktif' ? 'btn-success' : 'btn-danger'; ?> text-white" id="statusButton" onclick="updateStatus()">
  <?php echo ucfirst($data['status_ttk']); ?>
</button>
<script>
  // Use json_encode to convert the PHP value to a JSON string
  var id_ttk = <?php echo json_encode($data['status_ttk']); ?>;
</script> -->
<!-- </td> -->
           
                <td>
                  <a class="btn text-info" href="?page=ttk-edit&id=<?php echo $data['id_ttk']; ?>"><i
                      class="fas fa-edit"></i>
                  </a>
                  <a class="btn text-danger" href="?page=ttk-delete&id=<?php echo $data['id_ttk']; ?>"
                    onclick="return confirm('Anda yakin mau menghapus item ini ?')"><i class="fas fa-trash"></i>
                  </a>
                  <!-- <a class="btn text-success" href="../ttk/print3.php?id=<?php echo $data['id_ttk']; ?>"
                    target="_blank"><i class="fas fa-print"></i>
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