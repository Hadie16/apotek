//user
$(document).ready(function() {
    $('#viewUser').DataTable();
  });

//expired
  $(document).ready(function() {
    $('#viewExpired').DataTable();
  });
  $(document).ready(function() {
    $('#viewExpiredALK').DataTable();
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

   //supplier
   $(document).ready(function() {
    $('#viewTopB').DataTable({
      "columnDefs": [{
        "targets": [3],
        "orderable": false
      }]
    });
  });

    //laporan penjualan /tabel
   $(document).ready(function() {
    $('#viewTop').DataTable();
  });

      //laporan penjualan /tabel alkes
   $(document).ready(function() {
    $('#viewTop2').DataTable();
  });

    //viewMOdalCK
    $(document).ready(function() {
      $('#viewModalCK').DataTable({
        "columnDefs": [{
          "targets": [5,6],
          "orderable": false
        }]
      });
    });
    //supplier
    $(document).ready(function() {
      $('#viewDSO').DataTable({
        "columnDefs": [{
          "targets": [6],
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
  
  // penjualan_obat
  // $(document).ready(function() {
  //   $('#viewPenObat').DataTable({
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


  //detail_ketersediaan_obat
  $(document).ready(function() {
    $('#viewDKO').DataTable({
      "columnDefs": [{
        "targets": [6],
        "orderable": false
      }]
    });
  });
  
  
    //cek_kesehatan_proses
    $(document).ready(function() {
      $('#viewProses').DataTable({
        "columnDefs": [{
          "targets": [3,4],
          "orderable": false
        }]
      });
    });

    $(document).ready(function() {
      $('#viewDetailPenerimaanObat').DataTable({
        "columnDefs": [{
          "targets": [8],
          "orderable": false
        }]
      });
    });
      //cek_kesehatan_selesai
  // $(document).ready(function() {
  //   $('#viewSelesai').DataTable({
  //     "columnDefs": [{
  //       "targets": [1],
  //       "orderable": false
  //     }]
  //   });
  // });

       //historY_pasien
       $(document).ready(function() {
        $('#viewHistoryPasien').DataTable({
          "columnDefs": [{
            "targets": [5,6],
            "orderable": false
          }]
        });
      });

     //detail_history
     $(document).ready(function() {
      $('#viewDetailHistory').DataTable({
        "columnDefs": [{
          "targets": [3,4],
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
  
        //obat_keluar
  $(document).ready(function() {
    $('#viewObatKeluar').DataTable({
      "columnDefs": [{
        "targets": [5],
        "orderable": false
      }]
    });
  });

        //retur_obat
        $(document).ready(function() {
          $('#viewReturObat').DataTable({
            "columnDefs": [{
              "targets": [6],
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
  //   $('#viewPengadaanObat').DataTable({
  //     "columnDefs": [{
  //       "targets": [4,5],
  //       "orderable": false
  //     }]
  //   });
  // });

  (function() {
    //pengadaan
  $(document).ready(function() {
    var table = $('#viewPengadaanObatSelesai').DataTable({
      columnDefs: [{
        targets: [7,8],
        orderable: false
      }]
    }); 

const startDateInput1 = document.getElementById('startDatePGD');

    if (startDateInput1) {
    // Add event listeners to the date inputs
    $('#startDatePGD').on('change', function() {
      table.draw();
    });
  
    $('#endDatePGD').on('change', function() {
      table.draw();
    });
  
    // Extend DataTables with a custom filtering function
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
      var startDate = $('#startDatePGD').val();
      var endDate = $('#endDatePGD').val();
      var date = data[5]; // Assuming the date column is the 7th column (index 6)
  
      if ((startDate === '' && endDate === '') ||
          (startDate === '' && date <= endDate) ||
          (endDate === '' && date >= startDate) ||
          (date >= startDate && date <= endDate)) {
        return true;
      }
  
      return false;
    });
}
  });

  //pengadaan
 
  // const displayDateInputss = document.getElementById('displayDatePGD').value;

  // if(displayDateInputss=="PGDALK"){
    (function() {
      const pageType = document.querySelector('[data-page]')?.getAttribute('data-page');
    
      if (pageType === "PGDALK") {
        const startDateInput = document.getElementById('startDatePGD');
        const filterButtonALK = document.getElementById('filterButtonPGDALK');
    
        filterButtonALK.addEventListener('click', function() {
          const startDate = startDateInput.value;
          const endDate = document.getElementById('endDatePGD').value;
    
          const url = '../alkes/pengadaan_alkes/printFilter.php?startDate=' + startDate + '&endDate=' + endDate;
          window.open(url, '_blank');
        });
    
      } else if (pageType === "PGD") {0
        const startDateInput = document.getElementById('startDatePGD');
        
        startDateInput.addEventListener('input', function() {
          const selectedDate = startDateInput.value;
          // You can use selectedDate as needed, but you don't need displayDateInput here
        });
    
        const filterButton = document.getElementById('filterButtonPGD');
    
        filterButton.addEventListener('click', function() {
          const startDate = startDateInput.value;
          const endDate = document.getElementById('endDatePGD').value;
    
          const url = '../pengadaan_obat/printFilter.php?startDate=' + startDate + '&endDate=' + endDate;
          window.open(url, '_blank');
        });
      }
    
    })();

})();



//ketersediaan obat

(function() {
  $(document).ready(function() {
    var table = $('#viewKetersediaanObat').DataTable({
      columnDefs: [{
        targets: [7],
        orderable: false
      }]
    });
const startDateInput2 = document.getElementById('startDateKO');

    if (startDateInput2) {
    // Add event listeners to the date inputs
    $('#startDateKO').on('change', function() {
      table.draw();
    });
  
    $('#endDateKO').on('change', function() {
      table.draw();
    });
  
    // Extend DataTables with a custom filtering function
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
      var startDate = $('#startDateKO').val();
      var endDate = $('#endDateKO').val();
      var date = data[5]; // Assuming the date column is the 7th column (index 6)
  
      if ((startDate === '' && endDate === '') ||
          (startDate === '' && date <= endDate) ||
          (endDate === '' && date >= startDate) ||
          (date >= startDate && date <= endDate)) {
        return true;
      }
  
      return false;
    });
}
  });

  (function() {
    const pageType = document.querySelector('[data-page]')?.getAttribute('data-page');
  
    if (pageType === "KOALK") {
      const startDateInput = document.getElementById('startDateKO');
      const filterButtonALK = document.getElementById('filterButtonKOALK');
  
      filterButtonALK.addEventListener('click', function() {
        const startDate = startDateInput.value;
        const endDate = document.getElementById('endDateKO').value;
  
        const url = '../alkes/ketersediaan_alkes/printFilter.php?startDate=' + startDate + '&endDate=' + endDate;
        window.open(url, '_blank');
      });
  
    } else if (pageType === "KO") {
      const startDateInput = document.getElementById('startDateKO');
      
      startDateInput.addEventListener('input', function() {
        const selectedDate = startDateInput.value;
        // You can use selectedDate as needed, but you don't need displayDateInput here
      });
  
      const filterButton = document.getElementById('filterButtonKO');
  
      filterButton.addEventListener('click', function() {
        const startDate = startDateInput.value;
        const endDate = document.getElementById('endDateKO').value;
  
        const url = '../ketersediaan_obat/printFilter.php?startDate=' + startDate + '&endDate=' + endDate;
        window.open(url, '_blank');
      });
    }
  
  })();
  

})();


//stok obat

(function() {
  $(document).ready(function() {
    var table = $('#viewSO').DataTable({
      columnDefs: [{
        targets: [7],
        orderable: false
      }]
    });
const startDateInput2 = document.getElementById('startDateSO');

    if (startDateInput2) {
    // Add event listeners to the date inputs
    $('#startDateSO').on('change', function() {
      table.draw();
    });
  
    $('#endDateSO').on('change', function() {
      table.draw();
    });
  
    // Extend DataTables with a custom filtering function
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
      var startDate = $('#startDateSO').val();
      var endDate = $('#endDateSO').val();
      var date = data[5]; // Assuming the date column is the 7th column (index 6)
  
      if ((startDate === '' && endDate === '') ||
          (startDate === '' && date <= endDate) ||
          (endDate === '' && date >= startDate) ||
          (date >= startDate && date <= endDate)) {
        return true;
      }
  
      return false;
    });
}

      // Manually trigger DataTables search to reset the filtering
      // resetDataTablesFilter(table); // Pass the DataTables instance as an argument

  });


  (function() {
    const pageType = document.querySelector('[data-page]')?.getAttribute('data-page');
  
    if (pageType === "SOALK") {
      const startDateInput = document.getElementById('startDateSO');
      const filterButtonALK = document.getElementById('filterButtonSOALK');
  
      filterButtonALK.addEventListener('click', function() {
        const startDate = startDateInput.value;
        const endDate = document.getElementById('endDateSO').value;
  
        const url = '../alkes/stok_alkes/printFilter.php?startDate=' + startDate + '&endDate=' + endDate;
        window.open(url, '_blank');
      });
  
    } else if (pageType === "SO") {
      const startDateInput = document.getElementById('startDateSO');
      
      startDateInput.addEventListener('input', function() {
        const selectedDate = startDateInput.value;
        // You can use selectedDate as needed, but you don't need displayDateInput here
      });
  
      const filterButton = document.getElementById('filterButtonSO');
  
      filterButton.addEventListener('click', function() {
        const startDate = startDateInput.value;
        const endDate = document.getElementById('endDateSO').value;
  
        const url = '../stok_obat/printFilter.php?startDate=' + startDate + '&endDate=' + endDate;
        window.open(url, '_blank');
      });
    }
  
  })();

    
})();

//Cek Kesehatan - Selesai

(function() {
  $(document).ready(function() {
    var table = $('#viewSelesai').DataTable({
      columnDefs: [{
        targets: [6,7],
        orderable: false
      }]
    });
const startDateInput2 = document.getElementById('startDateCek');

    if (startDateInput2) {
    // Add event listeners to the date inputs
    $('#startDateCek').on('change', function() {
      table.draw();
    });
  
    $('#endDateCek').on('change', function() {
      table.draw();
    });
  
    // Extend DataTables with a custom filtering function
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
      var startDate = $('#startDateCek').val();
      var endDate = $('#endDateCek').val();
      var date = data[3]; // Assuming the date column is the 7th column (index 6)
  
      if ((startDate === '' && endDate === '') ||
          (startDate === '' && date <= endDate) ||
          (endDate === '' && date >= startDate) ||
          (date >= startDate && date <= endDate)) {
        return true;
      }
  
      return false;
    });
}
  });

const startDateInput = document.getElementById('startDateCek');
const displayDateInput = document.getElementById('displayDateCek');

if (startDateInput) {
  startDateInput.addEventListener('input', function() {
    const selectedDate = startDateInput.value;
    displayDateInput.value = selectedDate;
  });

  const filterButton = document.getElementById('filterButtonCek');

  filterButton.addEventListener('click', function() {
    const startDate = startDateInput.value;
    const endDate = document.getElementById('endDateCek').value;

    // Create the URL with the parameters
    const url = '../cek_kesehatan/printFilter.php?startDate=' + startDate + '&endDate=' + endDate;
// filterButton.setAttribute("target","_blank")
    // Navigate to the other page
    // window.location.href = url;
    window.open(url,'_blank')
  });
}

})();

//Penjualan obat

(function() {
  $(document).ready(function() {
    var table = $('#viewPenjualanObat').DataTable({
      columnDefs: [{
        targets: [5],
        orderable: false
      }]
    });
    // Get the search value
    const print_keyPobat = document.getElementById('print_keyPobat');

    print_keyPobat.addEventListener('click', function() {
      // Retrieve the search value from the table object using DataTables API
      const searchValueObject = table.search();
      const sv = searchValueObject;
  
      // Create the URL with the parameters
      const url = '../penjualan_obat/print.php?keyword=' + encodeURIComponent(sv);
  
      window.open(url, '_blank');
    });

const startDateInput2 = document.getElementById('startDatePNJ');

    if (startDateInput2) {
    // Add event listeners to the date inputs
    $('#startDatePNJ').on('change', function() {
      table.draw();
    });
  
    $('#endDatePNJ').on('change', function() {
      table.draw();
    });
  
    // Extend DataTables with a custom filtering function
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
      var startDate = $('#startDatePNJ').val();
      var endDate = $('#endDatePNJ').val();
      var date = data[2]; // Assuming the date column is the 7th column (index 6)
  
      if ((startDate === '' && endDate === '') ||
          (startDate === '' && date <= endDate) ||
          (endDate === '' && date >= startDate) ||
          (date >= startDate && date <= endDate)) {
        return true;
      }
  
      return false;
    });
}
  });

  (function() {
    const pageType = document.querySelector('[data-page]')?.getAttribute('data-page');
  
    if (pageType === "PNJALK") {
      const startDateInput = document.getElementById('startDatePNJ');
      const filterButtonALK = document.getElementById('filterButtonPNJALK');
  
      filterButtonALK.addEventListener('click', function() {
        const startDate = startDateInput.value;
        const endDate = document.getElementById('endDatePNJ').value;
  
        const url = '../alkes/penjualan_alkes/printFilter.php?startDate=' + startDate + '&endDate=' + endDate;
        window.open(url, '_blank');
      });
  
    } else if (pageType === "PNJ") {
      const startDateInput = document.getElementById('startDatePNJ');
      
      startDateInput.addEventListener('input', function() {
        const selectedDate = startDateInput.value;
        // You can use selectedDate as needed, but you don't need displayDateInput here
      });
  
      const filterButton = document.getElementById('filterButtonPNJ');
  
      filterButton.addEventListener('click', function() {
        const startDate = startDateInput.value;
        const endDate = document.getElementById('endDatePNJ').value;
  
        const url = '../penjualan_obat/printFilter.php?startDate=' + startDate + '&endDate=' + endDate;
        window.open(url, '_blank');
      });
    }
  
  })();

})();

//ketersediaan obat masuk

(function() {
  $(document).ready(function() {
    var table = $('#viewKetersediaanObatMasuk').DataTable({
      columnDefs: [{
        targets: [9],
        orderable: false
      }]
    });
const startDateInput2 = document.getElementById('startDateKobatMasuk');

    if (startDateInput2) {
    // Add event listeners to the date inputs
    $('#startDateKobatMasuk').on('change', function() {
      table.draw();
    });
  
    $('#endDateKobatMasuk').on('change', function() {
      table.draw();
    });
  
    // Extend DataTables with a custom filtering function
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
      var startDate = $('#startDateKobatMasuk').val();
      var endDate = $('#endDateKobatMasuk').val();
      var date = data[8]; // Assuming the date column is the 7th column (index 6)
  
      if ((startDate === '' && endDate === '') ||
          (startDate === '' && date <= endDate) ||
          (endDate === '' && date >= startDate) ||
          (date >= startDate && date <= endDate)) {
        return true;
      }
  
      return false;
    });
}
  });

const startDateInput = document.getElementById('startDateKobatMasuk');
const displayDateInput = document.getElementById('displayDateKobatMasuk');

if (startDateInput) {
  startDateInput.addEventListener('input', function() {
    const selectedDate = startDateInput.value;
    displayDateInput.value = selectedDate;
  });

  const filterButton = document.getElementById('filterButtonKobatMasuk');

  filterButton.addEventListener('click', function() {
    const startDate = startDateInput.value;
    const endDate = document.getElementById('endDateKobatMasuk').value;

    // Create the URL with the parameters
    const url = '../ketersediaan_obat_masuk/printFilter.php?startDate=' + startDate + '&endDate=' + endDate;
// filterButton.setAttribute("target","_blank")
    // Navigate to the other page
    // window.location.href = url;
    window.open(url,'_blank')
  });
}

})();


//penerimaan obat

(function() {
  $(document).ready(function() {
    var table = $('#viewPenerimaanObat').DataTable({
      columnDefs: [{
        targets: [6],
        orderable: false
      }]
    });
const startDateInput2 = document.getElementById('startDatePNM');

    if (startDateInput2) {
    // Add event listeners to the date inputs
    $('#startDatePNM').on('change', function() {
      table.draw();
    });
  
    $('#endDatePNM').on('change', function() {
      table.draw();
    });
  
    // Extend DataTables with a custom filtering function
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
      var startDate = $('#startDatePNM').val();
      var endDate = $('#endDatePNM').val();
      var date = data[3]; // Assuming the date column is the 7th column (index 6)
  
      if ((startDate === '' && endDate === '') ||
          (startDate === '' && date <= endDate) ||
          (endDate === '' && date >= startDate) ||
          (date >= startDate && date <= endDate)) {
        return true;
      }
  
      return false;
    });
}
  });

  (function() {
    const pageType = document.querySelector('[data-page]')?.getAttribute('data-page');
  
    if (pageType === "PNMALK") {
      const startDateInput = document.getElementById('startDatePNM');
      const filterButtonALK = document.getElementById('filterButtonPNMALK');
  
      filterButtonALK.addEventListener('click', function() {
        const startDate = startDateInput.value;
        const endDate = document.getElementById('endDatePNM').value;
  
        const url = '../alkes/penerimaan_alkes/printFilter.php?startDate=' + startDate + '&endDate=' + endDate;
        window.open(url, '_blank');
      });
  
    } else if (pageType === "PNM") {
      const startDateInput = document.getElementById('startDatePNM');
      
      startDateInput.addEventListener('input', function() {
        const selectedDate = startDateInput.value;
        // You can use selectedDate as needed, but you don't need displayDateInput here
      });
  
      const filterButton = document.getElementById('filterButtonPNM');
  
      filterButton.addEventListener('click', function() {
        const startDate = startDateInput.value;
        const endDate = document.getElementById('endDatePNM').value;
  
        const url = '../penerimaan_obat/printFilter.php?startDate=' + startDate + '&endDate=' + endDate;
        window.open(url, '_blank');
      });
    }
  
  })();


})();




//================================alkes=========================================
(function() {
  //pengadaan
$(document).ready(function() {
  var table = $('#viewPengadaanAlkes').DataTable({
    columnDefs: [{
      targets: [8],
      orderable: false
    }]
  }); 

const startDateInput1 = document.getElementById('startDates');

  if (startDateInput1) {
  // Add event listeners to the date inputs
  $('#startDates').on('change', function() {
    table.draw();
  });

  $('#endDates').on('change', function() {
    table.draw();
  });

  // Extend DataTables with a custom filtering function
  $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
    var startDate = $('#startDates').val();
    var endDate = $('#endDates').val();
    var date = data[6]; // Assuming the date column is the 7th column (index 6)

    if ((startDate === '' && endDate === '') ||
        (startDate === '' && date <= endDate) ||
        (endDate === '' && date >= startDate) ||
        (date >= startDate && date <= endDate)) {
      return true;
    }

    return false;
  });
}
});
//pengadaan
const startDateInput = document.getElementById('startDates');
const displayDateInput = document.getElementById('displayDate');

if (startDateInput) {
startDateInput.addEventListener('input', function() {
  const selectedDate = startDateInput.value;
  displayDateInput.value = selectedDate;
});

const filterButton = document.getElementById('filterButtons');

filterButton.addEventListener('click', function() {
  const startDate = startDateInput.value;
  const endDate = document.getElementById('endDates').value;

  // Create the URL with the parameters
  const url = '../pengadaan_alkes/printFilter.php?startDate=' + startDate + '&endDate=' + endDate;

  // Navigate to the other page
  window.location.href = url;
});
}
})();

//ketersediaan alkes

(function() {
  $(document).ready(function() {
    var table = $('#viewKetersediaanAlkes').DataTable({
      columnDefs: [{
        targets: [5],
        orderable: false
      }]
    });
const startDateInput2 = document.getElementById('startDateKobat');

    if (startDateInput2) {
    // Add event listeners to the date inputs
    $('#startDateKobat').on('change', function() {
      table.draw();
    });
  
    $('#endDateKobat').on('change', function() {
      table.draw();
    });
  
    // Extend DataTables with a custom filtering function
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
      var startDate = $('#startDateKobat').val();
      var endDate = $('#endDateKobat').val();
      var date = data[3]; // Assuming the date column is the 7th column (index 6)
  
      if ((startDate === '' && endDate === '') ||
          (startDate === '' && date <= endDate) ||
          (endDate === '' && date >= startDate) ||
          (date >= startDate && date <= endDate)) {
        return true;
      }
  
      return false;
    });
}
  });

const startDateInput = document.getElementById('startDateKobat');
const displayDateInput = document.getElementById('displayDateKobat');

if (startDateInput) {
  startDateInput.addEventListener('input', function() {
    const selectedDate = startDateInput.value;
    displayDateInput.value = selectedDate;
  });

  const filterButton = document.getElementById('filterButtonKobat');

  filterButton.addEventListener('click', function() {
    const startDate = startDateInput.value;
    const endDate = document.getElementById('endDateKobat').value;

    // Create the URL with the parameters
    const url = '../ketersediaan_alkes/printFilter.php?startDate=' + startDate + '&endDate=' + endDate;
// filterButton.setAttribute("target","_blank")
    // Navigate to the other page
    // window.location.href = url;
    window.open(url,'_blank')
  });
}

})();

//stok alkes

(function() {
  $(document).ready(function() {
    var table = $('#viewStokAlkes').DataTable({
      columnDefs: [{
        targets: [5],
        orderable: false
      }]
    });
const startDateInput2 = document.getElementById('startDateStok');

    if (startDateInput2) {
    // Add event listeners to the date inputs
    $('#startDateStok').on('change', function() {
      table.draw();
    });
  
    $('#endDateStok').on('change', function() {
      table.draw();
    });
  
    // Extend DataTables with a custom filtering function
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
      var startDate = $('#startDateStok').val();
      var endDate = $('#endDateStok').val();
      var date = data[3]; // Assuming the date column is the 7th column (index 6)
  
      if ((startDate === '' && endDate === '') ||
          (startDate === '' && date <= endDate) ||
          (endDate === '' && date >= startDate) ||
          (date >= startDate && date <= endDate)) {
        return true;
      }
  
      return false;
    });
}
  });

const startDateInput = document.getElementById('startDateStok');
const displayDateInput = document.getElementById('displayDateStok');

if (startDateInput) {
  startDateInput.addEventListener('input', function() {
    const selectedDate = startDateInput.value;
    displayDateInput.value = selectedDate;
  });

  const filterButton = document.getElementById('filterButtonStok');

  filterButton.addEventListener('click', function() {
    const startDate = startDateInput.value;
    const endDate = document.getElementById('endDateStok').value;

    // Create the URL with the parameters
    const url = '../stok_alkes/printFilter.php?startDate=' + startDate + '&endDate=' + endDate;
// filterButton.setAttribute("target","_blank")
    // Navigate to the other page
    // window.location.href = url;
    window.open(url,'_blank')
  });
}

})();

//Penjualan alkes

(function() {
  $(document).ready(function() {
    var table = $('#viewPenjualanAlkes').DataTable({
      columnDefs: [{
        targets: [5],
        orderable: false
      }]
    });

    // const print_keyPalkes = document.getElementById('print_keyPalkess');

    // print_keyPalkes.addEventListener('click', function() {
    //   // Retrieve the search value from the table object using DataTables API
    //   const searchValueObjectALK = table.search();
    //   const svALK = searchValueObjectALK;
  
    //   // Create the URL with the parameters
    //   const url = '../alkes/penjualan_alkes/print.php?keyword=' + encodeURIComponent(svALK);
  
    //   window.open(url, '_blank');
    // });

const startDateInput2 = document.getElementById('startDatePobat');

    if (startDateInput2) {
    // Add event listeners to the date inputs
    $('#startDatePobat').on('change', function() {
      table.draw();
    });
  
    $('#endDatePobat').on('change', function() {
      table.draw();
    });
  
    // Extend DataTables with a custom filtering function
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
      var startDate = $('#startDatePobat').val();
      var endDate = $('#endDatePobat').val();
      var date = data[2]; // Assuming the date column is the 7th column (index 6)
  
      if ((startDate === '' && endDate === '') ||
          (startDate === '' && date <= endDate) ||
          (endDate === '' && date >= startDate) ||
          (date >= startDate && date <= endDate)) {
        return true;
      }
  
      return false;
    });
}
  });

const startDateInput = document.getElementById('startDatePobat');
const displayDateInput = document.getElementById('displayDatePobat');

if (startDateInput) {
  startDateInput.addEventListener('input', function() {
    const selectedDate = startDateInput.value;
    displayDateInput.value = selectedDate;
  });

  const filterButton = document.getElementById('filterButtonPobat');

  filterButton.addEventListener('click', function() {
    const startDate = startDateInput.value;
    const endDate = document.getElementById('endDatePobat').value;

    // Create the URL with the parameters
    const url = '../penjualan_alkes/printFilter.php?startDate=' + startDate + '&endDate=' + endDate;
// filterButton.setAttribute("target","_blank")
    // Navigate to the other page
    // window.location.href = url;
    window.open(url,'_blank')
  });
}

})();


(function() {
  //retur
// $(document).ready(function() {
//   var table = $('#salesTable').DataTable({
//     columnDefs: [{
//       targets: [1,2],
//       orderable: false,
//       targets: [5,6,7,8], visible: false
//     }]
//   }); 
  $(document).ready(function() {
    var table = $('#salesTable').DataTable({
      columnDefs: [
        { targets: [9], orderable: false },
        { targets: [5, 6, 7, 8], visible: false }
      ]
    });
  // });
  

  $('#toggleColumns').on('click', function() {
    var column5 = table.column(5);
    var column6 = table.column(6);
    var column7 = table.column(7);
    var column8 = table.column(8);
    
    column5.visible(!column5.visible());
    column6.visible(!column6.visible());
    column7.visible(!column7.visible());
    column8.visible(!column8.visible());

    // Trigger the click events on Button 1 and Button 2
    $('#sidebarToggle').click();
    // $('#button2').click();
});

const startDateInput1 = document.getElementById('startDateRET');

  if (startDateInput1) {
  // Add event listeners to the date inputs
  $('#startDateRET').on('change', function() {
    table.draw();
  });

  $('#endDateRET').on('change', function() {
    table.draw();
  });

  // Extend DataTables with a custom filtering function
  $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
    var startDate = $('#startDateRET').val();
    var endDate = $('#endDateRET').val();
    var date = data[3]; // Assuming the date column is the 7th column (index 6)

    if ((startDate === '' && endDate === '') ||
        (startDate === '' && date <= endDate) ||
        (endDate === '' && date >= startDate) ||
        (date >= startDate && date <= endDate)) {
      return true;
    }

    return false;
  });
}
});

//retur

// const displayDateInputss = document.getElementById('displayDateRET').value;

// if(displayDateInputss=="RETALK"){
  (function() {
    const pageType = document.querySelector('[data-page]')?.getAttribute('data-page');
  
    if (pageType === "RETALK") {
      const startDateInput = document.getElementById('startDateRET');
      const filterButtonALK = document.getElementById('filterButtonRETALK');
  
      filterButtonALK.addEventListener('click', function() {
        const startDate = startDateInput.value;
        const endDate = document.getElementById('endDateRET').value;
  
        const url = '../alkes/retur_alkes/printFilter.php?startDate=' + startDate + '&endDate=' + endDate;
        window.open(url, '_blank');
      });
  
    } else if (pageType === "RET") {0
      const startDateInput = document.getElementById('startDateRET');
      
      startDateInput.addEventListener('input', function() {
        const selectedDate = startDateInput.value;
        // You can use selectedDate as needed, but you don't need displayDateInput here
      });
  
      const filterButton = document.getElementById('filterButtonRET');
  
      filterButton.addEventListener('click', function() {
        const startDate = startDateInput.value;
        const endDate = document.getElementById('endDateRET').value;
  
        const url = '../retur_obat/print3.php?startDate=' + startDate + '&endDate=' + endDate;
        window.open(url, '_blank');
      });
    }
  
  })();

})();