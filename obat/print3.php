<!-- <link rel="stylesheet" href="../css/sb-admin-2.min.css"> -->
<style>
* {
  font-family: Arial, Helvetica, sans-serif;
}

table {
  border-collapse: collapse;
  border-color: black;
}
</style>
<h2 align="center">Laporan Detail Obat</h2>
<div class="table-responsive mt-3">
  <table border="1" width="70%" align="center" cellpadding="8">
    <tbody>
      <?php
      $id = $_GET['id'];
      // $id = 11;
      include '../connection.php';
      $query = mysqli_query($con, "SELECT * FROM obat WHERE id_obat = $id");
      while ($data = mysqli_fetch_array($query)) { ?>
      <tr>
        <td width=25%>Kode</td>
        <td width=75%><?php echo $data['kode_obat'] ?></td>
      </tr>
      <tr>
        <td>Gambar</td>
        <td><?php echo $data['gambar_obat'] ?></td>
      </tr>
      <tr>
        <td>Nama</td>
        <td>
          <?php
            if ($data['nama_obat'] == "TI") {
              echo "Teknik Informatika";
            } else {
              echo "Sistem Informasi";
            }
            ?>
        </td>
      </tr>
      <tr>
        <td>Jenis</td>
        <td>

          <?php
            if ($data['jenis_obat'] == "L") {
              echo "Laki-laki";
            } else {
              echo "Perempuan";
            }
            ?>
        </td>
      </tr>
      <tr>
        <td>Kategori</td>
        <td><?php echo $data['kategori_obat'] ?></td>
      </tr>
      <tr>

      <?php
      }
      ?>
    </tbody>
  </table>
</div>

<script>
window.print();
</script>