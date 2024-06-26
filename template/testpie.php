
<script>
    (function() {
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';
<?php

$j = "localhost";
$j1 = "root";
$j4 = "";
$j3 = "mahabbah";

$connn = new mysqli($j, $j1, $j4, $j3);
if ($connn->connect_error) {
    die("Connection failed: " . $connn->connect_error);
}
$jojo = "SELECT SUM(total_biaya) AS total_price FROM cek_kesehatan WHERE YEAR(tanggal_cek_kesehatan) = YEAR(CURRENT_DATE())";
$koko = $connn->query($jojo);
// Store the sorted months in an array
$lolo = null;
while ($row = $koko->fetch_assoc()) {
$lolo=$row["total_price"];

}


$jojo2 = "SELECT SUM(total_harga) AS total_price2 FROM penjualan_alkes WHERE YEAR(tanggal_penjualan_alkes) = YEAR(CURRENT_DATE())";
$koko2 = $connn->query($jojo2);
// Store the sorted months in an array
$lolo2 = null;
while ($row = $koko2->fetch_assoc()) {
$lolo2=$row["total_price2"];
}


$jojo3 = "SELECT SUM(total_harga) AS total_price3 FROM penjualan_obat WHERE YEAR(tanggal_penjualan_obat) = YEAR(CURRENT_DATE())";
$koko3 = $connn->query($jojo3);
// Store the sorted months in an array
$lolo3 = null;
while ($row = $koko3->fetch_assoc()) {
$lolo3=$row["total_price3"];
}

// Close the database connection
$connn->close();

// Encode the months array as JSON and send it as the response
// echo json_encode($months);

?>
// console.log(<?php echo json_encode($lolo)?>);
// console.log(<?php echo json_encode($lolo2)?>);
// console.log(<?php echo json_encode($lolo3)?>);



const jj=<?php echo json_encode($lolo)?>;
const kk=<?php echo json_encode($lolo2)?>;
const ll=<?php echo json_encode($lolo3)?>;
const data ={
  
    labels: ["Obat-obatan", "Alat Kesehatan", "Cek Kesehatan"],
    datasets: [{
      data: [ll, kk, jj],
    //   data: [55, 30, 15],

      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
      label: "Pendapatan"
    }],
}

// Pie Chart Example
var ctxs = document.getElementById("myPieCharts");
var myPieChart = new Chart(ctxs, {
  type: 'doughnut',
  data,
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      // callbacks: {
      //   label: function(tooltipItem, chart) {
      //     var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
      //     return datasetLabel + ': Rp' + number_format(tooltipItem.yLabel)}}
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          var value = chart.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
          return datasetLabel + ': Rp' + number_format(value);
        }
      
    },
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

})();
  </script>
