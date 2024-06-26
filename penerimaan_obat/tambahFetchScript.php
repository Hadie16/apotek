<!-- penerimaan logic retur -->
<script>
  // ori
    // function redirectToPage(condition) {
    //     if (condition === 'first') {
    //         window.location.href = 'page2.html'; // Redirect to the first page
    //     } else if (condition === 'second') {
    //         window.location.href = 'page3.html'; // Redirect to the second page
    //     }
    // }
    function redirectToPage(condition) {
        var conds = condition;
            // Send AJAX request to fetch data based on month and year
            $.ajax({
                url: '../penerimaan_obat/tambahFetch.php',
                type: 'POST',
                data: { conds: conds },
                success: function (response) {
                // console.log(response);
                    document.getElementById('tableContainerTambah').innerHTML = response;
                    document.getElementById('tableContainerTambah').style.width = '100%';
                     }
                      })
    }
</script>