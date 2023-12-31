<!-- <link rel="stylesheet" href="../css/sb-admin-2.min.css"> -->
<style>
* {
  font-family: Arial, Helvetica, sans-serif;
}

table {
  border-collapse: collapse;
  border-color: black;
}
h2 {
    margin-top: 5px;
    margin-bottom: 5px;
  }
  h3 {
    margin-top: 5px;
    margin-bottom: 5px;
  }
  p {
    margin-top: 5px;
    margin-bottom: 5px;
  }
</style>
<div  > <img style=" position: relative; top: 0px; left:110px;width:120px; height:150px" src="../img/kalsel.png"></div>
<div  style=" position: relative; bottom: 140px;">
<h3 align="center">PEMERINTAH PROVINSI KALIMANTAN SELATAN</h3>
<h2 align="center">DINAS KEHUTANAN</h2>

<h2 align="center">BALAI PERBENIHAN TANAMAN HUTAN</h2>
<p align="center"> Jalan Pangeran Suriansyah No. 22 Banjarbaru Kode Pos 70711 Telepon / Faximile (0511) 5913606</p>
<p align="center"> Email : kalsel.bpth@gmail.com Website : www.dishut.kalselprov.go.id</p>
<hr style="border: none; border-top: 3px solid black; font-weight: bold;">
<br>
<h2 align="center">Laporan Detail Permintaan Bibit Gratis</h2>
<div class="table-responsive mt-3">
  <table border="1" width="70%" align="center" cellpadding="8">
    <tbody>
      <?php
      $id = $_GET['id'];
      // $id = 11;
      include '../connection.php';
    //   $query = mysqli_query($con, "SELECT * FROM permintaanbg WHERE id_permintaanbg = $id");
      $query = mysqli_query($con, "SELECT * , c.id_pemohon,c.nama_pemohon nama2 , 
      -- wilayah_2022.kode,
      -- w1.nama dnama,
      w1.nama as nama_1,
      w2.nama as nama_2,
      w3.nama as nama_3 
      FROM permintaanbg  inner join pemohon c on permintaanbg.id_pemohon=c.id_pemohon  
      inner join wilayah_2022 as w1 on permintaanbg.kab=w1.kode  
      inner join wilayah_2022 as w2 on permintaanbg.kec=w2.kode   
      inner join wilayah_2022 as w3 on permintaanbg.kel=w3.kode
      where id_permintaanbg = $id");

      while ($data = mysqli_fetch_array($query)) { ?>
      <tr>
        <td width=25%>Nama Lengkap</td>
        <td width=75%><?php echo $data['nama2'] ?></td>
      </tr>
      <tr>
        <td>Lokasi Penanaman</td>
        <td>Ds. <?php echo $data['nama_3'] ?><br>Kec. <?php echo $data['nama_2'] ?><br> <?php echo $data['nama_1'] ?> </td>

      </tr>
      <tr>
        <td>Koordinat</td>
        <td><?php echo $data['latitude'] ?> lat,  <?php echo $data['longitude'] ?> lng</td>

      </tr>
      <tr>
        <td>Nama Bibit</td>
        <td><?php echo $data['id_bibit'] ?></td>

      </tr>
      <tr>
        <td>Jumlah (Bibit)</td>
        <td><?php echo $data['jumlah'] ?></td>
      </tr>
      <tr>
        <td>Tanggal Permintaan</td>
        <td><?php echo $data['tgl'] ?></td>
      </tr>
      <tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>

<div align="center" style="position: relative; top: 50px; left: 500px;">
  <p>Banjarbaru, <?php $date = date("d F Y"); // get current date in desired format
$date = str_replace(
    array('January', 'February', 'March', 'April', 'May', 'June', 
          'July', 'August', 'September', 'October', 'November', 'December'),
    array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
          'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'),
    $date); // replace month name in English with Indonesian
echo $date; // output the date
?><p>
  <br>
<p> KEPALA BALAI,</p>
<br>
<br>

<br>

<strong><p style="text-decoration: underline; text-decoration-skip-ink: none;">YUDITA NURDIANA, S.E, M.Si.</p></strong>
<p > NIP. 19800624 200904 2 002</p>


</div>
</div>
<script>
window.print();
</script>