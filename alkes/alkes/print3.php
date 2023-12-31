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
<h2 align="center">Laporan Detail Alkes</h2>
<div class="table-responsive mt-3">
  <table border="1" width="70%" align="center" cellpadding="8">
    <tbody>
      <?php
      $id = $_GET['id'];
      // $id = 11;
      include '../connection.php';
      $query = mysqli_query($con, "SELECT * FROM alkes WHERE id_alkes = $id");
      while ($data = mysqli_fetch_array($query)) { ?>
  
      <tr>
        <td>Nama</td>
        <td><?php echo $data['nama_alkes'] ?></td>
      </tr>
      <tr>
        <td>Gambar</td>
        <td>
          <?php
            if ($data['jurusan'] == "TI") {
              echo "Teknik Informatika";
            } else {
              echo "Sistem Informasi";
            }
            ?>
        </td>
      </tr>
      <tr>
        <td>Kategori</td>
        <td>

          <?php
            if ($data['jenis_kelamin'] == "L") {
              echo "Laki-laki";
            } else {
              echo "Perempuan";
            }
            ?>
        </td>
      </tr>
      <tr>
        <td>Jenis</td>
        <td><?php echo $data['jenis_alkes'] ?></td>
      </tr>
      <tr>
        <td>Kelas</td>
        <td><?php echo $data['kelas_alkes'] ?></td>
      </tr>
   



      <!-- <tr>

        <td align="center"><?php echo $data['nim']; ?></td>
        <td><?php echo $data['nama']; ?></td>
        <td align="center"><?php echo $data['jurusan']; ?></td>
        <td align="center"><?php echo $data['jenis_kelamin']; ?></td>
        <td><?php echo $data['alamat']; ?></td>
        <td align="center"><?php echo $data['telepon']; ?></td>
        <td><?php echo $data['email']; ?></td>
      </tr> -->
      <?php
      }
      ?>
    </tbody>
  </table>
</div>

<script>
window.print();
</script>