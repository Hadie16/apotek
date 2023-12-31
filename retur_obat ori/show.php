<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
</div>

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-info">Retur Obat</h6>

      </div>
      <div class="card-body">
        <a href="?page=retur_obat-add" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a>
        <!-- <a href="../retur_obat/print.php" class="btn btn-sm btn-info" target="_blank"><i class="fas fa-print"></i>
          Cetak
          FPDF</a> -->
        <a href="../retur_obat/print2.php" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>
          Cetak</a>
        <hr>

        <div class="table-responsive mt-3" >
          <table class="table table-bordered table-hover" id="viewReturObat" style="width: 100%;">
            <thead class="bg-secondary text-white" >
              <!-- <thead> -->
              <tr align="center">
                <th >No</th>
                <th >Nama Obat</th>
              
                <th >Jumlah Retur</th>
                <th >Satuan</th>

                <th > Tanggal Retur</th>
                <th >Kode Penerimaan</th>
                <th >Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php
              include '../connection.php';
              $query = mysqli_query($con, 'SELECT a.*,b.nama_obat obats,c.kode_penerimaan_obat kode FROM retur_obat a join obat b on a.id_obat=b.id_obat join penerimaan_obat c on a.id_penerimaan_obat=c.id_penerimaan_obat');
              $no=1;
              while ($data = mysqli_fetch_array($query)) { ?>

              <tr>
                <td><?php echo $no++; ?></td>
                <td class="text-nowrap"><?php echo $data['obats']; ?></td>
          
              
                <td><?php echo $data['jumlah']; ?></td>
                <td><?php echo $data['satuan']; ?></td>

                <td><?php echo $data['tanggal_retur']; ?></td>
                <td><?php echo $data['kode']; ?></td>
                <td>
                  <a class="btn text-info" href="?page=retur_obat-edit&id=<?php echo $data['id_retur_obat']; ?>"><i
                      class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data"></i>
                  </a>
                  <a class="btn text-danger" href="?page=retur_obat-delete&id=<?php echo $data['id_retur_obat']; ?>"
                    onclick="return confirm('Anda yakin mau menghapus item ini ?')" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data"><i class="fas fa-trash"></i></a>
                  <!-- <a class="btn text-success" href="../retur_obat/print3.php?id=<?php echo $data['id_retur_obat']; ?>"
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