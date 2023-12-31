
  // Get the expiration date from the server-side
var expirationDate = new Date(expirationDate); // Replace with the actual expiration date

function updateCountdown() {
  // Get the current date and time
  var currentDate = new Date();

  // Calculate the remaining time in milliseconds
  var remainingTime = expirationDate - currentDate;

  // Convert the remaining time to days, hours, minutes, and seconds
  var remainingDays = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
  // var hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  // var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
  // var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
  var countdownElement = document.getElementById('countdown');
  // Update the countdown display on the webpage
  countdownElement.textContent = remainingDays + ' Hari ';
  // document.getElementById('countdown').textContent = days + ' days, ' + hours + ' hours, ' + minutes + ' minutes, ' + seconds + ' seconds';
  if (remainingDays <= 0) {
    countdownElement.style.backgroundColor = 'black';
    countdownElement.textContent = 'Expired';
    clearInterval(countdownInterval); // Stop the countdown
  } else if (remainingDays <= 10) {
    countdownElement.style.backgroundColor = 'red';
  } else if (remainingDays <= 100) {
    countdownElement.style.backgroundColor = 'yellow';
  } else {
    countdownElement.style.backgroundColor = 'green';
  }
}


  // Check if the expiration date has passed
//   if (remainingTime <= 0) {
//     document.getElementById('countdown').textContent = 'Expired';
//     clearInterval(countdownInterval); // Stop the countdown
//   }
// }

// Update the countdown initially and every second
updateCountdown();
var countdownInterval = setInterval(updateCountdown, 1000);




// Get the expiration date from the server-side and update countdown for each row



// Define yourDataArray with the relevant data


// yourDataArray.forEach(function(data) {
//   var expirationDate = new Date(data.tanggal_kadaluarsa);

//   function updateCountdown() {
//     var currentDate = new Date();
//     var remainingTime = expirationDate - currentDate;
//     var remainingDays = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
//     var countdownElement = document.getElementById('countdown_' + data.id);
//     countdownElement.textContent = remainingDays + ' Hari ';

//     if (remainingDays <= 0) {
//       countdownElement.style.backgroundColor = 'black';
//       countdownElement.textContent = 'Expired';
//       clearInterval(countdownInterval);
//     } else if (remainingDays <= 10) {
//       countdownElement.style.backgroundColor = 'red';
//     } else if (remainingDays <= 100) {
//       countdownElement.style.backgroundColor = 'yellow';
//     } else {
//       countdownElement.style.backgroundColor = 'green';
//     }
//   }

//   updateCountdown();
//   var countdownInterval = setInterval(updateCountdown, 1000);
// });

