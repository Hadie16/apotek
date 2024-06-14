
<script>
   
     (function () {
        // Add event listener for form submission
        document.getElementById('filterFormGrafik').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent form submission
            updateTable();
        });

        // Function to update the table based on user selection
        function updateTable() {
            var month = document.getElementById('month').value;
            var year = document.getElementById('year').value;
            var switchInput = document.getElementById('switchInput').value;

            // Send AJAX request to fetch data based on month and year
            $.ajax({
                url: '../laporan_penjualan/grafikFetchSelect.php',
                type: 'POST',
                data: { month: month, year: year, switchInput: switchInput },
                success: function (response) {
                       // Parse the JSON response to get the data
    // var datapa = JSON.parse(response);
    var dom="";
    if(switchInput=="obatBtn"){
      dom = switchInput.replace("obatBtn", "Obat");  
    }else{
        dom = switchInput.replace("alkesBtn", "Alat Kesehatan");
    }
 

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


    var h6Cont = "Grafik Penjualan "+dom+" Tertinggi Periode ("+date+" "+year+")";
    document.getElementById("h6Cont").innerHTML= h6Cont;
//echo $date; // output the date
}else{

  var h6Cont = "Grafik Penjualan "+dom+" Tertinggi Periode ("+year+")";
    document.getElementById("h6Cont").innerHTML= h6Cont;
}

// var datap =   8;           
function loadCanvas(datasss) {
  
    // Simulate an AJAX request to fetch the canvas element (replace with your actual AJAX call)
    setTimeout(function () {
      
        // Create a canvas element with a specific id
        var newCanvas = document.createElement("canvas");
        newCanvas.id = "myBarCharts2"; // Set the id to "myChart"

        // Append the canvas element to the chartContainer
        var chartContainer = document.getElementById("barChartsId");
        chartContainer.innerHTML = ""; // Clear any existing content
        chartContainer.appendChild(newCanvas);

        // Now that the canvas is in the DOM, you can use your charting library to render a chart
        // renderChart();
        // var ainz =  '<?php include 'testbar2.php' ?> ';
        // var testbar2Container = document.getElementById("testbar2Container");
        // testbar2Container.innerHTML = ainz; 
        

        (function () {

console.log('Script s working...');
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
 // Assuming 'data' contains 'labels' and 'datass' properties
 var labelsa = datasss.labelsssa;
    var datasa = datasss.datasssa;


const datas = {
  //  labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
   labels: labelsa,


datasets: [{
  label: 'Most Selling Products',
  backgroundColor: 'rgba(78, 115, 223, 0.8)', // You can change the color here
  borderColor: 'rgba(78, 115, 223, 1)', // You can change the color here
  // data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
  data:  datasa,


}],
}

//original code
// // Extracting the maximum value from the 'data' arrays of all datasets
// var maxValue = Math.max.apply(Math, datas.datasets.map(function(dataset) {
//     return Math.max.apply(Math, dataset.data);
// }));


// // Set some padding to the maximum value
// maxValue += 10;


var maxValue;

// Check if datas.datasets is not empty and contains valid numeric values
if (datas.datasets.length > 0 && datas.datasets.some(dataset => Array.isArray(dataset.data) && dataset.data.length > 0)) {
    // maxValue = Math.max.apply(Math, datas.datasets.map(function(dataset) {
    //     return Math.max.apply(Math, dataset.data.filter(value => typeof value === 'number' && isFinite(value)));
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

console.log(maxValue);


// Bar Chart Example
var ctx = document.getElementById("myBarCharts2");
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


})();
  
        // renderChart();
    }, 1000); // Simulate a delay, replace this with your actual AJAX call
   
 
}

// function renderChart() {
 
//       }



           // Call the loadCanvas function to load the chart with the data
loadCanvas(response);


                    // document.getElementById('tableContainer').innerHTML = response;
                    // document.getElementById('tableContainer').style.width = '100%';
               



                }
            }
            );
        }
    })();
    </script>