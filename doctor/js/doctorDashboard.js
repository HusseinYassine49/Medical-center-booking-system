const monthYearElement = document.getElementById('monthYear');
const datesElement = document.getElementById('dates');
const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');
const clndr = document.getElementById('page1');
const modal = document.getElementById('modal');
const modalAppointments = document.getElementById('modal-appointments');
const modalCloseBtn = document.querySelector('.close-btn');

let currentDate = new Date();

const updateCalendar = () => {
    const currentYear = currentDate.getFullYear();
    const currentMonth = currentDate.getMonth();

    const firstDay = new Date(currentYear, currentMonth, 1);
    const lastDay = new Date(currentYear, currentMonth + 1, 0);
    const totalDays = lastDay.getDate();
    const firstDayIndex = firstDay.getDay();
    const lastDayIndex = lastDay.getDay();

    const monthYearString = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });
    monthYearElement.textContent = monthYearString;

    let datesHTML = '';

    for (let i = firstDayIndex; i > 0; i--) {
        const prevDate = new Date(currentYear, currentMonth, 0 - i + 1);
        datesHTML += `<div class="date inactive" data-date="${prevDate.toISOString().split('T')[0]}"><div>${prevDate.getDate()}</div></div>`;
    }

    for (let i = 1; i <= totalDays; i++) {
        const date = new Date(currentYear, currentMonth, i);
        const dateString = `${currentYear}-${(currentMonth + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`;
        const isToday = date.toDateString() === new Date().toDateString();
        const isPast = date < new Date() && !isToday;
        const activeClass = isToday ? 'active' : '';
        const pastClass = isPast ? 'inactive' : '';
        datesHTML += `
            <div class="date ${activeClass} ${pastClass}" data-date="${dateString}">
                <div>${i}</div>
            </div>`;
    }

    for (let i = 1; i <= 7 - lastDayIndex - 1; i++) {
        const nextDate = new Date(currentYear, currentMonth + 1, i);
        datesHTML += `<div class="date inactive" data-date="${nextDate.toISOString().split('T')[0]}"><div>${nextDate.getDate()}</div></div>`;
    }

    datesElement.innerHTML = datesHTML;

    const dateElements = document.querySelectorAll('.date');
    dateElements.forEach(dateElement => {
        if (!dateElement.classList.contains('inactive')) {
            dateElement.addEventListener('click', () => {
                const date = dateElement.getAttribute('data-date');
                fetchAppointments(date);
            });
        }
    });
};

const fetchAppointments = (date) => {
    $.ajax({
        url: 'fetchAppointments.php',
        type: 'get',
        data: { date: date },
        success: function (response) {
            try {
                const appointments = JSON.parse(response);
                displayAppointments(appointments);
                modal.style.display = 'block';
            } catch (error) {
                console.error('Error parsing JSON:', error);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error fetching appointments:', error);
        }
    });
};

const displayAppointments = (appointments = []) => {
    let appointmentsHTML = '';

    if (Array.isArray(appointments) && appointments.length > 0) {
        appointments.forEach(app => {
            appointmentsHTML += `
                <div class="appointment">
                <i class="fas fa-clock"></i>
                 <strong class="info">${app.time}</strong>
                 <strong><span style="margin-right:1%; margin-left:1%">||<span></strong>
                 <strong class="info">${app.patient} ${app.patientlastname}</strong>
                 
                 <div class="right-icons">
                     <i class="fas fa-user user" data-user-id="${app.user_id}"></i>
                     <i class="fas fa-times cancel" data-appointment-id="${app.appointment_id}"></i>
                 </div>
                 
                 <br>
                </div>
            `;
        });
    } else {
        appointmentsHTML = '<div class="no-appointments"><strong>No appointments found for this day.</strong></div>';
    }
    modalAppointments.innerHTML = appointmentsHTML;

    const userIcons = document.querySelectorAll('.user');
    userIcons.forEach(icon => {
        icon.addEventListener('click', () => {
            const userId = icon.getAttribute('data-user-id');
            window.location.href = `doctorPatients.php?id=${userId}`;
        });
    });

    const cancelButtons = document.querySelectorAll('.cancel');
    cancelButtons.forEach(button => {
        button.addEventListener('click', () => {
            const appointmentId = button.getAttribute('data-appointment-id');
            cancelAppointment(appointmentId);
        });
    });
};

const cancelAppointment = (appointmentId) => {
    $.ajax({
        url: 'cancel_appointment.php',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ appointment_id: appointmentId }),
        success: function (response) {
            const selectedDate = modalAppointments.getAttribute('data-date');
            fetchAppointments(selectedDate);
            updateCalendar();
        },
        error: function (xhr, status, error) {
            console.error('Error cancelling appointment:', error);
            alert('Error cancelling appointment.');
        }
    });
};

prevBtn.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    updateCalendar();
    clndr.classList.add("flipped");
});

nextBtn.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    updateCalendar();
    clndr.classList.add("flipped");
});

modalCloseBtn.addEventListener('click', () => {
    modal.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

updateCalendar();

$(document).ready(function () {

    function fetchAppointments() {
        $.ajax({
            url: 'fetch_appointments.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response && response.length > 0) {
                    var appointmentsHtml = '';
                    response.forEach(function (appointment) {
                        appointmentsHtml += '<tr>';
                        appointmentsHtml += '<td data-label="Name"><a href="doctorPatients.php?id=' + appointment.userID + '">' + appointment.Fname + ' ' + appointment.Lname + '</a></td>';
                        appointmentsHtml += '<td data-label="Date">' + appointment.date_ + '</td>';
                        appointmentsHtml += '<td data-label="Time">' + appointment.time + '</td>';
                        appointmentsHtml += '<td><button class="approve-btn" data-appointment-id="' + appointment.id + '"><i class="fas fa-check"></i></button></td>';
                        appointmentsHtml += '<td><button class="cancel-btn" data-appointment-id="' + appointment.id + '"><i class="fas fa-times"></i></td>';
                        appointmentsHtml += '</tr>';
                    });

                    $('#appointmentsBody').html(appointmentsHtml);
                } else {
                    $('#appointmentsBody').html('<tr><td colspan="5">No pending appointments found.</td></tr>');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching appointments:', error);
            }
        });
    }

    $(document).on('click', '.approve-btn', function () {
        var appointmentId = $(this).data('appointment-id');
        $.ajax({
            url: 'approve_appointment.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ id: appointmentId }),
            success: function (response) {
                console.log(response)
                fetchAppointments();
            },
            error: function (xhr, status, error) {
                console.error('Error approving appointment:', error);
                alert('Error approving appointment. Please check console for details.');
            }
        });
    });

    $(document).on('click', '.cancel-btn', function () {
        var appointmentId = $(this).data('appointment-id');
        $.ajax({
            url: 'cancel_appointment.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ appointment_id: appointmentId }),
            success: function (response) {
                console.log(response)
                fetchAppointments();
            },
            error: function (xhr, status, error) {
                console.error('Error cancelling appointment:', error);
                alert('Error cancelling appointment.');
            }
        });
    });

    fetchAppointments();
});
