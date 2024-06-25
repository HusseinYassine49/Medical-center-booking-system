function registerPatient(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    // Gather form data
    let fname = document.getElementById('doctor-Fname').value;
    let lname = document.getElementById('doctor-Lname').value;
    let dob = document.getElementById('doctor-dob').value;
    let gender = document.querySelector('select[name="gender"]').value;
    let email = document.getElementById('doctor-email').value;
    let password = document.getElementById('doctor-password').value;
    let confirmPassword = document.getElementById('doctor-confirm-password').value;


    let data = {
        fname: fname,
        lname: lname,
        dob: dob,
        gender: gender,
        email: email,
        password: password,
        'confirm-password': confirmPassword
    };

    $.ajax({
    url: 'A-U-Reg.php',
    type: 'POST',
    data: JSON.stringify(data),
    contentType: 'application/json',
    success: function(response) {
        // Parse the JSON response
        let responseData = JSON.parse(response);

        // Check if the insertion was successful
        if (responseData.success) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data inserted successfully'
            }).then(function() {
                window.location.href = 'admin-user-edit.php';
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Error: ' + responseData.message
            });
        }
    },
    error: function(xhr, status, error) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Error communicating with server'
        });
    }
});

    return false; // Prevent the form from submitting
}