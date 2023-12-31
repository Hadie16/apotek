
<select name="id_stok_obat[]" id="medSelect" class="form-control select-option select-option2" required>
        <option value="">- Pilih -</option>
        <?php
          $query = mysqli_query($con, "SELECT * FROM pengadaan_obat");
        // $query = mysqli_query($con, "SELECT id_obat, nama_obat FROM obat");
        while ($row = mysqli_fetch_assoc($query)) {
            // $id_obat1 = $row['id_obat'];
            $id_stok_obat2 = $row['id_pengadaan_obat'];

            $kode = $row['kode'];
            // $idd = 2;
            echo '<option value="' . $id_stok_obat2 . '" >' . $kode . '</option>';
        }
        ?>
    </select>
<table id="detailTable">
  <thead>
    <tr>
      <th>Detail Med ID</th>
      <th>Stocks</th>
      <th>Quantity</th> <!-- New column for input field -->
    </tr>
  </thead>
  <tbody>
    <!-- Display retrieved data from detail_med_table here -->
  </tbody>
</table>
<button id="submitBtn">Submit</button>
