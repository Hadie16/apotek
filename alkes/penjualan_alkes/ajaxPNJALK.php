<script>

// update
// Attach event listener to the parent element using event delegation
$('#myTable2 tbody').on('change', '.qty-inputALK, .unit-price-input', function() {
  var rows = $(this).closest('tbody').find('tr');

  rows.each(function() {
    var qty = parseFloat($(this).find('.qty-inputALK').val());
    var unitPrice = parseFloat($(this).find('.unit-price-input').val());
    var totalAmount = qty * unitPrice;

    if (isNaN(totalAmount)) {
      totalAmount = 0;
    }

    $(this).find('.total-amount-input').val(totalAmount.toFixed(2));
    // $(this).find('.total-amount-input2').val(totalAmount.toFixed(2));

  });
 
});

</script>
<script>
  $(document).ready(function() {
  // ...

  // Function to calculate and update the grand total
  function updateGrandTotal() {
    var grandTotal = 0;

    // Iterate over each row
    $('#myTable2 tbody tr').each(function() {
      var totalAmount = parseFloat($(this).find('.total-amount-input').val());
      
      if (!isNaN(totalAmount)) {
        grandTotal += totalAmount;
      }
    });

    // Update the grand total field
    $('#grandTotal').val(grandTotal.toFixed(0));
  }

  // Event listener for quantity and unit price inputs
  // $('.qty-inputALK, .unit-price-input').on('input', function() {
    $('#myTable2').on('change', '.qty-inputALK, .unit-price-input', function() {
    var qty = parseFloat($(this).closest('tr').find('.qty-inputALK').val());
    var unitPrice = parseFloat($(this).closest('tr').find('.unit-price-input').val());
    var totalAmount = qty * unitPrice;

    
    if (isNaN(totalAmount)) {
      totalAmount = 0;
    }

    $(this).closest('tr').find('.total-amount-input').val(totalAmount.toFixed(0));
    $('.jj').val(totalAmount.toFixed(0));

    updateGrandTotal(); // Calculate and update the grand total
  });

  // ...
});

</script>
<script>


// update3
// On change event of the select_option dropdown
$(document).ready(function() {

  // Counter for row IDs
  let rowCount = 1;

  // Add row button click event
  $('#addRowBtn1').click(function() {
    rowCount++;

    // Clone the last row
    const newRow = $('#myTable2 tbody tr:last').clone();

    // Update the row ID and clear input values
    newRow.attr('id', 'row' + rowCount);
    newRow.find('td:first').text(rowCount);
    newRow.find('select').val('');
    newRow.find('input').val('');

    // newRow.attr('id', 'row' + rowCount);
    // newRow.find('td:first').text(rowCount);
    // newRow.find('.select-option').attr('id', 'selectOption' + rowCount);
    // newRow.find('.select-option').attr('class', 'select-option' + rowCount);
    // newRow.find('.select-option').val('');
    // newRow.find('input').val('');

    // Append the new row to the table body
    $('#myTable2 tbody').append(newRow);
    // $('.select-option').select2();
    // newRow.find('select').select2();
    // newRow.find('.select-option').select2();
  });

  // Delete row button click event
  $(document).on('click', '.delete-row', function() {
    $(this).closest('tr').remove();
    updateRowNumbers();
  });

  // On change event of the select_option dropdown
  $(document).on('change', '.select-optionPNJALK', function() {
    var selectedOption = $(this).val();
    var currentRow = $(this).closest('tr');

    // Make AJAX request to fetch data based on selected option
    $.ajax({
      url: '../alkes/penjualan_alkes/fetch_penjualan.php',
      type: 'POST',
      data: { id_alkes_var: selectedOption },
      dataType: 'json',
      success: function(response) {
        if (response.status === 'success') {
          // Update the fields with retrieved data
          currentRow.find('.jumlah_stok_alkesALK').val(response.data.jumlah_stok_alkes);
          currentRow.find('.harga_jual_alkes').val(response.data.harga_jual_alkes);
          currentRow.find('.jumlah_stok_sisaALK').val(response.data.jumlah_stok_alkes);
          currentRow.find('.satuan').val(response.data.satuan);

          currentRow.find('.id_alkes').val(response.data.id_alkes);


     $('#myTable2').on('input', '.qty-inputALK', function() 
    {


        var dds = parseInt(currentRow.find('.jumlah_stok_alkesALK').val());
        var jjs =  parseInt(currentRow.find('.qty-inputALK').val());

        var jumlah_stok_alkes = dds - jjs;

if(jjs > dds){
  parseInt(currentRow.find('.qty-inputALK').val(dds));
}

        if (isNaN(jumlah_stok_alkes)) {
          jumlah_stok_alkes = response.data.jumlah_stok_alkes;
         

        }else if(jumlah_stok_alkes < 0){
           jumlah_stok_alkes = 0;
        }
// var lolo=12;
        currentRow.find('.jumlah_stok_sisaALK').val(jumlah_stok_alkes);
        
      });
     


        } else {
          // Clear the fields if no data found
          currentRow.find('.jumlah_stok_alkesALK').val('');
          currentRow.find('.harga_jual_alkes').val('');
          currentRow.find('.jumlah_stok_sisaALK').val('');
          currentRow.find('.satuan').val('');

          currentRow.find('.id_alkes').val('');

       

        }
      },
      error: function(xhr, status, error) {
        console.log(error); // Handle the error if any
      }
    });
  });

  // Function to update the row numbers
  function updateRowNumbers() {
    $('#myTable2 tbody tr').each(function(index) {
      $(this).find('td:first').text(index + 1);
    });
  }
});


</script>