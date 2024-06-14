
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

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mahabbah";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// $sql = "SELECT SUM(pendapatan) AS total_price, MONTH(tanggal) AS month FROM (
//     SELECT total_biaya as pendapatan, tanggal_cek_kesehatan as tanggal FROM cek_kesehatan
//     UNION ALL
//     SELECT total_harga as pendapatan, tanggal_penjualan_obat as tanggal  FROM penjualan_obat
// ) AS combined_data
// GROUP BY month
// ORDER BY month";



$sql = "SELECT SUM(total_harga) AS total_price, MONTH(tanggal_penjualan_obat) AS month FROM penjualan_obat
WHERE YEAR(tanggal_penjualan_obat) = YEAR(CURRENT_DATE())
GROUP BY month
ORDER BY month";

$sql2 = "SELECT SUM(total_harga) AS total_price2, MONTH(tanggal_penjualan_alkes) AS month2 FROM penjualan_alkes
WHERE YEAR(tanggal_penjualan_alkes) = YEAR(CURRENT_DATE())
GROUP BY month2
ORDER BY month2";

$sql3 = "SELECT SUM(total_biaya) AS total_price3, MONTH(tanggal_cek_kesehatan) AS month3 FROM cek_kesehatan
WHERE YEAR(tanggal_cek_kesehatan) = YEAR(CURRENT_DATE())
GROUP BY month3
ORDER BY month3";

$result = $conn->query($sql);
$result2 = $conn->query($sql2);
$result3 = $conn->query($sql3);


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

$months2 = array();
$prices2 = array();

while ($row = $result2->fetch_assoc()) {
$month2 = date('M', mktime(0, 0, 0, $row["month2"], 1));
array_push($months2, $month2);
// $k=$row["month"];
$price2=$row["total_price2"];

array_push($prices2,$price2);

}

$months3 = array();
$prices3 = array();

while ($row = $result3->fetch_assoc()) {
$month3 = date('M', mktime(0, 0, 0, $row["month3"], 1));
array_push($months3, $month3);
// $k=$row["month"];
$price3=$row["total_price3"];

array_push($prices3,$price3);

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
const price2 = <?php echo json_encode($prices2)?>;
const price3= <?php echo json_encode($prices3)?>;

// =====================kode tambahan under process=========
function fillMissingMonths(months, values, defaultValue = 0) {
  // const allMonths = [
  //   'January', 'February', 'March', 'April', 'May', 'June',
  //   'July', 'August', 'September', 'October', 'November', 'December'
  // ];
  const allMonths = [
    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
  ];

  const filledData = allMonths.map(month => {
    const index = months.findIndex(m => m.toLowerCase() === month.toLowerCase());
    if (index !== -1) {
      return { month, value: values[index] };
    } else {
      return { month, value: defaultValue };
    }
  });

  return filledData;
}


// Example usage:
// const months = ['January', 'August'];
// const values = [20, 30];

const filledData = fillMissingMonths(month, price, 0);
const filledData2 = fillMissingMonths(month, price2, 0);
const filledData3 = fillMissingMonths(month, price3, 0);


// Extract values only
const monthsOnly = filledData.map(item => item.month);
const valuesOnly = filledData.map(item => item.value);
const valuesOnly2 = filledData2.map(item => item.value);
const valuesOnly3 = filledData3.map(item => item.value);


// Display only the values
// console.log(valuesOnly);
// console.log(monthsOnly);



// =====================kode tambahan under process=========

const data ={
    labels: monthsOnly,
    // labels: ['januari','februari'],

   
  datasets: [{
    label: "Pendapatan Obat",
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
      data: valuesOnly,
  },
  {
    label: "Pendapatan Alkes",
      lineTension: 0.3,
      backgroundColor: "rgba(40, 167, 69,0.3)",
      borderColor: "rgba(40, 167, 69, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(40, 167, 69, 1)",
      pointBorderColor: "rgba(40, 167, 69, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(40, 167, 69, 1)",
      pointHoverBorderColor: "rgba(40, 167, 69, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: valuesOnly2,
    },
  {
    label: "Pendapatan Cek Kesehatan",
      lineTension: 0.3,
      backgroundColor: "rgba(23, 162, 184,0.3)",
      borderColor: "rgba(23, 162, 184, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(23, 162, 184, 1)",
      pointBorderColor: "rgba(23, 162, 184, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(23, 162, 184, 1)",
      pointHoverBorderColor: "rgba(23, 162, 184, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: valuesOnly3,
    }]
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