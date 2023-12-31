//user
$(document).ready(function() {
    $('#viewUser').DataTable();
  });
  //supplier
  $(document).ready(function() {
    $('#viewSupplier').DataTable({
      "columnDefs": [{
        "targets": [1,4],
        "orderable": false
      }]
    });
  });
  //obat
  $(document).ready(function() {
    $('#viewObat').DataTable({
      "columnDefs": [{
        "targets": [1,5],
        "orderable": false
      }]
    });
  });
  //kasir
  $(document).ready(function() {
    $('#viewKasir').DataTable({
      "columnDefs": [{
        "targets": [1,4,5],
        "orderable": false
      }]
    });
  });
  //alkes
  $(document).ready(function() {
    $('#viewAlkes').DataTable({
      "columnDefs": [{
        "targets": [1,5],
        "orderable": false
      }]
    });
  });
  
  // //penjualan_obat
  // $(document).ready(function() {
  //   $('#viewPenjualanObat').DataTable({
  //     "columnDefs": [{
  //       "targets": [4],
  //       "orderable": false
  //     }]
  //   });
  // }
  // );
  //detail_penjualan_obat
  $(document).ready(function() {
    $('#viewDetailPenjualanObat').DataTable({
      "columnDefs": [{
        "targets": [4],
        "orderable": false
      }]
    });
  });
  // stok_obat
  // $(document).ready(function() {
  //   var table = $('#viewStokObat').DataTable({
  //     // searching: true,
  //     columnDefs: [{
  //       targets: [6],
  //       orderable: false
  //     }]
  //   });
  
  //   // Add event listeners to the date inputs
  //   $('#startDate').on('change', function() {
  //     table.draw();
  //   });
  
  //   $('#endDate').on('change', function() {
  //     table.draw();
  //   });
  
  //   // Extend DataTables with a custom filtering function
  //   $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
  //     var startDate = $('#startDate').val();
  //     var endDate = $('#endDate').val();
  //     var date = data[6]; // Assuming the date column is the 7th column (index 6)
  
  //     if ((startDate === '' && endDate === '') ||
  //         (startDate === '' && date <= endDate) ||
  //         (endDate === '' && date >= startDate) ||
  //         (date >= startDate && date <= endDate)) {
  //       return true;
  //     }
  
  //     return false;
  //   });
  // });
  


  //test
// $(document).ready(function() {
//     $('#viewStokObat').DataTable({
//       "columnDefs": [{
//         "targets": [6],
//         "orderable": false
//       }],
//       "drawCallback": function(settings) {
//         var startDate = '2023-01-01'; // Replace with your start date
//         var endDate = '2023-12-31'; // Replace with your end date
//         var columnIndex = 2; // Replace with the index of your date column
  
//         this.api().column(columnIndex).data().between(startDate, endDate).draw();
//       }
//     });
//   });

//ori
  // $(document).ready(function() {
  //   $('#viewStokObat').DataTable({
  //     "columnDefs": [{
  //       "targets": [6],
  //       "orderable": false
  //     }]
  //   });
  // });



  //pengadaan_obat
  // $(document).ready(function() {
  //   $('#viewPengadaanObat').DataTable({
  //     "columnDefs": [{
  //       "targets": [8],
  //       "orderable": false
  //     }]
  //   });
  // });
  
  // //cek_gula_darah
  // $(document).ready(function() {
  //   $('#viewCekGulaDarah').DataTable({
  //     "columnDefs": [{
  //       "targets": [1],
  //       "orderable": false
  //     }]
  //   });
  // });
  
  // //cek_asam_urat
  // $(document).ready(function() {
  //   $('#viewCekAsamUrat').DataTable({
  //     "columnDefs": [{
  //       "targets": [1],
  //       "orderable": false
  //     }]
  //   });
  // });
  
  // //cek_kolesterol
  // $(document).ready(function() {
  //   $('#viewCekKolesterol').DataTable({
  //     "columnDefs": [{
  //       "targets": [1],
  //       "orderable": false
  //     }]
  //   });
  // });
  //ketersediaan_obat
  // $(document).ready(function() {
  //   $('#viewKetersediaanObat').DataTable({
  //     "columnDefs": [{
  //       "targets": [6],
  //       "orderable": false
  //     }]
  //   });
  // });
  
    //cek_kesehatan_proses
    $(document).ready(function() {
      $('#viewProses').DataTable({
        "columnDefs": [{
          "targets": [1],
          "orderable": false
        }]
      });
    });

      //cek_kesehatan_selesai
  $(document).ready(function() {
    $('#viewSelesai').DataTable({
      "columnDefs": [{
        "targets": [1],
        "orderable": false
      }]
    });
  });
  
       //cek_detail_kesehatan
       $(document).ready(function() {
        $('#viewDetailCekKesehatan').DataTable({
          "columnDefs": [{
            "targets": [1],
            "orderable": false
          }]
        });
      });
  
  //sample
  $(document).ready(function() {
    // console.log("Initializing DataTables...");
    $('#viewMahasiswa,#viewdosen').DataTable({
      "columnDefs": [{
        "targets": [4, 5, 6, 7],
        "orderable": false
      }]
    });
  });

  // $(document).ready(function() {
  //   var table = $('#viewPengadaanObat').DataTable({
  //     searching: true,
  //     columnDefs: [{
  //       targets: [6],
  //       orderable: false
  //     }]
  //   });
  
  //   // Custom print button click event
  //   $('#printButton').on('click', function() {
  //     var startDate = $('#startDate').val();
  //     var endDate = $('#endDate').val();
  
  //     // Apply date range filtering
  //     table.column(5).search(startDate + ' to ' + endDate).draw();
  
  //     // Print the filtered table
  //     table.button('.buttons-print').trigger();
      
  //     // Reset the table filter
  //     table.column(5).search('').draw();
  //   });
  // });
  
  //pengadaan
//   $(document).ready(function() {
//     var table = $('#viewPengadaanObat').DataTable({
//       searching: true,
//       columnDefs: [{
//         targets: [6],
//         orderable: false
//       }]
//     });
  
//     // Add event listeners to the date inputs
//     $('#startDate').on('change', function() {
//       table.draw();
//     });
  
//     $('#endDate').on('change', function() {
//       table.draw();
//     });
  
//     // Extend DataTables with a custom filtering function
//     $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
//       var startDate = $('#startDate').val();
//       var endDate = $('#endDate').val();
//       var date = data[6]; // Assuming the date column is the 7th column (index 6)
  
//       if ((startDate === '' && endDate === '') ||
//           (startDate === '' && date <= endDate) ||
//           (endDate === '' && date >= startDate) ||
//           (date >= startDate && date <= endDate)) {
//         return true;
//       }
  
//       return false;
//     });
//   });
// //pengadaan
//   const startDateInput = document.getElementById('startDate');
// const displayDateInput = document.getElementById('displayDate');

// startDateInput.addEventListener('input', function() {
//   const selectedDate = startDateInput.value;
//   displayDateInput.value = selectedDate;
// });


// const filterButton = document.getElementById('filterButton');

// filterButton.addEventListener('click', function() {
//   const startDate = document.getElementById('startDate').value;
//   const endDate = document.getElementById('endDate').value;

//   // Create the URL with the parameters
//   const url = '../pengadaan_obat/printFilter.php?startDate=' + startDate + '&endDate=' + endDate;

//   // Navigate to the other page
//   window.location.href = url;
// });

//stok
$(document).ready(function() {
  var table = $('#viewStokObat').DataTable({
    searching: true,
    columnDefs: [{
      targets: [1],
      orderable: false
    }]
  });

  // Add event listeners to the date inputs
  $('#startDateStok').on('change', function() {
    table.draw();
  });

  $('#endDateStok').on('change', function() {
    table.draw();
  });

  // Extend DataTables with a custom filtering function
  $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
    var startDateStok = $('#startDateStok').val();
    var endDateStok = $('#endDateStok').val();
    var date = data[6]; // Assuming the date column is the 7th column (index 6)

    if ((startDateStok === '' && endDateStok === '') ||
        (startDateStok === '' && date <= endDateStok) ||
        (endDateStok === '' && date >= startDateStok) ||
        (date >= startDateStok && date <= endDateStok)) {
      return true;
    }

    return false;
  });
});
//stok
const startDateStok = document.getElementById('startDateStok');
const displayDateStok = document.getElementById('displayDateStok');

startDateStok.addEventListener('input', function() {
  const selectedDate = startDateStok.value;
  displayDateStok.value = selectedDate;
});


const filterButtonStok = document.getElementById('filterButtonStok');

filterButton.addEventListener('click', function() {

  const startStok = document.getElementById('startDateStok').value;
  const endStok = document.getElementById('endDateStok').value;

  // Create the URL with the parameters
  const url = '../stok_obat/printFilter.php?startDate=' + startStok + '&endDate=' + endStok;

  // Navigate to the other page
  window.location.href = url;
});