<?php
include '../template/headerPrint.php';
?>
    <?php

$id = $_GET['id'];

      include '../connection.php';
      $query = mysqli_query($con, "SELECT a.*,b.nama_supplier nama FROM penerimaan_obat a join supplier b on a.id_supplier=b.id_supplier where id_penerimaan_obat='$id'");
                           
$no = 1;
    
      while ($data = mysqli_fetch_array($query)) { 
                           
      $kode=   $data['kode_penerimaan_obat'];
     $faktur  =  $data['no_faktur'];
     $total_harga  =  $data['total_harga'];


      $tgl =  $data['tanggal_penerimaan_obat'];
        //  number_format($data['total_harga'],0,'.','.')
       $nama =  $data['nama'];
      
      }?>
<br>
<h2 align="center">Laporan Data Penerimaan Obat</h2>
<!-- <h2 align="center">Data Pemeriksaan</h2> -->


    <p style="margin-left: 35px;">Supplier: <?php echo $nama; ?></p>
    <p style="margin-left: 35px;">No Faktur: <?php echo $faktur; ?></p>
    <p style="margin-left: 35px;">Total Pembayaran: <?php echo "Rp".number_format($total_harga,0,'.','.'); ?></p>
    <p style="margin-left: 35px;">Tanggal Penerimaan: <?php echo $tgl; ?></p>



<div class="table-responsive mt-3">
  <table border="1" width="95%" align="center" cellpadding="8">
    <thead>
      <tr>
        <th width="5%">no</th>
        <th >Nama Obat</th>
                <th >Jumlah</th>
                <th >Satuan</th>

                <th >Tanggal Kadaluarsa</th>
                <th >Batch Number</th>


          
                <th >Harga (Rp)</th>
                <th >Total Harga (Rp)</th>



<!-- align="center" -->
        <!-- <th width="10%">Email</th>
        <th width="5%">Status</th> -->

      </tr>
    </thead>

    <tbody>
      <?php

// $keyword = $_GET['keyword'];

      include '../connection.php';
      $query = mysqli_query($con,"SELECT a.*, c.nama_obat
          FROM detail_penerimaan_obat a
          JOIN detail_pengadaan_obat b ON a.id_detail_pengadaan_obat = b.id_detail_pengadaan_obat
          JOIN obat c ON b.id_obat = c.id_obat where id_penerimaan_obat=$id");
                           
$no = 1;
    
      while ($data = mysqli_fetch_array($query)) { ?>

      <tr>
      <td><?php echo $no++ ?></td>
                        
        <!-- <td><?php echo $data['id_detail_penerimaan_obat']; ?></td> -->

        <td ><?php echo $data['nama_obat']; ?></td>
                <td><?php echo $data['jumlah_detail_penerimaan_obat']; ?></td>
                <td><?php echo $data['satuan']; ?></td>

                <td><?php echo $data['tanggal_kadaluarsa']; ?></td>
                <td><?php echo $data['batch_number']; ?></td>


                <!-- <td><?php echo $data['harga_detail_penerimaan_obat']; ?></td> -->
                <td><?php echo number_format($data['harga_detail_penerimaan_obat'], 0, '.', '.'); ?></td>


                <!-- <td><?php echo $data['total_harga_detail_penerimaan_obat']; ?></td> -->
                <td><?php echo number_format($data['sub_total'], 0, '.', '.'); ?></td>

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