<?php
include '../connection.php';
$id = $_GET['id'];
$result = mysqli_query($con, "SELECT a.*, b.*,c.* FROM cek_kesehatan a JOIN pasien b ON a.id_pasien = b.id_pasien join detailcek_kesehatan c on a.id_cek_kesehatan=c.id_cek_kesehatan WHERE a.id_cek_kesehatan = $id");

// Check if there are rows in the result
if (mysqli_num_rows($result) > 0) {
  // Fetch the first row
  $data = mysqli_fetch_assoc($result);
  
  // Assuming $birthDate contains the birth date in "Y-m-d" format
  $birthDate = $data['tanggal_lahir'];

  // Create a DateTime object for the birth date
  $birthDateTime = new DateTime($birthDate);

  // Create a DateTime object for the current date (today)
  $currentDateTime = new DateTime();

  // Calculate the difference between the current date and the birth date
  $dateInterval = $currentDateTime->diff($birthDateTime);

  // Get the difference in years from the date interval
  $age = $dateInterval->y;

  // Output the calculated age
  // echo "Age: " . $age . " years";
  $data['nama_pasien'];
  
  $data['jenis_kelamin'];
  $data['tanggal_cek_kesehatan']; 

} else {
  // Handle the case when no data is found
  echo "No data found.";
}
?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>Kartu Hasil Pemeriksaan</title>
  </head>
  <body>
    <h2>Data Pemeriksaan</h2>
    <p>Nama: <?php echo $data['nama_pasien']; ?></p>
    <p>Umur: <?php echo $age; ?></p>
    <p>Jenis Kelamin: <?php echo $data['jenis_kelamin']; ?></p>
    <p>Tanggal Periksa: <?php echo $data['tanggal_cek_kesehatan']; ?></p>





  <table border="1" cellspacing="0" cellpadding="5">
    <thead>
      <tr>
        <th>No</th>
        <th>Pemeriksaan</th>
        <th>Hasil</th>
        <th>Normal</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Asam urat</td>
        <td>5.6</td>
        <td>3.5 - 7.2</td>
      </tr>
      <tr>
        <td>2</td>
        <td>Gula darah</td>
        <td>110</td>
        <td>70 - 140</td>
      </tr>
      <tr>
        <td>3</td>
        <td>Kolesterol</td>
        <td>180</td>
        <td>150 - 200</td>
      </tr>
      <tr>
        <td>4</td>
        <td>Hemoglobin</td>
        <td>13.5</td>
        <td>12 - 16</td>
      </tr>
    </tbody>
  </table>

  <script>
    function printData() {
      // Open a new window for printing
      const printWindow = window.open('', '_blank', 'width=800,height=600');

      // Set the content to be printed
      printWindow.document.write(`
        <html>
        <head>
          <title>Data Pemeriksaan</title>
          <style>
            body { font-family: Arial, sans-serif; }
            table { border-collapse: collapse; width: 100%; }
            th, td { border: 1px solid black; padding: 5px; }
          </style>
        </head>
        <body>
          <h2>Data Pemeriksaan</h2>
          <p>Nama: John Doe</p>
          <p>Umur: 30 tahun</p>
          <p>Jenis Kelamin: Laki-laki</p>
          <p>Tanggal Periksa: 2023-07-21</p>
          
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Pemeriksaan</th>
                <th>Hasil</th>
                <th>Normal</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Asam urat</td>
                <td>5.6</td>
                <td>3.5 - 7.2</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Gula darah</td>
                <td>110</td>
                <td>70 - 140</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Kolesterol</td>
                <td>180</td>
                <td>150 - 200</td>
              </tr>
              <tr>
                <td>4</td>
                <td>Hemoglobin</td>
                <td>13.5</td>
                <td>12 - 16</td>
              </tr>
            </tbody>
          </table>
        </body>
        </html>
      `);

      // Close the document for writing, so it triggers the print dialog
      printWindow.document.close();

      // Print the content
      printWindow.print();
    }
  </script>

  <button onclick="printData()">Print</button>
</body>
</html>
