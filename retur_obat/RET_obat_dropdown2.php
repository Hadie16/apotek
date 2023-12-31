

<script>

$(document).ready(function() {


// Counter for row IDs
let rowCount = 1;

// Add row button click event
$('#addRowBtnRET').click(function() {
  rowCount++;

  // Clone the last row
  const newRow = $('#myTableRET tbody tr:last').clone();

  // Update the row ID and clear input values
  newRow.attr('id', 'row' + rowCount);
  newRow.find('td:first').text(rowCount);
  newRow.find('select').val('');
  newRow.find('input').val('');

  // Append the new row to the table body
  $('#myTableRET tbody').append(newRow);

});

// Delete row button click event
$(document).on('click', '.delete-rowRET', function() {
  $(this).closest('tr').remove();
  updateRowNumbers();
});


// On change event of the select_option dropdown
$(document).on('change', '.select-option-retur', function() {
  var selectedOption = $(this).val();
  var currentRow = $(this).closest('tr');

  // Make AJAX request to fetch data based on selected option
  $.ajax({
    url: '../retur_obat/fetch_retur.php',
    type: 'POST',
    data: { id_obat: selectedOption },
    dataType: 'json',
    success: function(response) {
      if (response.status === 'success') {
        // Update the fields with retrieved data
        currentRow.find('#result_id_obat').val(response.data.id_obat);
        currentRow.find('.jumlah_stok_sisa_hitung').val(response.data.jumlah_ketersediaan_obat);
        currentRow.find('.jumlah_stok_sisa').val(response.data.jumlah_ketersediaan_obat);
        currentRow.find('.satuan').val(response.data.satuan);
        currentRow.find('.tanggal_exps').val(response.data.tanggal_kadaluarsa_obat);

 


$('#myTableRET').on('input', '.jumlah',function() 
    {


        var dd = parseInt(currentRow.find('.jumlah_stok_sisa_hitung').val());
        var jj =  parseInt(currentRow.find('.jumlah').val());

        var jumlah_ketersediaan_obat = dd - jj;

if(jj > dd){
  currentRow.find('.jumlah').val(dd);
}

        if (isNaN(jumlah_ketersediaan_obat)) {
          jumlah_ketersediaan_obat = response.data.jumlah_ketersediaan_obat;
         

        }else if(jumlah_ketersediaan_obat < 0){
           jumlah_ketersediaan_obat = 0;
        }

        currentRow.find('.jumlah_stok_sisa').val(jumlah_ketersediaan_obat);
        
      });









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
  $('#myTableRET tbody tr').each(function(index) {
    $(this).find('td:first').text(index + 1);
  });
}
});


</script>

<script>
  // const countryDropdown = document.getElementById("select-option-retur");
// const cityDropdown = document.getElementById("BNRetur");
// var currentRow = $(this).closest('tr');

$(document).on('change', '.select-option-retur', function() {
  var selectedCountry = $(this).val();
  // var cityDropdown = $('.BNRetur').val();
// const cityDropdown = document.getElementById("BNRetur");




// currentRow.find('.tanggal_exps').val(response.data.tanggal_kadaluarsa_obat);
// var countryDropdown = currentRow.find('.select-option-retur')[0];


// Event listener for the country dropdown
// countryDropdown.addEventListener("change", function() {
  // const selectedCountry = countryDropdown.value;
  var currentRow = $(this).closest('tr');
  var cityDropdown = currentRow.find('.BNRetur')[0];

  // cityDropdown.addEventListener("change", function() {
  // Make an AJAX request to a PHP script to fetch city data based on the selected country
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      const cities = JSON.parse(xhr.responseText);
      
      // Clear existing options
      // cityDropdown.innerHTML = "";
    currentRow.find('.BNRetur').html("");


      // const option1 = document.createElement("option");
      // option1.value = 0;
      //   option1.text = "-Pilih-";
      // cityDropdown.appendChild(option1);
      // Create and append new option elements for cities
      cities.forEach(city => {
        const option = document.createElement("option");
        option.value = city;
        option.text = city;
        // cityDropdown.appendChild(option);
        currentRow.find('.BNRetur').append(option);
      });
    }
  };
  
  xhr.open("GET", `../retur_obat/fetch_BNRetur.php?country=${selectedCountry}`, true);
  xhr.send();
});

//    $(document).ready(function() {

// // var selectedOption = $('#id_obat_select_edit').val();
// // var jso = $('#jumlah_stok_obat').val();
// //    })


//    $('#myTableRET').on('input', '.jumlah', function() 

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