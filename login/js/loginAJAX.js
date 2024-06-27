function login(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    let email = document.getElementById('login-email').value;
    let password = document.getElementById('login-password').value;

    const loginData = {
        'login-email': email,
        'login-password': password
    };

    // Send the data using AJAX
    $.ajax({
        url: 'login-verification.php',
        type: 'POST',
        data: loginData,
        dataType: 'json', // Expect JSON response
        success: function(response) {
            if (response.success) {
                // Redirect based on the user type
                if (response.success === 'Admin login successful') {
                    window.location.href = '../admin/admin-dashboard.php?userID=' + response.userID;
                } else if (response.success === 'User login successful') {
                    window.location.href = '../patient/patient-dahboard.php?userID=' + response.userID;
                } else if (response.success === 'Doctor login successful') {
                    window.location.href = '../doctor/doctorDashboard.php';
                }else if (response.success === 'Doctor not verified') {
                    window.location.href = '../login/apply.php';
                }else if (response.success === 'Doctor havent applied yet') {
                    window.location.href = '../login/apply.php';
                }
            } else if (response.error) {
                // Handle login errors
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.error
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Unexpected response from server'
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error: ' + xhr.responseText
            });
        }
    });

    return false; // Prevent the form from submitting normally
}
