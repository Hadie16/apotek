<script>
$(document).on('change', '#BNRetur', function() {
  var selectedOption = $(this).val();
  var currentRow = $(this).closest('tr');

  // Make AJAX request to fetch data based on selected option
  $.ajax({
    url: '../retur_alkes/fetch_retur.php',
    type: 'POST',
    data: { id_alkes: selectedOption },
    dataType: 'json',
    success: function(response) {
      if (response.status === 'success') {
        // Update the fields with retrieved data
        currentRow.find('#result_id_alkes').val(response.data.id_alkes);
      } 
    }
  })
});
</script>

<!-- versi 2 -->

<!-- // Function to populate the input based on the selected option
function populateInput(selectedOption, currentRow) {
  // Make AJAX request to fetch data based on selected option
  $.ajax({
    url: '../retur_alkes/fetch_retur.php',
    type: 'POST',
    data: { id_alkes: selectedOption },
    dataType: 'json',
    success: function(response) {
      if (response.status === 'success') {
        // Update the fields with retrieved data
        currentRow.find('#result_id_alkes').val(response.data.id_alkes);
      } 
    }
  });
}

// Trigger the logic when the page loads
$(document).ready(function() {
  // Get the initially selected value of #BNRetur
  var selectedOption = $('#BNRetur').val();
  var currentRow = $('#BNRetur').closest('tr');
  
  // Call the function to populate the input with the initial value
  populateInput(selectedOption, currentRow);
});

// Event handler for the change event of #BNRetur
$(document).on('change', '#BNRetur', function() {
  var selectedOption = $(this).val();
  var currentRow = $(this).closest('tr');

  // Call the function to populate the input when the dropdown changes
  populateInput(selectedOption, currentRow);
}); -->
