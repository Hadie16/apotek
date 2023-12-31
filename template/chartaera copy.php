
<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}
<?php
// Retrieve data from the three tables and store price_column and date_column values in arrays
// $laptop_table = [
//     ['price_column' => 1000, 'date_column' => '2023-01-05'],
//     ['price_column' => 1500, 'date_column' => '2023-03-10'],
//     ['price_column' => 1200, 'date_column' => '2023-05-15']
// ];

// $smartphone_table = [
//     ['price_column' => 800, 'date_column' => '2023-02-12'],
//     ['price_column' => 900, 'date_column' => '2023-04-20'],
//     ['price_column' => 1000, 'date_column' => '2023-06-25']
// ];

// $TV_table = [
//     ['price_column' => 2000, 'date_column' => '2023-01-18'],
//     ['price_column' => 1800, 'date_column' => '2023-04-08'],
//     ['price_column' => 2100, 'date_column' => '2023-07-02']
// ];

// // Merge the price_column arrays into a single array
// $priceData = array_merge(array_column($laptop_table, 'price_column'), array_column($smartphone_table, 'price_column'), array_column($TV_table, 'price_column'));

// // Merge the date_column arrays into a single array
// $dateData = array_merge(array_column($laptop_table, 'date_column'), array_column($smartphone_table, 'date_column'), array_column($TV_table, 'date_column'));

// // Combine priceData and dateData into an associative v v v array
// $dataDict = array_combine($dateData, $priceData);

// // Sort the associative array based on the dates
// ksort($dataDict);

// // Extract the sorted prices and convert them to numbers
// $data = array_values($dataDict);
// $datas = array_map('intval', $data);

// Encode the data as JSON and send it as a response
// echo json_encode($data);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mahabbah";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// $sql = "SELECT SUM(price_column) AS total_price, MONTH(date_column) AS month FROM (
//     SELECT price_column, date_column FROM laptop_table
//     UNION ALL
//     SELECT price_column, date_column FROM smartphone_table
//     UNION ALL
//     SELECT price_column, date_column FROM TV_table
// ) AS combined_data
// GROUP BY month
// ORDER BY month";
$sql = "SELECT SUM(pendapatan) AS total_price, MONTH(tanggal) AS month FROM (
    SELECT total_biaya as pendapatan, tanggal_cek_kesehatan as tanggal FROM cek_kesehatan
    UNION ALL
    SELECT total_harga as pendapatan, tanggal_penjualan_obat as tanggal  FROM penjualan_obat
) AS combined_data
GROUP BY month
ORDER BY month";

$result = $conn->query($sql);

// Store the sorted months in an array
$months = array();
$prices = array();

while ($row = $result->fetch_assoc()) {
$month = date('M', mktime(0, 0, 0, $row["month"], 1));
array_push($months, $month);
// $k=$row["month"];
$price=$row["total_price"];

array_push($prices,$price);

}

// Close the database connection
$conn->close();

// Encode the months array as JSON and send it as the response
// echo json_encode($months);

?>
// console.log(<?php echo json_encode($months)?>);
// console.log(<?php echo json_encode($prices)?>);

const month = <?php echo json_encode($months)?>;
const price = <?php echo json_encode($prices)?>;




const data ={
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    // labels: month,
    datasets: [{
      label: "Pendapatan",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223,0.3)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      // data: price,
      data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
    },
    {
    label: "Pendapatan2",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223,0.3)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: price,
    }],
}

// Area Chart Example
var ctx = document.getElementById("myAreaCharts");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data,
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return 'Rp' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': Rp' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});


  </script>