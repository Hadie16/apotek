<!-- hitung  -->
<script>
  $(document).ready(function() {
  // ...
// var gt = 0;
  // Function to calculate and update the grand total
  function updateGrandTotals() {
var grandTotal = 0;
    
//  var grandTotal = gt.toLocaleString('id-ID');

    // Iterate over each row
    $('#myTablePNM tbody tr').each(function() {
      var totalAmount = parseFloat($(this).find('.total-amount-inputss').val());
      
      if (!isNaN(totalAmount)) {
        grandTotal += totalAmount;
      }
    });

   

    // Update the grand total field
    // $('#grandTotals').val(grandTotal.toFixed(0));
    $('#grandTotals').val(grandTotal);
  }

  // Event listener for quantity and unit price inputs
  // $('.qty-input, .unit-price-input').on('input', function() {
    $('#myTablePNM').on('input', '.qty-inputs, .unit-price-inputs', function() {
    var qty = parseFloat($(this).closest('tr').find('.qty-inputs').val());
    var unitPrice = parseFloat($(this).closest('tr').find('.unit-price-inputs').val());
    var totalAmount = qty * unitPrice;

    
    if (isNaN(totalAmount)) {
      totalAmount = 0;
    }

    $(this).closest('tr').find('.total-amount-inputss').val(totalAmount);
    // $('.jj').val(totalAmount.toFixed(0));

    updateGrandTotals(); // Calculate and update the grand total
  });

  // ...
});
</script>

<script>

$(document).ready(function() {


// Counter for row IDs
let rowCount = 1;

// Add row button click event
$('#addRowBtnPNM').click(function() {
  rowCount++;

  // Clone the last row
  const newRow = $('#myTablePNM tbody tr:last').clone();

  // Update the row ID and clear input values
  newRow.attr('id', 'row' + rowCount);
  newRow.find('td:first').text(rowCount);
  newRow.find('select').val('');
  newRow.find('input').val('');

  // Append the new row to the table body
  $('#myTablePNM tbody').append(newRow);

});

// Delete row button click event
$(document).on('click', '.delete-rowPNM', function() {
  $(this).closest('tr').remove();
  updateRowNumbers();
});


// On change event of the select_option dropdown
$(document).on('change', '.select-options', function() {
  var selectedOption = $(this).val();
  var currentRow = $(this).closest('tr');

  // Make AJAX request to fetch data based on selected option
  $.ajax({
    url: '../penerimaan_obat/fetch_penerimaan.php',
    type: 'POST',
    data: { id_detail_fetch_obat: selectedOption },
    dataType: 'json',
    success: function(response) {
      if (response.status === 'success') {
        // Update the fields with retrieved data
        currentRow.find('#result_id_obat').val(response.data.id_obat);
        currentRow.find('.jumlah').val(response.data.jumlah);
        currentRow.find('.satuan').val(response.data.satuan);
        currentRow.find('.valuese').val(response.data.valuese);

        // currentRow.find('.jumlah_stok_sisa').val(response.data.jumlah_stok_obat);
// response.data.satuan)
  //  $('#myTablePNM').on('input', '.jumlah','.satuan', function() 
  //  $('#myTablePNM').on('input', '.jumlah', function() 

  // {

    // var dd = currentRow.find('#result_id_obat').val();

    //   var dd = currentRow.find('.satuan').val();
      // var jj =  currentRow.find('.jumlah').val();

    //   var jumlah_stok_obat = dd - jj;

    //   if (isNaN(jj)) {

    //     jumlah_stok_obat = 0;

    //   }

      // currentRow.find('.boxjumlah').val(jj);
      
    // });

    // var currentRow = $(this).closest('tr');

var stn = currentRow.find('.satuan').val();
var lb = currentRow.find('.lb')[0]; // Use [0] to get the DOM element
var boxjumlah = currentRow.find('.boxjumlah')[0];
var boxsatuan = currentRow.find('.boxsatuan')[0];

if (stn == "Box") {
  lb.style.display = "block"; // Show the input
  boxjumlah.style.display = "block"; // Show the input
  boxsatuan.style.display = "block"; // Show the input

// currentRow.find('.boxsatuan').val('Botol');

  $('#myTablePNM').on('input','.unit-price-inputs', '.boxjumlah', function() {

var jmh = currentRow.find('.jumlah').val();
var bjmh = currentRow.find('.boxjumlah').val();
var hrg = currentRow.find('.unit-price-inputs').val();


var hargaKet = hrg/bjmh;

currentRow.find('.hargaKet').val(hargaKet);

var tjmh = bjmh*jmh;

currentRow.find('.tjmh').val(tjmh);




});
} else {
  lb.style.display = "none";  // Hide the input
  boxjumlah.style.display = "none";  // Hide the input
  boxsatuan.style.display = "none";  // Hide the input
  currentRow.find('.boxjumlah').val('')
}









      } else {
        // Clear the fields if no data found
        // currentRow.find('.jumlah_stok_obat').val('');
        currentRow.find('.harga').val('');
        // currentRow.find('.jumlah_stok_sisa').val('');
        currentRow.find('#result_id_obat').val('');
        currentRow.find('.jumlah').val('');
        currentRow.find('.satuan').val('');

        
      currentRow.find('.boxjumlah').val('');

var lb = currentRow.find('.lb')[0]; // Use [0] to get the DOM element
var boxjumlah = currentRow.find('.boxjumlah')[0];
var boxsatuan = currentRow.find('.boxsatuan')[0];


  lb.style.display = "none";  // Hide the input
  boxjumlah.style.display = "none";  // Hide the input
  boxsatuan.style.display = "none";  // Hide the input
  currentRow.find('.boxjumlah').val('')


      }
    },
    error: function(xhr, status, error) {
      console.log(error); // Handle the error if any
    }
  });
});

// Function to update the row numbers
function updateRowNumbers() {
  $('#myTablePNM tbody tr').each(function(index) {
    $(this).find('td:first').text(index + 1);
  });
}
});


</script>
<!-- satuan -->
<script>
//    $(document).ready(function() {

// // var selectedOption = $('#id_obat_select_edit').val();
// // var jso = $('#jumlah_stok_obat').val();
// //    })


//    $('#myTablePNM').on('input', '.jumlah', function() 

// {

//   var jmh =   $(this).closest('tr').find('.jumlah').val();
//   jj="";
//   if(jmh=0){
//     var jj=300;
//   }else if(jmh=100){
//       var jj=200;
//   }


//   $(this).closest('tr').find('.boxjumlah').val(jj);

//     // currentRow.find('.boxjumlah').val(jj);
    
//   });

//    })

</script>