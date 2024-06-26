</div>
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; APOTEK MAHABBAH 2023</span>
    </div>
    
  </div>
</footer>
</div>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Logout dari aplikasi?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
      </div>
      <div class="modal-body">
        Pilih "Logout" untuk melanjutkan keluar dari aplikasi.
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">
          Cancel
        </button>
        <a class="btn btn-info" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <script>
// load animation


        // Function to show the loading animation
        function showLoadingAnimation() {
          document.getElementById("overlay").style.display = "block";
            document.getElementById("loadingContainer").style.display = "block";
        }
        showLoadingAnimation();
        // Function to hide the loading animation
        function hideLoadingAnimation() {
          document.getElementById("overlay").style.display = "none";
            document.getElementById("loadingContainer").style.display = "none";
        }

// hideLoadingAnimation();
        // Simulate a delay and then hide the loading animation
        setTimeout(hideLoadingAnimation, 1000); // Change 3000 to the desired delay in milliseconds

    </script>
    
<!-- all script js -->
<?php include 'js.php'; ?>

<script src="../vendor/chart.js/Chart.min.js"></script>

<?php include 'testpie.php'; ?>

<?php include 'testcharts.php'; ?>

<?php include 'testbar.php'; ?>


<script src="../js/dataTablesCode.js"></script>
<script src="../js/tooltipCode.js"></script>



<script>



</script>

<!-- penerimaan modal-->
<script>




 $(document).ready(function() {
  // Handle button click event
  $('#openModalButton').click(function() {
    var id = $(this).data('id');
    // console.log(id);
    $('#myModalPenerimaan').modal('show'); // Show the modal
  
    
    // Pass the ID to the modal
    $('#myModal').find('#idInput').val(id);
  });

  // Handle form submission
  $('#inputForms').submit(function(e) {
    e.preventDefault(); // Prevent the default form submission

    // Get the input value and the ID
    var inputValue = $(this).find('#inputValue').val();
    var id = $(this).find('#idInput').val();

    // Make AJAX request to update.php
    $.ajax({
      url: '../history/update.php', // Replace with the URL of your server-side script
      method: 'POST',
      data: { id: id, value: inputValue },
      success: function(response) {
        // Handle the response from the server
        console.log(response);
        // Refresh the table or perform any other necessary actions
      },
      error: function(xhr, status, error) {
        // Handle the error
        console.log(error);
      }
    });

    // Close the modal
    $('#myModalPenerimaan').modal('hide');
    location.reload();
  });
});


</script>

<script>
$(document).ready(function() {
  // Get the current URL and extract the page parameter value
  var urlParams = new URLSearchParams(window.location.search);
  var currentPage = urlParams.get('page');

  // Check if the current page exists in the sidebar
  if (currentPage) {
    // Add the "active" class to the appropriate elements
    $('.nav-item a[href="?page=' + currentPage + '"]').addClass('active');
    $('.nav-item a[href="?page=' + currentPage + '"]').parents('.nav-item').addClass('active');

    // Expand the parent collapse element
    $('.nav-item a[href="?page=' + currentPage + '"]').parents('.collapse').addClass('show');

    // Scroll to the active item
    var activeItem = $('.nav-item a[href="?page=' + currentPage + '"]');
    if (activeItem.length > 0) {
      var sidebar = $('#accordionSidebar');
      var scrollTop = activeItem.offset().top - sidebar.offset().top + sidebar.scrollTop() - (sidebar.height() / 2);
      sidebar.animate({ scrollTop: scrollTop }, 'slow');
    }
  }
});

</script>

<script>
  function resetDataTablesFilter(dataTableInstance) {
  dataTableInstance.search('').draw();
}

function toggleDiv(div1Id, div2Id, div3Id,div4Id, divBtnId, clearInput1,clearInput2) {
  var div1 = document.getElementById(div1Id);
  var div2 = document.getElementById(div2Id);
  var div3 = document.getElementById(div3Id);
  var div4 = document.getElementById(div4Id);
  var divBtn = document.getElementById(divBtnId);
  var clear1 = document.getElementById(clearInput1);
  var clear2 = document.getElementById(clearInput2);




  if (div1.style.display === "none") {
    div1.style.display = "block";
    div2.style.display = "block";
    div3.style.display = "block";
    div4.style.display = "block";
    divBtn.style.backgroundColor = "gray";
    divBtn.style.borderColor = "skyblue";

  // Apply filtering based on new dates
  // applyFilter(originalStartDate, originalEndDate);

  } else {
    div1.style.display = "none";
    div2.style.display = "none";
    div3.style.display = "none";
    div4.style.display = "none";
    divBtn.style.backgroundColor = "skyblue";
    clear1.value = "0000-00-00";
    clear2.value = "0000-00-00";
    // table.draw();
  
    



  }
}
// function applyFilter(startDate, endDate) {
//   // Apply your DataTables filtering logic here using startDate and endDate
// }

</script>




<!-- Modal javascript -->
<script>

 $(document).ready(function() {
  // Handle button click event
  $('.input-data-btn').click(function() {
    var id = $(this).data('id');

    $('#myModal').find('#idInput').val(id);
    // console.log(id);
    // $('#myModal').modal('show'); // Show the modal
    $.ajax({
        type: 'POST',
        url: '../cek_kesehatan/set_id.php', // Replace with the actual URL of your PHP script to set the session variable
        data: { id: id },
        success: function(response) {
          // Show the modal after setting the session variable
          $('#myModal').modal('show');
        },
        error: function(xhr, status, error) {
          // Handle AJAX error if needed
          console.error(error);
        }
      });
  
  });

  

  // Handle form submission
  $('#inputForm').submit(function(e) {
    e.preventDefault(); // Prevent the default form submission

    // Get the input value and the ID
    var inputValue = $(this).find('#inputValue').val();
    var inputValue2 = $(this).find('#inputValue2').val();
    var inputValue3 = $(this).find('#inputValue3').val();

    var id = $(this).find('#idInput').val();

    // Make AJAX request to update.php
    $.ajax({
      url: '../cek_kesehatan/update.php', // Replace with the URL of your server-side script
      method: 'POST',
      // data: { id: id, value: inputValue, value2: inputValue2 ,value3: inputValue3  },
      data: {
  id: id,
  value: inputValue !== '' ? inputValue : 0,
  value2: inputValue2 !== '' ? inputValue2 : 0,
  value3: inputValue3 !== '' ? inputValue3 : 0
},

      success: function(response) {
        // Handle the response from the server
        console.log(response);
        // Refresh the table or perform any other necessary actions
      },
      error: function(xhr, status, error) {
        // Handle the error
        console.log(error);
      }
    });

    // Close the modal
    $('#myModal').modal('hide');
    location.reload();
  });
});


</script>


<!-- code untuk checkbox-->
<!-- penampil checkbox-->
<script>
  //cek gula darah
$(document).ready(function() {
  $('#checklist').change(function() {
    if ($(this).is(':checked')) {
      var div = document.getElementById('catatan');
    div.style.display = 'block';
      $.ajax({
        url: '../cek_kesehatan/get_biaya.php',  // Replace with the actual URL of your PHP script
        method: 'GET',  // or 'POST' depending on your server-side code
        data: { id_kategori: 1 },  // Pass any required parameters to the PHP script
        success: function(response) {
          var data = JSON.parse(response);
          var price = data.biaya_kategori;
          var id = data.id_kategori;
          
          $('#targetField').val(price.toLocaleString('id-ID'));
          $('#targetFieldID').val(id);
        },
        error: function(xhr, status, error) {
          console.log('AJAX Error:', error);
        }
      });
    } else {
      var div = document.getElementById('catatan');
    div.style.display = 'none';
      $('#targetField').val('');
      $('#targetFieldID').val('');
    }
  });
});
//cek asam urat
$(document).ready(function() {
  $('#checklist2').change(function() {
    if ($(this).is(':checked')) {
      $.ajax({
        url: '../cek_kesehatan/get_biaya.php',  // Replace with the actual URL of your PHP script
        method: 'GET',  // or 'POST' depending on your server-side code
        data: { id_kategori: 2 },  // Pass any required parameters to the PHP script
        success: function(response) {
          var data = JSON.parse(response);
          var price = data.biaya_kategori;
          var id = data.id_kategori;
          
          $('#targetField2').val(price.toLocaleString('id-ID'));
          $('#targetFieldID2').val(id);
        },
        error: function(xhr, status, error) {
          console.log('AJAX Error:', error);
        }
      });
    } else {
      $('#targetField2').val('');
      $('#targetFieldID2').val('');
    }
  });
});
//cek kolesterol
$(document).ready(function() {
  $('#checklist3').change(function() {
    if ($(this).is(':checked')) {
      $.ajax({
        url: '../cek_kesehatan/get_biaya.php',  // Replace with the actual URL of your PHP script
        method: 'GET',  // or 'POST' depending on your server-side code
        data: { id_kategori: 3 },  // Pass any required parameters to the PHP script
        success: function(response) {
          var data = JSON.parse(response);
          var price = data.biaya_kategori;
          var id = data.id_kategori;
          // var formattedPrice = price.toLocaleString('id-ID', { minimumFractionDigits: 0 });
          // $('#targetField3').val(formattedPrice);

          $('#targetField3').val(price.toLocaleString('id-ID'));
          $('#targetFieldID3').val(id);
        },
        error: function(xhr, status, error) {
          console.log('AJAX Error:', error);
        }
      });
    } else {
      $('#targetField3').val('');
      $('#targetFieldID3').val('');
    }
  });
});

</script>


<script>

//update
// perhitungan checkbox
$(document).ready(function() {
  // Initialize the sum variable
  var sum = 0;

  // Function to update the sum
  function updateSum() {
    // var total = sum.toLocaleString('id-ID');
    var total = sum;

    $('#sumField').val(total);
    $('#sumFieldDisplay').val(number_format(total),0,',','.');

  }

  // Event handler for checkbox 1
  $('#checklist').change(function() {
    if ($(this).is(':checked')) {
      sum += 10000;
    } else {
      sum -= 10000;
    }

    // Update the sum field
    updateSum();
  });

  // Event handler for checkbox 2
  $('#checklist2').change(function() {
    if ($(this).is(':checked')) {
      sum += 10000;
    } else {
      sum -= 10000;
    }

    // Update the sum field
    updateSum();
  });

  // Event handler for checkbox 3
  $('#checklist3').change(function() {
    if ($(this).is(':checked')) {
      sum += 20000;
    } else {
      sum -= 20000;
    }

    // Update the sum field
    updateSum();
  });
});


</script>


<!-- ajax stok-->
 <?php  include '../stok_obat/ajaxStok.php'; ?>
 <?php  include '../stok_obat/ajaxStokEdit.php'; ?>
 <?php  include '../alkes/stok_alkes/ajaxStok.php'; ?>
 <?php  include '../alkes/stok_alkes/ajaxStokEditALK.php'; ?>


<!-- ajax retur-->
<?php  include '../retur_obat/ajaxRetur.php'; ?>
<!-- <?php  include '../alkes/retur_alkes/ajaxReturALK.php'; ?> -->

<!--  include '../retur_obat/ajaxBNRetur.php'; ?>-->

 <!-- <?php  include '../retur_obat/ajaxReturEdit.php'; ?> -->
 <!-- <?php  include '../alkes/retur_alkes/ajaxretur.php'; ?>
 <?php  include '../alkes/retur_alkes/ajaxreturEditALK.php'; ?> -->

<!-- 
<?php include '../alkes/stok_alkes/stok_alkes_dropdown.php'; ?>

<?php include '../alkes/penjualan_alkes/penjualan_alkes_dropdown.php'; ?> 
<?php include '../alkes/pengadaan_alkes/pengadaan_alkes_dropdown.php'; ?>
<?php include '../alkes/penerimaan_alkes/penerimaan_alkes_dropdown.php'; ?>-->


<!-- hitungan jual -->




<?php include '../penjualan_obat/ajaxPNJ.php'?>
<?php include '../alkes/penjualan_alkes/ajaxPNJALK.php'?>





<script>
//===================== not used ===============

$(document).ready(function() {
  // Handle change event of the first select
  $('#first_select').change(function() {
    var selectedValue = $(this).val();

    // Make an AJAX request to fetch the options for the second select
    $.ajax({
      url: '../penerimaan_obat/fetch_option.php', // Replace with the actual URL that retrieves options from the database
      method: 'POST',
      data: { selectedValue: selectedValue },
      dataType: 'json',
      success: function(response) {
        // Clear previous options in the second select
        $('#second_select').empty();

        // Add the new options to the second select
        $.each(response.data, function(index, item) {
          var option = $('<option>', {
            value: item.value,
            text: item.text
          });
          $('#second_select').append(option);
        });
      },
      error: function(xhr, status, error) {
        console.log(error); // Handle the error if any
      }
    });
  });
});


</script>

<!-- Script to trigger the modal when the page loads -->
<!-- modal stok obat edit -->
<script>
  $(document).ready(function(){
    $('#exampleModalsss').modal('show');
  });
</script>






<!-- penerimaan-------------------------------------- -->

<?php include '../penerimaan_obat/PNM_obat_dropdown.php'; ?>

<?php include '../alkes/penerimaan_alkes/PNM_alkes_dropdown.php'; ?>


<!-- retur-------------------------------------- -->
<?php include '../retur_obat/RET_obat_dropdown.php'; ?>
<?php include '../alkes/retur_alkes/RET_alkes_dropdown.php'; ?>


<!-- include '../alkes/penerimaan_alkes/PNM_alkes_dropdown.php';  -->


<!-- pengadaan-------------------------------------- -->
<script>

$(document).ready(function() {


// Counter for row IDs
let rowCount = 1;

// Add row button click event
$('#addRowBtnPGD').click(function() {
  rowCount++;

  // Clone the last row
  const newRow = $('#myTablePGD tbody tr:last').clone();

  // Update the row ID and clear input values
  newRow.attr('id', 'row' + rowCount);
  newRow.find('td:first').text(rowCount);
  newRow.find('select').val('');
  newRow.find('input').val('');

  // Append the new row to the table body
  $('#myTablePGD tbody').append(newRow);

});

// Delete row button click event
$(document).on('click', '.delete-rowPGD', function() {
  $(this).closest('tr').remove();
  updateRowNumbers();
});

// Function to update the row numbers
function updateRowNumbers() {
  $('#myTablePGD tbody tr').each(function(index) {
    $(this).find('td:first').text(index + 1);
  });
}
});


</script>



<!-- <?php include '../alkes/pengadaan_alkes/pengadaan_alkes_dropdown.php'; ?> -->


<script>
  //content mid view
  document.addEventListener("DOMContentLoaded", function() {
    var targetSection = document.getElementById("myTable");
    targetSection.scrollIntoView({ behavior: "smooth", block: "center" });
  });
</script>


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


<!-- switch filter -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const firstButton = document.getElementById("obatBtn");
    const secondButton = document.getElementById("alkesBtn");
    const hiddenInput = document.getElementById("switchInput");

    firstButton.addEventListener("click", function () {
        firstButton.classList.add("active");
        secondButton.classList.remove("active");
        hiddenInput.value = "obatBtn";

        firstButton.classList.add("btn-warning");
        firstButton.classList.remove("btn-secondary");

        secondButton.classList.add("btn-secondary");
        secondButton.classList.remove("btn-warning");

        

        // firstButton.style.backgroundColor = "yellow";
        // secondButton.style.backgroundColor = "grey";
        // secondButton.style.display = "inline-block";
    });

    secondButton.addEventListener("click", function () {
        secondButton.classList.add("active");
        firstButton.classList.remove("active");
        hiddenInput.value = "alkesBtn";

        firstButton.classList.add("btn-secondary");
        firstButton.classList.remove("btn-warning");

        secondButton.classList.add("btn-warning");
        secondButton.classList.remove("btn-secondary");

        
        // secondButton.style.backgroundColor = "yellow";
        // firstButton.style.backgroundColor = "grey";
    });
});

</script>


<?php include '../laporan_penjualan/grafikSelectScript.php' ?>

<?php include '../laporan_penjualan/labaSelectScript.php' ?>

<?php include '../laporan_penjualan/tabelSelectScript.php' ?>

<?php include '../laporan_penjualan/tabelSelectScriptAlkes.php' ?>

<?php include '../cek_kesehatan/modal_script.php' ?>










</script>

<!-- add user pimpinan -->
<script>
$(document).ready(function() {
  $('.level_user').change(function() {
    var selectedId = $(this).val();
    var id_ttk = $('.id_ttk');

    if (selectedId == 'pimpinan') {
      id_ttk.hide(); // Hide the second dropdown
    } else {
      id_ttk.show(); // Show the second dropdown for other selections
    }
  });
});

</script>


<!-- dropdown -->
<script>
  $(document).ready(function() {
    $('#obatDropdown').change(function() {
      var selectedId = $(this).val();
      console.log('Selected ID: ' + selectedId);
    });
  });
</script>




<!-- penerimaan logic retur -->
<?php include '../penerimaan_obat/tambahFetchScript.php' ?>
<?php include '../alkes/penerimaan_alkes/tambahFetchScriptALK.php' ?>











<!-- select2 -->
<script>
  // obat master data
$(document).ready(function() {
  $('#jenis_obat,#kategori_obat,#sediaan_obat').select2({
  theme: 'bootstrap4',
  placeholder: "- Pilih -"
})
});
</script>


<script>
// $(document).ready(function() {
//   $('[data-bs-toggle="tooltip"]').tooltip();
// });


//penjualan_obat
// $(document).ready(function() {
//   $('.select-option').select2();
// });


// pengadaan_obat
// $("#id_obat").select2({
//   theme: 'bootstrap4',
//   placeholder: "- Pilih -"
// });
// $("#month,#year").select2({
//   theme: 'bootstrap4',
//   // placeholder: "- Pilih -"
//   width: 'resolve'
// });

// select2 ori
$("#jenisKelamin,#jurusan,#status").select2({
  theme: 'bootstrap4',
  placeholder: "- Pilih -"
});
</script>


</body>

</html>