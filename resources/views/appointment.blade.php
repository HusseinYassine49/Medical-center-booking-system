<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Appointment</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        
        body.show-sidebar .sidebar {
            display: block;
        }

        body.show-sidebar .main-content {
            margin-left: 250px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            background-color: #f4f4f9;
        }

        .navbar {
            width: 100%;
            background-color: #007bff;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .navbar ul li {
            padding: 14px 20px;
        }

        .navbar ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            display: flex;
            align-items: center;
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar ul li a:hover {
            background-color: #0056b3;
            color: white;
        }

        .navbar ul li a i {
            margin-right: 8px;
        }

        .main-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-wrap: wrap;
            transition: margin-left 0.3s;
        }

        .sidebar {
            display: none;
            width: 250px;
            background-color: #007bff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            overflow-x: hidden;
            padding-top: 60px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            z-index: 1000;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 14px 20px;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            display: block;
            transition: background-color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #0056b3;
            color: white;
        }

        .sidebar ul li a i {
            margin-right: 8px;
        }

        .sidebar-close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 30px;
            color: white;
            cursor: pointer;
        }



        * {box-sizing: border-box;}
        .card-header * {list-style-type: none;}
        .required:after{
            content:"*";
            font-weight:bold;
            color: red;
            margin-left: 5px;
        }
        .card-header {
            padding: 50px 25px;
            width: 100%;
        }
        .card-header ul {
            margin: 0;
            padding: 0;
        }
        .card-header ul li {
            color: white;
            font-size: 20px;
            letter-spacing: 3px;
        }
        .weekdays {
            margin: 0;
            padding: 10px 0;
        }
        .days {
            padding: 10px 0;
        }
        .badge1 {
            position:relative;
        }
        .badge1[data-badge]:after {
            content: attr(data-badge);
            position: absolute;
            top: -0.5px;
            right: -0.5px;
            font-size: .7em;
            background: red;
            color: white;
            width: 18px;
            height: 18px;
            text-align: center;
            line-height: 18px;
            border-radius: 50%;
            box-shadow: 0 0 1px #333;
        }
        @media screen and (max-width:720px) {
            .weekdays td,
            .days td {
                width: 13.1%;
            }
        }
        @media screen and (max-width: 420px) {
            .weekdays td,
            .days td {
                width: 12.5%;
            }
            .days td .active {
                padding: 2px;
            }
        }
        @media screen and (max-width: 290px) {
            .weekdays td,
            .days td {
                width: 12.2%;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-calendar-alt"></i> Appointments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-calendar"></i> Calendar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-envelope"></i> Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-cog"></i> Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="toggle-sidebar"><i class="fas fa-bars"></i> Sidebar</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <a href="javascript:void(0)" class="sidebar-close-btn" id="sidebar-close-btn">&times;</a>
        <ul>
            <li><a href="#"><i class="fas fa-home"></i> Overview</a></li>
            <li><a href="#"><i class="fas fa-calendar-alt"></i> Appointments</a></li>
            <li><a href="#"><i class="fas fa-calendar"></i> Calendar</a></li>
            <li><a href="#"><i class="fas fa-envelope"></i> Messages</a></li>
            <li><a href="#"><i class="fas fa-file-alt"></i> Reports</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Row for Instructions -->
        <div class="row">
            <div class="instructions">
                <h1 class="text-center">Instructions</h1>
                    <ul>
                        <li>Any appointment can be made for the current day or for a future date.</li>
                        <li>No two appointments should overlap. If an appointment already exists for a day, a warning should be shown.</li>
                        <li>Appointments can be edited and deleted.</li>
                    </ul>
                </p>
            </div>
        </div>
        
    <!-- Instructions -->
    <div class="container">
        
        <!-- Calendar Display -->
        <div class="row">
            <div class="calendar col-md-8 offset-md-2">
                <!-- Calendar Header -->
                <div class="card-header bg-primary">
                    <ul>
                        <li id="month" class="text-white text-uppercase text-center"></li>
                        <li id="year" class="text-white text-uppercase text-center"></li>
                    </ul>
                </div>
                <!-- Calendar Table -->
                <table class="table calendar table-bordered table-responsive-sm" id="calendar">
                    <!-- Calendar Weekdays -->
                    <thead>
                        <tr class="weekdays bg-dark">
                            <th scope="col" class="text-white text-center">Mo</th>
                            <th scope="col" class="text-white text-center">Tu</th>
                            <th scope="col" class="text-white text-center">We</th>
                            <th scope="col" class="text-white text-center">Th</th>
                            <th scope="col" class="text-white text-center">Fr</th>
                            <th scope="col" class="text-white text-center">Sa</th>
                            <th scope="col" class="text-white text-center">Su</th>
                        </tr>
                    </thead>
                    <!-- Calendar Days -->
                    <tbody class="days bg-light" id="days"></tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div>

        <!-- Appointment Form -->
        <div class="row">
            <div class="col offset-md-1">
                <form id="form_create_appointment">
                    <!-- Form Inputs -->
                    <div class="col form-group">
                        <label class="required">Date</label>
                        <input class="form-control date-input" type="date" id="date" min="" required>
                    </div>
                    <div class="col form-group">
                        <label>Description</label>
                        <input class="form-control" type="text" id="description">
                    </div>
                    <div class="col form-group">
                        <label class="required">Select Clinic</label>
                        <select class="form-control" id="clinic" required>
                            <option value="" disabled selected>Select Clinic</option>
                            <option value="Clinic 1">Clinic 1</option>
                            <option value="Clinic 2">Clinic 2</option>
                            <option value="Clinic 3">Clinic 3</option>
                        </select>
                    </div>
                    <div class="col form-group">
                        <label class="required">Select Doctor</label>
                        <select class="form-control" id="doctor" required>
                            <option value="" disabled selected>Select Doctor</option>
                            <option value="Doctor A">Doctor A</option>
                            <option value="Doctor B">Doctor B</option>
                            <option value="Doctor C">Doctor C</option>
                        </select>
                    </div>
                    
                    <div class="col form-group">
                        <label class="required">Start Time</label>
                        <input class="form-control time-input" type="time" id="start_time" min="" required>
                    </div>
                    <div class="col form-group">
                        <label class="required">End Time</label>
                        <input class="form-control time-input" type="time" id="end_time" min="" required>
                    </div>
                    <input type="hidden" id="original_datetime">
                    
                    <!-- Form Buttons -->
                    <div class="form-row">
                        <div class="col form-group">
                            <button type="button" class="btn btn-warning btn-block" id="clear" onclick="clear_input()">Clear Form</button>
                        </div>
                        <div class="col form-group">
                            <button type="button" class="btn btn-primary btn-block" id="submit" onclick="makeAppointment()">Make Appointment</button>

                        </div>
                    </div>
                </form>
            </div>
            <!-- Appointment List -->
            <div class="col offset-md-1">
                <div class="row">
                    <div class="col">
                        <h3>Appointments</h3>
                    </div>
                    <div class="col form-group">
                        <button type="button" class="btn btn-danger btn-block" id="btn_clear_storage" onclick="clear_storage()">Clear Appointments</button>
                    </div>
                </div>
                <table class="table table-bordered table-hover table-striped table-sm" id="appointment_list">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center align-middle">Date</th>
                            <th scope="col" class="text-center align-middle">Description</th>
                            <th scope="col" class="text-center align-middle">Clinic</th>
                            <th scope="col" class="text-center align-middle">Doctor</th>
                            <th scope="col" class="text-center align-middle">Start time</th>
                            <th scope="col" class="text-center align-middle">End time</th>
                            <th scope="col" class="text-center align-middle">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <!-- Appointment List Items -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End of Container -->

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <!-- Your Custom JS File -->
    
     <script>
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

document.addEventListener('DOMContentLoaded', function () {
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
});

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
</script>

</body>
</html>




















