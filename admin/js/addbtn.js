
  $(document).ready(function() {
    $("#gfg").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#filter tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });


  const toggle = document.getElementById('toggle-btn');
  const form = document.getElementById('add-doctor');

  toggle.addEventListener('click', () => {
    if (form.style.display === "none") {
      form.style.display = "block";
    } else {
      form.style.display = "none";
    }
  })
