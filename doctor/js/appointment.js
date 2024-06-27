$(document).ready(function() {
    $('.time-slot').click(function() {
      var isSelected = $(this).hasClass('selected');
      $(this).toggleClass('selected');

      // Get the day and time from the clicked slot
      var day = $(this).data('day');
      var time = $(this).data('time');

      // Update selected time display
      var selectedTimeDiv = $(this).closest('.day-column').find('.selected-time');
      if (isSelected) {
        selectedTimeDiv.find('div[data-time="' + time + '"]').remove();
      } else {
        selectedTimeDiv.append('<div data-time="' + time + '">' + dateFormat(new Date('1970-01-01T' + time + 'Z')) + '</div>');
      }
    });

    function dateFormat(date) {
      var hours = date.getUTCHours();
      var minutes = date.getUTCMinutes();
      var ampm = hours >= 12 ? 'PM' : 'AM';
      hours = hours % 12;
      hours = hours ? hours : 12; // the hour '0' should be '12'
      minutes = minutes < 10 ? '0' + minutes : minutes;
      var strTime = hours + ':' + minutes + ' ' + ampm;
      return strTime;
    }

    // Example: Save selected times to database
    $('.save-btn').click(function() {
      var selectedTimes = [];
      $('.selected-time div').each(function() {
        var day = $(this).closest('.day-column').find('h4').text().trim();
        var time = $(this).data('time');
        selectedTimes.push({day: day, time: time});
      });

      // Send selectedTimes array to your server-side script for saving to database
      $.ajax({
        type: 'POST',
        url: 'saveAvailability.php',
        data: {times: selectedTimes},
        success: function(response) {
          alert('Availability saved successfully!');
        },
        error: function(error) {
          alert('Error saving availability.');
        }
      });
    });
  });