<!DOCTYPE html>
<html>
<head>
  <title>Nota</title>
  <style>
    /* Add your custom CSS styles for the invoice here */
    body {
      font-family: Arial, sans-serif;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid black;
      padding: 8px;
    }
    th {
      text-align: left;
    }
    .total-row td {
      font-weight: bold;
    }
    .footer {
      margin-top: 20px;
      text-align: right;
    }

    #invoice {
  font-family: Arial, sans-serif;
}

.header {
  display: flex;
  align-items: center;
}

.logo {
  flex: 0 0 auto;
  margin-right: 20px;
}

.logo img {
  max-width: 100px; /* Adjust the max width as needed */
  height: auto;
}

.header-text {
  flex: 1 1 auto;
}

.header h2,
.header p {
  text-align: left;
}

.header-line {
  border: none;
  border-top: 1px solid black;
  margin-top: 10px;
}


  </style>
</head>
<body>
<div id="invoice">
<div class="header">
    <div class="logo">
      <img src="../assets/img/logo_mahabbah-removebg-preview.png" alt="Logo">
    </div>
    <div class="header-text">
      <h2>Apotek Mahabbah</h2>
      <p>Jalan Makam RT.006/RW.003 Pasayangan Selatan Kecamatan Martapura</p>
      <p>(0823) 58813379</p>
    </div>
  </div>
  <hr class="header-line">
  
    <?php 
       include '../connection.php';
           $id = $_GET['id'];

                    $query3 = mysqli_query($con, "SELECT * FROM penjualan_obat WHERE id_penjualan_obat=$id ");
                 
                    while ($rowDatas = mysqli_fetch_assoc($query3)) {
                      $kode = $rowDatas['kode_penjualan_obat'];
                      $tgl = $rowDatas['tanggal_penjualan_obat'];



                    }
         

      ?>
    <h3>No. Nota: <?php echo $kode ?></h3>
    <?php date_default_timezone_set('Asia/Makassar')?>
    <!-- <p>Tanggal: <?php echo date('d-m-Y h:i:s')?></p>-->
    <p>Tanggal: <?php echo date("d-m-Y H:i:s", strtotime($tgl)) ?></p>



                  <!-- </div> -->
    <!-- <p>Due Date: [Specify the due date]</p> -->
    
    <!-- <h4>Bill To:</h4>
    <p>Customer Name</p>
    <p>Customer Address</p>
    <p>City, State, ZIP</p> -->
    
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Obat</th>
          <th>Qty</th>
          <th>Satuan</th>

          <th>Harga</th>
          <th>Sub Total</th>
        </tr>
      </thead>
      <tbody>
      <?php
          //  $id = $_GET['id'];
              // include '../connection.php';
         
              // $query = mysqli_query($con, "SELECT * FROM detail_penjualan_obat  WHERE id_penjualan_obat=$id ");

              $query = mysqli_query($con,"SELECT a.*, c.nama_obat nama FROM detail_penjualan_obat a JOIN stok_obat b ON a.id_stok_obat = b.id_stok_obat JOIN obat c ON b.id_obat = c.id_obat WHERE a.id_penjualan_obat=$id");
    //  $row = mysqli_num_rows($query);
$no=1;
              while ($data = mysqli_fetch_array($query)) { ?>
        <tr>

        <td><?php echo $no++ ?></td>

                <td><?php echo $data['nama']; ?></td>
                <td class="text-nowrap"><?php echo $data['jumlah_detail_penjualan_obat']; ?></td>
                <td class="text-nowrap"><?php echo $data['satuan']; ?></td>
                <td>
  <span style="float: left;">Rp</span>
  <span style="float: right;"><?php echo number_format($data['harga_detail_penjualan_obat'], 0, ',', '.'); ?></span>
</td>

               
                <td>
  <span style="float: left;">Rp</span>
  <span style="float: right;"><?php echo number_format($data['total_harga_detail_penjualan_obat'], 0, ',', '.'); ?></span>
</td>
              </tr>

              <?php
              }
              ?>
        <!-- Add more rows for other products -->
      </tbody>
      <?php 
                    $query2 = mysqli_query($con, "SELECT * FROM penjualan_obat  WHERE id_penjualan_obat=$id ");
                    while ($rowData = mysqli_fetch_assoc($query2)) {
                      $subtotal = $rowData['total_harga'];


                    }
                    $tax = 0;
                    $total =  $subtotal + $tax

      ?>
      <tfoot>
        <!-- <tr class="total-row">
          <td colspan="3">Subtotal:</td>
          <td>
  <span style="float: left;">Rp</span>
  <span style="float: right;"><?php echo number_format($subtotal, 0, ',', '.'); ?></span>
</td>
        </tr> -->
        <!-- <tr class="total-row">
          <td colspan="3">Tax:</td>
          <td>
  <span style="float: left;">Rp</span>
  <span style="float: right;"><?php echo number_format($tax, 0, ',', '.'); ?></span>
</td>
        </tr> -->
        <tr class="total-row">
          <td colspan="5">Total:</td>
          <td>
  <span style="float: left;">Rp</span>
  <span style="float: right;"><?php echo number_format($total, 0, ',', '.'); ?></span>
</td>
        </tr>
      </tfoot>
    </table>
    
    <div class="footer">
      <!-- <p>Payment Information:</p>
      <p>[Specify payment instructions, methods, and details]</p>
      <p>Please make the payment by the due date mentioned above.</p>
      <p>Thank you for your business!</p> -->
    </div>
  </div>

  <script>

      window.print();
    
  </script>

</body>
</html>
