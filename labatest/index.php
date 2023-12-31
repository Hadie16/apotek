<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Table</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Dynamic Table</h1>
    <form id="filterForm">
        <label for="month">Select Month:</label>
        <select id="month" name="month">
        <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>
        <label for="year">Select Year:</label>
        <select id="year" name="year">
            <option value="2023">2023</option>
            <!-- Add options for other years -->
        </select>
        <input type="submit" value="Filter">
    </form>
    <div id="tableContainer">
        <!-- Dynamic table will be displayed here -->
    </div>
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
                url: 'fetch_data.php',
                type: 'POST',
                data: { month: month, year: year },
                success: function (response) {
                    // Update the table with the fetched data
                    document.getElementById('tableContainer').innerHTML = response;
                }
            });
        }
    </script>
</body>
</html>
