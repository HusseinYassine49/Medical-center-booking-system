document.addEventListener('DOMContentLoaded', function () {
    var today = new Date();
    var currentMonth = today.getMonth();
    var currentYear = today.getFullYear();

    displayCalendar(currentMonth, currentYear);

    function displayCalendar(month, year) {
        var firstDay = new Date(year, month).getDay();
        var daysInMonth = new Date(year, month + 1, 0).getDate();
        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        document.getElementById('month').innerHTML = monthNames[month];
        document.getElementById('year').innerHTML = year;

        var tbody = document.getElementById('days');
        tbody.innerHTML = '';

        var date = 1;
        for (var i = 0; i < 6; i++) {
            var row = document.createElement('tr');

            for (var j = 0; j < 7; j++) {
                if (i === 0 && j < firstDay) {
                    var cell = document.createElement('td');
                    var cellText = document.createTextNode('');
                    cell.appendChild(cellText);
                    row.appendChild(cell);
                } else if (date > daysInMonth) {
                    break;
                } else {
                    var cell = document.createElement('td');
                    var cellText = document.createTextNode(date);
                    cell.appendChild(cellText);
                    row.appendChild(cell);
                    date++;
                }
            }

            tbody.appendChild(row);
        }
    }

    function previous() {
        currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
        currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
        displayCalendar(currentMonth, currentYear);
    }

    function next() {
        currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
        currentMonth = (currentMonth + 1) % 12;
        displayCalendar(currentMonth, currentYear);
    }

    document.getElementById('previous').addEventListener('click', previous);
    document.getElementById('next').addEventListener('click', next);
});


    function makeAppointment() {
        var date = document.getElementById('date').value;
        var description = document.getElementById('description').value;
        var startTime = document.getElementById('start_time').value;
        var endTime = document.getElementById('end_time').value;
        var clinic = document.getElementById('clinic').value;
        var doctor = document.getElementById('doctor').value;
        var originalDatetime = document.getElementById('original_datetime').value;

        if (date && startTime && endTime && clinic && doctor) {
            if (startTime < endTime) {
                if (originalDatetime) {
                    updateAppointment();
                } else {
                    var newRow = document.createElement('tr');
                    newRow.setAttribute('data-date', date);
                    newRow.setAttribute('data-start-time', startTime);
                    newRow.innerHTML = '<td>' + date + '</td>' +
                        '<td>' + description + '</td>' +
                        '<td>' + clinic + '</td>' +
                        '<td>' + doctor + '</td>' +
                        '<td>' + startTime + '</td>' +
                        '<td>' + endTime + '</td>' +
                        '<td><button onclick="editAppointment(this)">Edit</button> <button onclick="deleteAppointment(this)">Delete</button></td>';
                    document.getElementById('appointment_list').getElementsByTagName('tbody')[0].appendChild(newRow);
                    clear_input();
                }
            } else {
                alert('End time must be after start time.');
            }
        } else {
            alert('Please fill in all required fields.');
        }
    }

    function updateAppointment() {
        var date = document.getElementById('date').value;
        var description = document.getElementById('description').value;
        var startTime = document.getElementById('start_time').value;
        var endTime = document.getElementById('end_time').value;
        var clinic = document.getElementById('clinic').value;
        var doctor = document.getElementById('doctor').value;
        var originalDatetime = document.getElementById('original_datetime').value.split(' ');

        var originalDate = originalDatetime[0];
        var originalStartTime = originalDatetime[1];

        var existingAppointment = document.querySelector('#appointment_list tbody tr[data-date="' + originalDate + '"][data-start-time="' + originalStartTime + '"]');
        if (existingAppointment) {
            existingAppointment.setAttribute('data-date', date);
            existingAppointment.setAttribute('data-start-time', startTime);
            existingAppointment.innerHTML = '<td>' + date + '</td>' +
                '<td>' + description + '</td>' +
                '<td>' + clinic + '</td>' +
                '<td>' + doctor + '</td>' +
                '<td>' + startTime + '</td>' +
                '<td>' + endTime + '</td>' +
                '<td><button onclick="editAppointment(this)">Edit</button> <button onclick="deleteAppointment(this)">Delete</button></td>';
            clear_input();
        }
    }

    function clear_input() {
        document.getElementById('form_create_appointment').reset();
        document.getElementById('original_datetime').value = '';
        var submitButton = document.getElementById('submit');
        submitButton.textContent = 'Make Appointment';
        submitButton.setAttribute('onclick', 'makeAppointment()');
    }

    function editAppointment(button) {
        var appointmentRow = button.parentNode.parentNode;
        var date = appointmentRow.cells[0].textContent;
        var description = appointmentRow.cells[1].textContent;
        var clinic = appointmentRow.cells[2].textContent;
        var doctor = appointmentRow.cells[3].textContent;
        var startTime = appointmentRow.cells[4].textContent;
        var endTime = appointmentRow.cells[5].textContent;

        document.getElementById('date').value = date;
        document.getElementById('description').value = description;
        document.getElementById('clinic').value = clinic;
        document.getElementById('doctor').value = doctor;
        document.getElementById('start_time').value = startTime;
        document.getElementById('end_time').value = endTime;
        document.getElementById('original_datetime').value = date + ' ' + startTime;

        var submitButton = document.getElementById('submit');
        submitButton.textContent = 'Update Appointment';
        submitButton.setAttribute('onclick', 'makeAppointment()');
    }

    function deleteAppointment(button) {
        var appointmentRow = button.parentNode.parentNode;
        appointmentRow.remove();
    }

    function setMinDateTime() {
        var currentDate = new Date();
        var currentDateString = currentDate.toISOString().slice(0, 10);
        var currentTimeString = currentDate.toTimeString().slice(0, 5);

        document.getElementById('date').min = currentDateString;
        document.getElementById('start_time').min = currentTimeString;
        document.getElementById('end_time').min = currentTimeString;
    }

    window.onload = setMinDateTime;

    document.getElementById('submit').addEventListener('click', makeAppointment);


const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('main-content');
const toggleSidebarBtn = document.getElementById('toggle-sidebar');
const sidebarCloseBtn = document.getElementById('sidebar-close-btn');

toggleSidebarBtn.addEventListener('click', function() {
    document.body.classList.toggle('show-sidebar');
});

sidebarCloseBtn.addEventListener('click', function() {
    document.body.classList.remove('show-sidebar');
});

window.addEventListener('click', function(event) {
    if (event.target == sidebar) {
        document.body.classList.remove('show-sidebar');
    }
});