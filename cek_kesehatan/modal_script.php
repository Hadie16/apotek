


<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
    $(document).ready(function() {
        $('.myButton').click(function() {
            var cek_id = $(this).data('id');
            console.log(cek_id);
            // Now you have the data-id value (6 in this case)
            // You can use it in your AJAX request
            $.ajax({
                url: '../cek_kesehatan/modal_fetch.php',
                method: 'POST', // or GET depending on your server setup
                data: { cek_id: cek_id },

                success: function(response) {
                    // Handle success response from server
                    document.getElementById('printContainerCek').innerHTML = response;

                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('Error:', error);
                }
            });
        });
    });
</script>
