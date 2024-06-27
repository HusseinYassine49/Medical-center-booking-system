const morningText = document.getElementById('morning-text');
const patientNameElement = document.getElementById('patient-name');
const welcomeText = document.getElementById('welcome-text');

let morningMessage = "Good Morning, ";
let messageIndex = 0;
let typingSpeed = 100;

function typeMorningMessage() {
    if (messageIndex < morningMessage.length) {
        morningText.textContent += morningMessage.charAt(messageIndex);
        messageIndex++;
        setTimeout(typeMorningMessage, typingSpeed);
    } else {
        typePatientName();
    }
}

function typePatientName() {
    messageIndex = 0; // Reset for patient name
    function type() {
        if (messageIndex < patientName.length) {
            patientNameElement.textContent += patientName.charAt(messageIndex);
            messageIndex++;
            setTimeout(type, typingSpeed);
        } else {
            welcomeText.style.display = 'block';
        }
    }
    type();
}

typeMorningMessage();


$(document).ready(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultDate: new Date(),
        navLinks: true,
        editable: false,
        eventLimit: true,
        events: []
    });
});




const modal = $('#appointmentModal');
const addAppointmentBtn = $('#addAppointmentBtn');
const closeModal = $('.close');
const cancelForm = $('#cancelForm');
const appointmentForm = $('#appointmentForm');
const modalTitle = $('#modalTitle');
const appointmentIdInput = $('#appointmentId');

addAppointmentBtn.on('click', function() {
    modalTitle.text('Add Appointment');
    appointmentForm.trigger('reset');
    appointmentIdInput.val('');
});

closeModal.on('click', function() {
    modal.modal('hide');
});

cancelForm.on('click', function() {
    modal.modal('hide');
});

window.onclick = function(event) {
    if (event.target === modal[0]) {
        modal.modal('hide');
    }
};

appointmentForm.on('submit', function(event) {
    event.preventDefault();
    const appointmentId = appointmentIdInput.val();
    const doctor = $('#doctor').val();
    const specialty = $('#specialty').val();
    const date = $('#date').val();
    const time = $('#time').val();
    const status = $('#status').val();

    if (appointmentId) {
        editAppointment(appointmentId, doctor, specialty, date, time, status);
    } else {
        addAppointment(doctor, specialty, date, time, status);
    }
    modal.modal('hide');
});

function addAppointment(doctor, specialty, date, time, status) {
    const tableBody = $('#appointmentTableBody');
    const newRow = $(`
        <tr>
            <td>${doctor}</td>
            <td>${specialty}</td>
            <td>${date}</td>
            <td>${time}</td>
            <td class="status-${status.toLowerCase()}">${status}</td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="showEditForm(this)">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteAppointment(this)">Delete</button>
            </td>
        </tr>
    `);
    tableBody.append(newRow);

    // Add the event to FullCalendar
    $('#calendar').fullCalendar('renderEvent', {
        title: doctor,
        start: date + 'T' + time,
        backgroundColor: getStatusColor(status)
    });
}

function getStatusColor(status) {
    switch (status.toLowerCase()) {
        case 'active':
            return '#28a745';
        case 'upcoming':
            return '#ffc107';
        case 'completed':
            return '#007bff';
        default:
            return '#6c757d';
    }
}


function showEditForm(button) {
    const row = $(button).closest('tr');
    const cells = row.find('td');
    const doctor = cells.eq(0).text();
    const specialty = cells.eq(1).text();
    const date = cells.eq(2).text();
    const time = cells.eq(3).text();
    const status = cells.eq(4).text();

    modalTitle.text('Edit Appointment');
    $('#doctor').val(doctor);
    $('#specialty').val(specialty);
    $('#date').val(date);
    $('#time').val(time);
    $('#status').val(status);
    appointmentIdInput.val(row.index() + 1);
    modal.modal('show');
}

function editAppointment(appointmentId, doctor, specialty, date, time, status) {
    const tableBody = $('#appointmentTableBody');
    const row = tableBody.find('tr').eq(appointmentId - 1);
    const cells = row.find('td');
    cells.eq(0).text(doctor);
    cells.eq(1).text(specialty);
    cells.eq(2).text(date);
    cells.eq(3).text(time);
    cells.eq(4).text(status).attr('class', `status-${status.toLowerCase()}`);


    const calendar = $('#calendar').fullCalendar('getCalendar');
    const event = calendar.clientEvents()[appointmentId - 1];
    event.title = doctor;
    event.start = date + 'T' + time;
    event.backgroundColor = getStatusColor(status);
    calendar.updateEvent(event);
}

function deleteAppointment(button) {
    const row = $(button).closest('tr');
    const appointmentId = row.index() + 1;
    const tableBody = $('#appointmentTableBody');


    const calendar = $('#calendar').fullCalendar('getCalendar');
    const event = calendar.clientEvents((calEvent) => calEvent.id === String(appointmentId))[0]; // Find event by ID
    if (event) {
        event.remove();
    }

    row.remove();
}