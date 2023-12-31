function updateCountdown() {
    var currentDate = new Date();
    var remainingTime = expirationDate - currentDate;
    var remainingDays = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
    var countdownElement = document.getElementById('countdown');
    countdownElement.textContent = remainingDays + ' Hari ';
  
    if (remainingDays <= 0) {
      countdownElement.style.backgroundColor = 'black';
      countdownElement.textContent = 'Expired';
      clearInterval(countdownInterval);
    } else if (remainingDays <= 10) {
      countdownElement.style.backgroundColor = 'red';
    } else if (remainingDays <= 100) {
      countdownElement.style.backgroundColor = 'yellow';
    } else {
      countdownElement.style.backgroundColor = 'green';
    }
  }
  
  // Update the countdown initially and every second
  updateCountdown();
  var countdownInterval = setInterval(updateCountdown, 1000);
  