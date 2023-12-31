

<script>
    (function () {
$(document).ready(function() {



  function updateDeleteButtonState() {
    var rowCounttest = $('#myTableRETS tbody tr').length;
    if (rowCounttest === 1) {
      $('#myTableRETS tbody tr button.delete-rowRET').prop('disabled', true);
    } else {
      $('#myTableRETS tbody tr button.delete-rowRET').prop('disabled', false);
    }
  }
  updateDeleteButtonState();


// Counter for row IDs
let rowCount = 1;

// Add row button click event
$('#addRowBtnRET').click(function() {
  // Find the last row number or start from 1 if there are no rows
  const lastRow = $('#myTableRETS tbody tr:last');
  let rowCount = lastRow.length ? parseInt(lastRow.find('td:first').text()) : 0;

  // Increment the row count for the new row
  rowCount++;

  // Clone the last row or create a new row if the table is empty
  const newRow = lastRow.length ? lastRow.clone() : $('<tr></tr>');

  // Update the row ID and clear input values
  newRow.attr('id', 'row' + rowCount);
  newRow.find('td:first').text(rowCount);
  newRow.find('select').val('');
  newRow.find('input').val('');

  newRow.find('.id_detailRO').val(0);

  // Append the new row to the table body
  $('#myTableRETS tbody').append(newRow);
  updateDeleteButtonState();
});


// Delete row button click event
$(document).on('click', '.delete-rowRET', function() {
  $(this).closest('tr').remove();
  updateRowNumbers();
  updateDeleteButtonState();

});


// On change event of the select_option dropdown
$(document).on('change', '.select-option-retur', function() {
  var selectedOption = $(this).val();
  var currentRow = $(this).closest('tr');



  // Make AJAX request to fetch data based on selected option
  $.ajax({
    url: '../alkes/retur_alkes/fetch_retur.php',
    type: 'POST',
    data: { id_alkes: selectedOption },
    dataType: 'json',
    success: function(response) {
      if (response.status === 'success') {

        data_stocks="";
        data_satuan="";
        data_stocks_var="";
        if(response.data.box == 0){
         hh= currentRow.find('.jumlahALK').val();
       data_stocks_var = parseInt(response.data.jumlah_ketersediaan_alkes);
      if(hh!==''){
        hh = parseInt(hh);
        data_stocks = data_stocks_var + hh;
      }else{
        data_stocks = data_stocks_var;
      }
      //  data_stocks=data_stocks_tambah;

       data_satuan = response.data.satuan;
        }else{
          hh= currentRow.find('.jumlahALK').val();
          if(hh!==''){
            hh = parseInt(hh);
            data_stocks_var =  parseInt(response.data.box);
       data_stocks= data_stocks_var + hh;
          }else{

          data_stocks_var =  parseInt(response.data.box);
       data_stocks= data_stocks_var;
          // data_stocks=data_stocks_tambah;
        }
          data_satuan = "box";
        }
        // Update the fields with retrieved data
        currentRow.find('.id_ketersediaan_alkes').val(response.data.id_ketersediaan_alkes);
        // currentRow.find('.jumlahALK').val(0);
        currentRow.find('.id_alkes').val(response.data.id_alkes);

        currentRow.find('.jumlah_stok_sisa_hitung').val(data_stocks);
        currentRow.find('.jumlah_stok_sisa').val(data_stocks_var);
        currentRow.find('.satuanALK').val(data_satuan);
        currentRow.find('.harga_beli_alkes').val(response.data.harga_beli_alkes);
        currentRow.find('.BNRetur_retur').val(response.data.batch_number);


        currentRow.find('.tanggal_exps').val(response.data.tanggal_kadaluarsa_alkes);

 


$('#myTableRETS').on('input', '.jumlahALK',function() 
    {


        var dd = parseInt(currentRow.find('.jumlah_stok_sisa_hitung').val());
        var jj =  parseInt(currentRow.find('.jumlahALK').val());

  


        // var dd_tambah = dd + jj;
        // var dd_tambah = 5;
    //     console.log("dd: " + dd);
    // console.log("jj: " + jj);

        var jumlah_ketersediaan_alkes = dd - jj;

if(jj > dd){
  currentRow.find('.jumlahALK').val(dd);
}

        if (isNaN(jumlah_ketersediaan_alkes)) {
          jumlah_ketersediaan_alkes = data_stocks;
         

        }else if(jumlah_ketersediaan_alkes < 0){
           jumlah_ketersediaan_alkes = 0;
        }

        currentRow.find('.jumlah_stok_sisa').val(jumlah_ketersediaan_alkes);
        
      });









      } else {
        // Clear the fields if no data found
        // currentRow.find('.jumlah_stok_alkes').val('');
        currentRow.find('.harga').val('');
        // currentRow.find('.jumlah_stok_sisa').val('');
        currentRow.find('#result_id_alkes').val('');
        currentRow.find('.jumlahALK').val('');
        currentRow.find('.satuanALK').val('');

        
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

    // Trigger change event for pre-selected item(s)
    $('[data-trigger="change"]').trigger('change');


// Function to update the row numbers
function updateRowNumbers() {
  $('#myTableRETS tbody tr').each(function(index) {
    $(this).find('td:first').text(index + 1);
  });
}
});

})();

</script>

<!-- <script>
$(document).on('change', '.select-option-retur', function() {
  var selectedCountry = $(this).val();
  var currentRow = $(this).closest('tr');
  var cityDropdown = currentRow.find('.BNRetur_retur');

  console.log("Selected Country:", selectedCountry);
  console.log("City Dropdown Length:", cityDropdown.length);

  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      const cities = JSON.parse(xhr.responseText);

      console.log("Cities:", cities);

      cityDropdown.html("");

      cities.forEach(city => {
        const option = document.createElement("option");
        option.value = city;
        option.text = city;
        cityDropdown.append(option);
      });
    }
  };

  xhr.open("GET", `../retur_alkes/fetch_BNRetur.php?country=${selectedCountry}`, true);
  xhr.send();
});




</script> -->