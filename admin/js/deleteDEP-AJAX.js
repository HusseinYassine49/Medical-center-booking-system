document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('btn-trash') || event.target.closest('.btn-trash')) {
            const row = event.target.closest('tr');
            const departmentId = row.querySelector('.user-id').innerText; // Corrected to '.user-id'

            console.log('Department ID:', departmentId); // Debugging: Log the department ID

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you really want to delete this department?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('delete-department.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ id: departmentId })
                    })
                    .then(response => {
                        console.log('Response:', response); // Debugging: Log the response
                        return response.json();
                    })
                    .then(data => {
                        console.log('Data:', data); // Debugging: Log the parsed JSON data
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                'Department has been deleted.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was an error deleting the department: ' + data.error,
                                'error'
                            );
                            console.error('Error deleting department:', data.error);
                        }
                    })
                    .catch(error => {
                        Swal.fire(
                            'Error!',
                            'There was an error deleting the department.',
                            'error'
                        );
                        console.error('Error:', error);
                    });
                }
            });
        }
    });
});
