document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('btn-accept') || event.target.closest('.btn-accept')) {
            const button = event.target.closest('.btn-accept');
            const doctorId = button.getAttribute('data-doctorid');
            const userId = button.getAttribute('data-userid');

            if (confirm('Are you sure you want to verify this doctor?')) {
                fetch('verify_doctor.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ doctorId: doctorId, userId: userId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Doctor has been verified');
                        location.reload(); // Reload the page after successful verification
                    } else {
                        alert('Failed to verify doctor');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
    });
});



document.querySelectorAll('.description').forEach(description => {
    description.addEventListener('click', function() {
        this.classList.toggle('expanded');
    });
});
