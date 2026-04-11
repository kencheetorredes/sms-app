const gatewaySelect = document.getElementById('gatewaySelect');
const twilioFields = document.getElementById('twilioFields');
const semaphoreFields = document.getElementById('semaphoreFields');

gatewaySelect.addEventListener('change', function () {
    if (this.value == 2) {
        twilioFields.style.display = 'block';
        semaphoreFields.style.display = 'none';
    } else {
        twilioFields.style.display = 'none';
        semaphoreFields.style.display = 'block';
    }
});
            