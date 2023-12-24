
function countdownTimer(seconds) {
    var countdownElement = document.getElementById('countdown');
    var remainingTime = parseInt(localStorage.getItem('remainingTime'), 10);

    if (!remainingTime || isNaN(remainingTime) || remainingTime <= 0) {
        remainingTime = parseInt(seconds);
        localStorage.setItem('remainingTime', remainingTime);
    }

    function updateCountdown() {
        remainingTime -= 1;

        if (remainingTime <= 0) {
            clearInterval(countdownInterval);
            countdownElement.style.display = 'none';
            countdownElement.innerHTML = "";
            resendForm.classList.remove('hidden');
            localStorage.setItem('remainingTime', 'resend');
        } else {
            countdownElement.innerHTML = remainingTime + ' ثانیه تا دریافت مجدد';
            localStorage.setItem('remainingTime', remainingTime);
        }
    }

    var countdownInterval = setInterval(updateCountdown, 1000);
}