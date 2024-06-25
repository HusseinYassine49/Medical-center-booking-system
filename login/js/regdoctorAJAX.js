function registerDoctor(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    // Gather form data
    let fname = document.getElementById('doctor-Fname').value;
    let lname = document.getElementById('doctor-Lname').value;
    let dob = document.getElementById('doctor-dob').value;
    let gender = document.querySelector('select[name="doctor-gender"]').value;
    let email = document.getElementById('doctor-email').value;
    let password = document.getElementById('doctor-password').value;
    let confirmPassword = document.getElementById('doctor-confirm-password').value;
    let accept = document.getElementById('accept2').checked;

    let data = {
        fname: fname,
        lname: lname,
        dob: dob,
        gender: gender,
        email: email,
        password: password,
        'confirm-password': confirmPassword,
        accept: accept
    };

    $.ajax({
        url: 'doctor-register.php',
        type: 'POST',
        data: JSON.stringify(data),
        contentType: 'application/json',
        success: function(response) {
            try {
                let parsedResponse = JSON.parse(response);
                if (parsedResponse.success) {
                    let userID = parsedResponse.userID;

                    // Redirect to apply.php with userID
                    window.location.href = '../login/apply.php?userID=' + userID;
                } else if (parsedResponse.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: parsedResponse.error
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Unexpected response from server'
                    });
                }
            } catch (error) {
                console.error("Error parsing response:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Unexpected response format from server'
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error communicating with server'
            });
        }
    });

    return false;
}
