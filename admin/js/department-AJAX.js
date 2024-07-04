function departmentInsertion(event) {
    event.preventDefault(); 

    // Gather form data
    let name = document.getElementById('department-name').value.trim();
    let description = document.getElementById('department-description').value.trim();
    let icon = document.getElementById('department-icon').value.trim(); // Get icon value

    // Log the values to check
    console.log("Name:", name);
    console.log("Description:", description);
    console.log("Icon:", icon);

    // Input validation
    if (name === '' || description === '' || icon === '') {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'All fields are required.'
        });
        return false; // Prevent the form from submitting
    }

    let data = {
        name: name,
        description: description,
        icon: icon // Add icon to data object
    };

    $.ajax({
        url: 'depart-Reg.php',
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
                    text: responseData.message
                }).then(function() {
                    window.location.href = 'admin-department.php';
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
