
 <script>
  $(document).ready(function() {
    // On change event of the select_option dropdown
    $('#id_alkes_select').on('change', function() {
      var selectedOption = $(this).val();
   
      // Make AJAX request to fetch data based on selected option
      $.ajax({
        url: '../alkes/stok_alkes/fetch_stok.php', // PHP script to retrieve data from table_1
        type: 'POST',
        data: { id_ketersediaan_alkes: selectedOption },
        dataType: 'json',
        success: function(response) {
          console.log(response)
          if (response.status === 'success') {
            // Update the fields with retrieved data
            $('#id_alkess').val(response.data.id_alkes);

            $('#jumlah_ketersediaan_alkes').val(response.data.jumlah_ketersediaan_alkes);
            $satuan=response.data.satuan;
            $('#jumlah_ketersediaan_alkes_display').val(response.data.jumlah_ketersediaan_alkes);
            $('#satuan').val(response.data.satuan);
          

            $('#harga_beli_alkes').val(response.data.harga_beli_alkes);
            // $('#unit').val(response.data.unit);
            $('#tanggal_kadaluarsa_alkes').val(response.data.tanggal_kadaluarsa_alkes);
         
      $('#jumlah_stok_alkes').on('input', function() {
      var jumlah = parseInt($('#jumlah_ketersediaan_alkes').val());
        var jumlah_stok_alkes = parseInt($(this).val());
        var jumlah_ketersediaan_alkes = jumlah - jumlah_stok_alkes;

        if (jumlah_stok_alkes > jumlah) {
          $('#jumlah_stok_alkes').val(jumlah);
}
        if (isNaN(jumlah_ketersediaan_alkes)) {

          jumlah_ketersediaan_alkes = response.data.jumlah_ketersediaan_alkes;
          // $('#jumlah_ketersediaan_alkes').val(jumlah_ketersediaan_alkes);
        }else if (jumlah_ketersediaan_alkes < 0) {
    jumlah_ketersediaan_alkes = 0; // Set the value to 0 if it is NaN or negative
  }

        $('#jumlah_ketersediaan_alkes_display').val(jumlah_ketersediaan_alkes);
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
            $('#id_alkes').val('');

            $('#jumlah_ketersediaan_alkes').val('');
            $('#jumlah_ketersediaan_alkes_display').val('');
            $('#satuan').val('');


            $('#harga_beli_alkes').val('');
            // $('#unit').val('');
            $('#tanggal_kadaluarsa_alkes').val('');
          
          }
        },
        error: function(xhr, status, error) {
          console.log(error); // Handle the error if any
        }
      });
    });
  });
</script>