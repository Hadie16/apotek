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
  </style>
</head>
<body>
  <div id="invoice">
    <h2>Apotek Mahabbah</h2>
    <p>Jalan Makam RT.006/RW.003 Pasayangan Selatan Kecamatan Martapura</p>
    <p>(0511) 5913606</p>
    <p>mahabbah.apotek@gmail.com</p>
    
  
    <?php 
       include '../connection.php';
           $id = $_GET['id'];

                    $query3 = mysqli_query($con, "SELECT * FROM penjualan_obat  WHERE id_penjualan_obat=$id ");
                 
                    while ($rowDatas = mysqli_fetch_assoc($query3)) {
                      $kode = $rowDatas['kode_penjualan_obat'];


                    }
         

      ?>
    <h3>No. Nota: <?php echo $kode ?></h3>
    <?php date_default_timezone_set('Asia/Makassar')?>
    <p>Tanggal: <?php echo date('d-m-Y h:i:s')?></p>
    <!-- <p>Due Date: [Specify the due date]</p> -->
    
    <!-- <h4>Bill To:</h4>
    <p>Customer Name</p>
    <p>Customer Address</p>
    <p>City, State, ZIP</p> -->
    
    <table>
      <thead>
        <tr>
          <th>Nama Barang</th>
          <th>Qty</th>
          <th>Harga</th>
          <th>Jumlah</th>
        </tr>
      </thead>
      <tbody>
      <?php
          //  $id = $_GET['id'];
              // include '../connection.php';
         
              // $query = mysqli_query($con, "SELECT * FROM detail_penjualan_obat  WHERE id_penjualan_obat=$id ");

              $query = mysqli_query($con,"SELECT a.*, c.nama_obat nama FROM detail_penjualan_obat a JOIN stok_obat b ON a.id_stok_obat = b.id_stok_obat JOIN obat c ON b.id_obat = c.id_obat WHERE a.id_penjualan_obat=$id");
    //  $row = mysqli_num_rows($query);

              while ($data = mysqli_fetch_array($query)) { ?>
        <tr>
                <td><?php echo $data['nama']; ?></td>
                <td class="text-nowrap"><?php echo $data['jumlah_detail_penjualan_obat']; ?></td>
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
          <td colspan="3">Total:</td>
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
    function printInvoice() {
      window.print();
    }
  </script>

  <button onclick="printInvoice()">Print Invoice</button>
</body>
</html>
