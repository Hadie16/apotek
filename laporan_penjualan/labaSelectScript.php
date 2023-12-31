<script>
        // Add event listener for form submission
        document.getElementById('filterForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent form submission
            updateTable();
        });

        // Function to update the table based on user selection
        function updateTable() {
            var month = document.getElementById('month').value;
            var year = document.getElementById('year').value;
            // Send AJAX request to fetch data based on month and year
            $.ajax({
                url: '../laporan_penjualan/labaFetchSelect.php',
                type: 'POST',
                data: { month: month, year: year },
                success: function (response) {
                    // Update the table with the fetched data
                    // document.getElementById('tableContainer').style.width = '100%';
                    // var jj= 9;
        var printContainer = '<a href="../laporan_penjualan/print.php?month='+month+'&year='+year+'" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-print"></i>Cetak</a>'
// <?php $selectYear ?> = year;

                    document.getElementById('printContainer').innerHTML = printContainer;
                    document.getElementById('tableContainer').innerHTML = response;
                    document.getElementById('tableContainer').style.width = '100%';
               



                }
            });
        }
    </script>