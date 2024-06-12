<<<<<<< HEAD

debugger
document.addEventListener('click', function(event) {
  if (event.target.classList.contains('btn-trash')) {
    const row = event.target.closest('tr');
    const userId = row.querySelector('.user-id').innerText; 

    if (confirm('Are you sure you want to delete this patient?')) {
      fetch('delete-user.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: userId }) 
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          console.log('User deleted successfully');
          window.location.reload();

        } else {
          console.error('Error deleting user:', data.error);
        }
      })
      .catch(error => console.error('Error:', error));
    }
  }
});
=======
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-trash').forEach(button => {
      button.addEventListener('click', function() {
        const row = this.closest('tr');
        const userId = row.querySelector('td[data-label="Patient ID"]').innerText;

        if (confirm('Are you sure you want to delete this patient?')) {
          fetch('delete-user.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: userId })
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              row.remove();
            } else {
              alert('Error deleting patient');
            }
          })
          .catch(error => console.error('Error:', error));
        }
      });
    });
  });
  
>>>>>>> ali
