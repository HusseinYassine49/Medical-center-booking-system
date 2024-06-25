document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('btn-decline') || event.target.closest('.btn-decline')) {
            const button = event.target.closest('.btn-decline');
            const doctorId = button.getAttribute('data-doctorid');
            const userId = button.getAttribute('data-userid');

            if (confirm('Are you sure you want to decline this doctor?')) {
                fetch('decline_doctor.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ doctorId: doctorId, userId: userId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Doctor has been declined');
                        location.reload(); // Reload the page after successful decline
                    } else {
                        alert('Failed to decline doctor');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
    });
});
