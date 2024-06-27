$(document).ready(function() {
    function updateCurrentDate() {
        const daysOfWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

        const now = new Date();
        const today = {
            dayOfWeek: daysOfWeek[now.getDay()],
            month: monthsOfYear[now.getMonth()],
            dayOfMonth: now.getDate(),
            year: now.getFullYear()
        };

        $('#month').text(today.month);
        $('#year').text(today.year);

        // Calculate the start of the current week (Monday)
        const dayOffset = (now.getDay() + 6) % 7; // Make Sunday (0) -> 6, Monday (1) -> 0, ..., Saturday (6) -> 5
        const startOfWeek = new Date(now);
        startOfWeek.setDate(now.getDate() - dayOffset);

        $('.date-label').each(function(index) {
            const currentDate = new Date(startOfWeek.getFullYear(), startOfWeek.getMonth(), startOfWeek.getDate() + index);
            const dayOfWeek = daysOfWeek[index];
            const month = monthsOfYear[currentDate.getMonth()];
            const dayOfMonth = currentDate.getDate();
            const isoDate = currentDate.toISOString().split('T')[0];

            $(this).text(`${dayOfWeek} ${month} ${dayOfMonth}`);
            $(this).parent().attr('data-date', isoDate); // Store the full date in ISO format
            $(this).parent().attr('id', dayOfWeek); // Assign dayOfWeek as ID
        });
    }

    updateCurrentDate();
});

document.addEventListener('DOMContentLoaded', function() {
    // Attach click event listener to all time slots
    document.querySelectorAll('.time-slot').forEach(slot => {
        slot.addEventListener('click', function() {
            selectAppointment(slot);
        });
    });
});


function updateDoctors() {
    var departmentId = $('#clinic').val();

    $.ajax({
        type: 'POST',
        url: 'get_doctors.php',
        data: {
            department_id: departmentId
        },
        dataType: 'json',
        success: function(response) {
            var doctorSelect = $('#doctor');
            doctorSelect.empty();
            doctorSelect.append('<option value="" disabled selected>Select Doctor</option>');

            response.forEach(function(doctor) {
                doctorSelect.append('<option value="' + doctor.DoctorID + '">' + doctor.Fname + ' ' + doctor.Lname + '</option>');
            });
        }
    });
}

function fetchDoctorAvailability() {
    var doctorId = $('#doctor').val();
    var selectedDate = $('#date').val(); // Get selected date from the date input

    $.ajax({
        type: 'POST',
        url: 'get_doctor_availability.php',
        data: {
            doctor_id: doctorId,
            selected_date: selectedDate
        },
        dataType: 'json',
        success: function(response) {
            if (response.length === 0) {
                alert('Doctor Not Available');
                clearCalendar();
            } else {
                updateCalendar(response);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching availability:', error);
        }
    });
}




function updateCalendar(availability) {
    $('.time-slot').addClass('unavailable'); // Reset all time slots to unavailable initially

    availability.forEach(function (slot) {
        var day = slot.day;
        var startTime = slot.start_time;
        var endTime = slot.end_time;

        $('.time-slot[data-day="' + day + '"]').each(function () {
            var slotTime = $(this).data('time');
            var slotHour = parseInt(slotTime.split(':')[0]);
            var slotMinute = parseInt(slotTime.split(':')[1]);
            var startHour = parseInt(startTime.split(':')[0]);
            var startMinute = parseInt(startTime.split(':')[1]);
            var endHour = parseInt(endTime.split(':')[0]);
            var endMinute = parseInt(endTime.split(':')[1]);

            // Check if the current slot time falls within the doctor's availability window
            if ((slotHour > startHour || (slotHour === startHour && slotMinute >= startMinute)) &&
                (slotHour < endHour || (slotHour === endHour && slotMinute <= endMinute))) {
                $(this).removeClass('unavailable').addClass('available');
            }
        });
    });
}


$('#doctor').change(function () {
    fetchDoctorAvailability();
});