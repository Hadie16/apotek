
 <script>
  $(document).ready(function() {
    // On change event of the select_option dropdown
    $('#id_obat_select').on('change', function() {
      var selectedOption = $(this).val();
   
      // Make AJAX request to fetch data based on selected option
      $.ajax({
        url: '../stok_obat/fetch_stok.php', // PHP script to retrieve data from table_1
        type: 'POST',
        data: { id_ketersediaan_obat: selectedOption },
        dataType: 'json',
        success: function(response) {
          console.log(response)
          if (response.status === 'success') {
            // Update the fields with retrieved data
            $('#id_obats').val(response.data.id_obat);

            $('#jumlah_ketersediaan_obat').val(response.data.jumlah_ketersediaan_obat);
            $satuan=response.data.satuan;
            $('#jumlah_ketersediaan_obat_display').val(response.data.jumlah_ketersediaan_obat);
            $('#satuan').val(response.data.satuan);
          

            $('#harga_beli_obat').val(response.data.harga_beli_obat);
            // $('#unit').val(response.data.unit);
            $('#tanggal_kadaluarsa_obat').val(response.data.tanggal_kadaluarsa_obat);
         
      $('#jumlah_stok_obat').on('input', function() {
      var jumlah = parseInt($('#jumlah_ketersediaan_obat').val());
        var jumlah_stok_obat = parseInt($(this).val());
        var jumlah_ketersediaan_obat = jumlah - jumlah_stok_obat;

        if (jumlah_stok_obat > jumlah) {
          $('#jumlah_stok_obat').val(jumlah);
}
        if (isNaN(jumlah_ketersediaan_obat)) {

          jumlah_ketersediaan_obat = response.data.jumlah_ketersediaan_obat;
          // $('#jumlah_ketersediaan_obat').val(jumlah_ketersediaan_obat);
        }else if (jumlah_ketersediaan_obat < 0) {
    jumlah_ketersediaan_obat = 0; // Set the value to 0 if it is NaN or negative
  }

        $('#jumlah_ketersediaan_obat_display').val(jumlah_ketersediaan_obat);
      });
       

  // Limit the etalaseStocks value based on inventoryStocks
  const maxEtalaseStocks = Math.max(0, inventoryStocks); // Set a minimum of 0 to avoid negative values
  etalaseStocksInput.max = maxEtalaseStocks;

  // Calculate the new value for update_stocks
  const updateStocks = etalaseStocks - inventoryStocks;

  // Set the value of update_stocks_input, ensuring it is not negative
  updateStocksInput.value = Math.max(0, updateStocks);


          } else {
            // Clear the fields if no data found
            $('#id_obat').val('');

            $('#jumlah_ketersediaan_obat').val('');
            $('#jumlah_ketersediaan_obat_display').val('');
            $('#satuan').val('');


            $('#harga_beli_obat').val('');
            // $('#unit').val('');
            $('#tanggal_kadaluarsa_obat').val('');
          
          }
        },
        error: function(xhr, status, error) {
          console.log(error); // Handle the error if any
        }
      });
    });
  });
</script>