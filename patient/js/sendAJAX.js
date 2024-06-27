document.getElementById('submit').addEventListener('click', function(event) {
    // Prevent default form submission
    event.preventDefault();

    // Gather form data
    var userID = document.getElementById('userID').value;
    var date = document.getElementById('date').value;
    var description = document.getElementById('description').value;
    var clinic = document.getElementById('clinic').value;
    var doctor = document.getElementById('doctor').value;
    var startTime = document.getElementById('start_time').value;

    var formData = new FormData();
    formData.append('userID', userID);
    formData.append('date_', date);
    formData.append('description', description);
    formData.append('clinic', clinic);
    formData.append('doctor', doctor);
    formData.append('start_time', startTime);

    Swal.fire({
        icon: 'info',
        title: 'Are you sure?',
        text: 'Confirm appointment creation.',
        showCancelButton: true,
        confirmButtonText: 'Yes, create appointment',
        cancelButtonText: 'Cancel'
    }).then(function(result) {
        if (result.isConfirmed) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_appointment.php', true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 400) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            allowOutsideClick: false,
                            confirmButtonText: 'OK'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'HTTP error occurred: ' + xhr.status
                    });
                }
            };
            xhr.onerror = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Connection error. Please try again later.'
                });
            };
            xhr.send(formData);
        }
    });
});

function selectAppointment(slot) {
    // Deselect any previously selected slot
    document.querySelectorAll('.time-slot').forEach(s => {
        s.classList.remove('selected');
        s.classList.add('unavailable');
    });

    // Select the clicked slot
    slot.classList.add('selected');

    const selectedDay = slot.parentElement.getAttribute('data-day');
    const selectedTime = slot.getAttribute('data-time');

    // Calculate the nearest future date for the selected day
    const currentDate = new Date();
    const currentDayOfWeek = currentDate.getDay(); // 0 (Sunday) to 6 (Saturday)

    // Get the index of the selected day in daysOfWeek array
    const daysOfWeek = ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"];
    const selectedDayIndex = daysOfWeek.indexOf(selectedDay);

    // Calculate daysToAdd to get the nearest future occurrence of selectedDay
    let daysToAdd = selectedDayIndex - currentDayOfWeek;
    if (daysToAdd <= 0) {
        daysToAdd += 7; // Add 7 days to get the future occurrence of the selected day
    }

    const nearestDate = new Date(currentDate);
    nearestDate.setDate(currentDate.getDate() + daysToAdd);

    // Format nearestDate to YYYY-MM-DD
    const year = nearestDate.getFullYear();
    const month = String(nearestDate.getMonth() + 1).padStart(2, '0');
    const day = String(nearestDate.getDate()).padStart(2, '0');
    const nearestDateString = `${year}-${month}-${day}`;

    // Set the nearest date and selected time into the input fields
    document.getElementById('date').value = nearestDateString;
    document.getElementById('start_time').value = selectedTime;
    const doctorSelect = document.getElementById('doctor');
    const selectedDoctorOption = doctorSelect.options[doctorSelect.selectedIndex];
    const doctorID = selectedDoctorOption.value;
    const description = document.getElementById('description').value;

    // Log the appointment details
    console.log('Selected Date:', nearestDateString);
    console.log('Selected Time:', selectedTime);
    console.log('Description:', description);
    console.log('Doctor ID:', doctorID);

    // Apply select effect to the clicked slot
    slot.classList.remove('unavailable');
    slot.classList.add('selected');
}

function clearCalendar() {
    $('.time-slot').removeClass('available').addClass('unavailable');
}

function clear_input() {
    $('#form_create_appointment')[0].reset(); 
    $('.time-slot').removeClass('selected').addClass('unavailable'); 
}
