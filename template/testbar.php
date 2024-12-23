<script>
    // console.log('Script is running...');
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
include '../connection.php';
// Your database query
$query = mysqli_query($con, 'SELECT a.id_obat,c.nama_obat, SUM(jumlah_detail_penjualan_obat) AS jumlah FROM detail_penjualan_obat as a join penjualan_obat as b on a.id_penjualan_obat=b.id_penjualan_obat join obat c on a.id_obat=c.id_obat WHERE MONTH(tanggal_penjualan_obat) = MONTH(CURRENT_DATE())
GROUP BY nama_obat
ORDER BY jumlah DESC
LIMIT 5');

// Initialize arrays to store labels and data
$labels = [];
$datass = [];

// Loop through the query results and populate the arrays
while ($row = mysqli_fetch_assoc($query)) {
  $labels[] = $row['nama_obat'];
  $datass[] = $row['jumlah'];
}
?>


const datas = {
  //  labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
   labels: <?php echo json_encode($labels); ?>,


datasets: [{
  label: 'Most Selling Products',
  backgroundColor: 'rgba(78, 115, 223, 0.8)', // You can change the color here
  borderColor: 'rgba(78, 115, 223, 1)', // You can change the color here
  // data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
  data:  <?php echo json_encode($datass); ?>,



}],
}

var maxValue;

// Check if datas.datasets is not empty and contains valid numeric values
if (datas.datasets.length > 0 && datas.datasets.some(dataset => Array.isArray(dataset.data) && dataset.data.length > 0)) {
  var maxValue = Math.max.apply(Math, datas.datasets.map(function(dataset) {
    return Math.max.apply(Math, dataset.data);
    }));
} else {
    // If datas.datasets is empty or contains no valid numeric values, set maxValue to a default value
    maxValue = 0; // Or any other default value you prefer
}

// Check if maxValue is finite before adding padding
if (isFinite(maxValue)) {
    // Set some padding to the maximum value
    maxValue += 10;
}

// console.log(maxValue);




// Bar Chart Example
var ctx = document.getElementById("myBarCharts");
var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: datas,
  options:{
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
          unit: 'month'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 6
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: maxValue,
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '' + number_format(value);
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
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
        }
      }
    },
},

});

</script>