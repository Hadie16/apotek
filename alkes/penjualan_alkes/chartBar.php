

<script>
// Get the table element
const table = document.getElementById("viewPenjualanObat");

// Arrays to store labels (categories) and data values
const labels = [];
const data = [];

// Loop through the table rows (skip the header row)
for (let i = 1; i < table.rows.length; i++) {
  const row = table.rows[i];
  const category = row.cells[0].textContent;
  const value = parseInt(row.cells[1].textContent);
  
  labels.push(category);
  data.push(value);
}

// Create a new bar chart using Chart.js
const ctx = document.getElementById("myChartPNM").getContext("2d");
const myChart = new Chart(ctx, {
  type: "bar",
  data: {
    labels: labels,
    datasets: [{
      label: "Values",
      data: data,
      backgroundColor: "rgba(54, 162, 235, 0.6)",
      borderColor: "rgba(54, 162, 235, 1)",
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
</script>
