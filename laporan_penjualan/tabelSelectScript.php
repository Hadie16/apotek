<script>
    (function () {
        // Add event listener for form submission
        document.getElementById('tabelFilterForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent form submission
            updateTable();
        });

        // Function to update the table based on user selection
        function updateTable() {
            var month = document.getElementById('monthTabel').value;
            var year = document.getElementById('yearTabel').value;
            // Send AJAX request to fetch data based on month and year
            $.ajax({
                url: '../laporan_penjualan/tabelFetchSelect.php',
                type: 'POST',
                data: { month: month, year: year },
                success: function (response) {
                    // console.log(month);
                    // console.log(year);
                    // console.log(response);

                    // Update the table with the fetched data
                    // document.getElementById('tableContainer').style.width = '100%';
                    // var jj= 9;
        var printContainer = '<a href="../laporan_penjualan/printTop.php?month='+month+'&year='+year+'" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>Cetak</a>'
// <?php $selectYear ?> = year;

                    document.getElementById('printContainerTabel').innerHTML = printContainer;
                    document.getElementById('tableContainerTabel').innerHTML = response;
                    document.getElementById('tableContainerTabel').style.width = '100%';
               



    if(month !== "0"){
      let date = month;// Replace 'your original date string' with your actual date string

date = date.replace(/(\d+)/, function(match, month) {
    switch (month) {
        case '1':
            return 'Januari';
        case '2':
            return 'Februari';
        case '3':
            return 'Maret';
        case '4':
            return 'April';
        case '5':
            return 'Mei';
        case '6':
            return 'Juni';
        case '7':
            return 'Juli';
        case '8':
            return 'Agustus';
        case '9':
            return 'September';
        case '10':
            return 'Oktober';
        case '11':
            return 'November';
        case '12':
            return 'Desember';
        default:
            return match; // Return the original value if it doesn't match a month number
    }
});

// console.log(date);


    var h6ContTabelObat = "Penjualan Obat Tertinggi Periode ("+date+" "+year+")";
    document.getElementById("h6ContTabelObat").innerHTML= h6ContTabelObat;
//echo $date; // output the date
}else{

  var h6ContTabelObat = "Penjualan Obat Tertinggi Periode ("+year+")";
    document.getElementById("h6ContTabelObat").innerHTML= h6ContTabelObat;
}


                }
            });
        }
    })();
    </script>