document.getElementById('doctor-register-form').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent the form from submitting normally

    // Get form data
    const formData = new FormData(this);

    // Convert form data to URL parameters
    const urlParams = new URLSearchParams(formData).toString();

    // Redirect to apply.php with form data appended to the URL
    window.location.href = 'apply.php?' + urlParams;
});