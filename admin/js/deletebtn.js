document.addEventListener('DOMContentLoaded', function() {
  document.addEventListener('click', function(event) {
      if (event.target.classList.contains('btn-trash') || event.target.closest('.btn-trash')) {
          const row = event.target.closest('tr');
          const userId = row.querySelector('.user-id').innerText;

          if (confirm('Are you sure you want to delete this Data?')) {
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
});
