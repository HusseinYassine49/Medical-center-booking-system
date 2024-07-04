document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('btn-trash') || event.target.closest('.btn-trash')) {
            const row = event.target.closest('tr');
            const userId = row.querySelector('.user-id').innerText;

            console.log('User ID:', userId); // Debugging: Log the user ID

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you really want to delete this data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('delete-doctor.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ id: userId })
                    })
                    .then(response => {
                        console.log('Response:', response); // Debugging: Log the response
                        return response.text().then(text => {
                            try {
                                return JSON.parse(text);
                            } catch (error) {
                                throw new Error('Invalid JSON: ' + text);
                            }
                        });
                    })
                    .then(data => {
                        console.log('Data:', data); // Debugging: Log the parsed JSON data
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                'User has been deleted.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was an error deleting the user: ' + data.error,
                                'error'
                            );
                            console.error('Error deleting user:', data.error);
                        }
                    })
                    .catch(error => {
                        Swal.fire(
                            'Error!',
                            'There was an error deleting the user.',
                            'error'
                        );
                        console.error('Error:', error);
                    });
                }
            });
        }
    });
});
