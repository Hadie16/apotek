<script>
  (function($) { // Start of IIFE
    $(document).ready(function() {
      $(document).on('change', '.BNRetur_retur', function() {
        var selectedOption = $(this).val();
        var currentRow = $(this).closest('tr');

        // Make AJAX request to fetch data based on selected option
        $.ajax({
          url: '../retur_obat/fetch_retur.php',
          type: 'POST',
          data: { batch_number: selectedOption },
          dataType: 'json',
          success: function(response) {
            if (response.status === 'success') {
              // Update the fields with retrieved data
              currentRow.find('.tanggal_exps').val(response.data.tanggal_kadaluarsa_obat);
            //  currentRow.find('.tanggal_exps').val(response.data.tanggal_kadaluarsa_obat);

            } else {
              currentRow.find('.tanggal_exps').val('');
            }
          },
          error: function(xhr, status, error) {
            console.log(error); // Handle the error if any
          }
        });
      });
    });
  })(jQuery); // End of IIFE
</script>
