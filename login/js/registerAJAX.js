function register(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    // Gather form data
    let fname = document.getElementById('Register-Fname').value;
    let lname = document.getElementById('Register-Lname').value;
    let dob = document.getElementById('dob').value;
    let gender = document.querySelector('select[name="gender"]').value;
    let email = document.getElementById('Register-Email').value;
    let password = document.getElementById('Register-Password').value;
    let confirmPassword = document.getElementById('Confirm-Password').value;
    let accept = document.getElementById('accept1').checked;


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
        url: 'reg-valid.php',
        type: 'POST',
        data: JSON.stringify(data),
        contentType: 'application/json', 
        success: function(response) {
            try {
                let parsedResponse = JSON.parse(response);
                if (parsedResponse.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration Successful',
                        text: parsedResponse.success
                    }).then(() => {
                        window.location.href = '../index.html';
                    });
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
