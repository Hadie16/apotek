<script>

// update
// Attach event listener to the parent element using event delegation
$('#myTable1 tbody').on('input', '.qty-input, .unit-price-input', function() {
  var rows = $(this).closest('tbody').find('tr');

  rows.each(function() {
    var qty = parseFloat($(this).find('.qty-input').val());
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
    $('#myTable1 tbody tr').each(function() {
      var totalAmount = parseFloat($(this).find('.total-amount-input').val());
      
      if (!isNaN(totalAmount)) {
        grandTotal += totalAmount;
      }
    });

    // Update the grand total field
    $('#grandTotal').val(grandTotal.toFixed(0));
  }

  // Event listener for quantity and unit price inputs
  // $('.qty-input, .unit-price-input').on('input', function() {
    $('#myTable1').on('input', '.qty-input, .unit-price-input', function() {
    var qty = parseFloat($(this).closest('tr').find('.qty-input').val());
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
    const newRow = $('#myTable1 tbody tr:last').clone();

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
    $('#myTable1 tbody').append(newRow);
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
  $(document).on('change', '.select-option', function() {
    var selectedOption = $(this).val();
    var currentRow = $(this).closest('tr');

    // Make AJAX request to fetch data based on selected option
    $.ajax({
      url: '../penjualan_obat/fetch_penjualan.php',
      type: 'POST',
      data: { id_stok_obat: selectedOption },
      dataType: 'json',
      success: function(response) {
        if (response.status === 'success') {
          // Update the fields with retrieved data
          currentRow.find('.jumlah_stok_obat').val(response.data.jumlah_stok_obat);
          currentRow.find('.harga_jual_obat').val(response.data.harga_jual_obat);
          currentRow.find('.jumlah_stok_sisa').val(response.data.jumlah_stok_obat);
          currentRow.find('.satuan').val(response.data.satuan);

          currentRow.find('.id_obat').val(response.data.id_obat);


     $('#myTable1').on('input', '.jumlah_detail_penjualan_obat','.jumlah_stok_obat', function() 
    {


        var dd = currentRow.find('.jumlah_stok_obat').val();
        var jj =  currentRow.find('.jumlah_detail_penjualan_obat').val();

        var jumlah_stok_obat = dd - jj;

// if(jj > dd){
//   currentRow.find('.jumlah_detail_penjualan_obat').val(dd);
// }

        if (isNaN(jumlah_stok_obat)) {
          jumlah_stok_obat = response.data.jumlah_stok_obat;
         

        }else if(jumlah_stok_obat < 0){
           jumlah_stok_obat = 0;
        }

        currentRow.find('.jumlah_stok_sisa').val(jumlah_stok_obat);
        
      });
     


        } else {
          // Clear the fields if no data found
          currentRow.find('.jumlah_stok_obat').val('');
          currentRow.find('.harga_jual_obat').val('');
          currentRow.find('.jumlah_stok_sisa').val('');
          currentRow.find('.satuan').val('');

          currentRow.find('.id_obat').val('');

       

        }
      },
      error: function(xhr, status, error) {
        console.log(error); // Handle the error if any
      }
    });
  });

  // Function to update the row numbers
  function updateRowNumbers() {
    $('#myTable1 tbody tr').each(function(index) {
      $(this).find('td:first').text(index + 1);
    });
  }
});


</script>