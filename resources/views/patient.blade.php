<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <style>
       
        body.show-sidebar .sidebar {
            display: block;
        }


        /* Hello */ 

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

        .main-content.shifted {
            margin-left: 250px;
        }

        .welcome-message {
            width: 100%;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .welcome-message h1 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        .welcome-message p {
            font-size: 1.2em;
            color: #555;
        }

        .left, .right {
            flex: 1;
        }

        .left {
            display: flex;
            flex-direction: column;
        }

        .right {
            display: flex;
            flex-direction: column;
            margin-left: 20px;
        }

        .image-container img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .vitals {
            margin-bottom: 20px;
        }

        .vitals h2 {
            margin-bottom: 10px;
        }

        .vitals .cards {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            flex: 1;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .appointments {
            margin-top: 20px;
        }

        .appointments h2 {
            margin-bottom: 10px;
        }

        .appointments table {
            width: 100%;
            border-collapse: collapse;
            animation: fadeInUp 0.5s ease-in-out;
            border-radius: 8px;
            overflow: hidden;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .appointments th, .appointments td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .appointments th {
            background-color: white;
            color: #333;
        }

        .appointments tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .appointments tr:hover {
            background-color: #ddd;
        }

        .appointments td.status-active {
            background-color: #d4edda;
            color: #155724;
        }

        .appointments td.status-upcoming {
            background-color: #cce5ff;
            color: #004085;
        }

        .appointments td.status-completed {
            background-color: #fff3cd;
            color: #856404;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .reports, .calendar {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .reports:hover, .calendar:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .reports h2, .calendar h2 {
            margin-bottom: 10px;
        }

        .reports ul {
            list-style-type: none;
            padding: 0;
        }

        .reports ul li {
            padding: 5px 0;
            border-bottom: 1px solid #ddd;
        }

        .reports ul li:last-child {
            border-bottom: none;
        }

        .calendar-container {
            width: 100%;
            margin-top: 20px;
            padding: 20px;
            box-sizing: border-box;
        }

        /* FullCalendar style */
        #calendar {
            max-width: 1000px;
            margin: 0 auto;
        }

        .fc-event:hover {
            background-color: blue !important;
            border-color: blue !important;
        }
        
       
.modal {
    display: none;
    position: fixed;
    z-index: 1001;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #fff;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 400px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    animation: fadeIn 0.3s;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input,
.form-group select {
    width: calc(100% - 20px);
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

.form-actions {
    display: flex;
    justify-content: space-between;
}

.form-actions button {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    background-color: #007bff;
    color: white;
    transition: background-color 0.3s;
}

.form-actions button:hover {
    background-color: #0056b3;
}

.form-actions button#cancelForm {
    background-color: #ccc;
    color: #333;
}

.form-actions button#cancelForm:hover {
    background-color: #999;
}

        


    </style>
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="#"><i class="fas fa-home"></i> Overview</a></li>
            <li><a href="#"><i class="fas fa-calendar-alt"></i> Appointments</a></li>
            <li><a href="#"><i class="fas fa-calendar"></i> Calendar</a></li>
            <li><a href="#"><i class="fas fa-envelope"></i> Messages</a></li>
            <li><a href="#"><i class="fas fa-file-alt"></i> Reports</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            <li><a href="#" id="toggle-sidebar"><i class="fas fa-bars"></i> Sidebar</a></li>
        </ul>
    </div>
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
    <div class="main-content" id="main-content">
        <div class="welcome-message">
            <h1 id="welcome-heading"></h1>
            <p id="welcome-text" style="display: none;">Welcome to your dashboard. Here's a summary of your recent activities.</p>
        </div>
        <div class="left">
            <div class="image-container">
                <img src="https://via.placeholder.com/400" alt="Placeholder Image">
            </div>
            <div class="vitals">
                <h2>Vitals</h2>
                <div class="cards">
                    <div class="card">
                        <h3>Blood Pressure</h3>
                        <p>120/80 mmHg</p>
                    </div>
                    <div class="card">
                        <h3>Heart Rate</h3>
                        <p>75 bpm</p>
                    </div>
                    <div class="card">
                        <h3>Blood Sugar</h3>
                        <p>90 mg/dL</p>
                    </div>
                </div>
            </div>
            <div id="appointmentModal" class="modal">
                <div class="modal-content">
                    <span class="close" id="closeModal">&times;</span>
                    <h2 id="modalTitle">Add Appointment</h2>
                    <form id="appointmentForm">
                        <label for="doctor">Doctor:</label>
                        <input type="text" id="doctor" name="doctor" required><br>
                        <label for="specialty">Specialty:</label>
                        <input type="text" id="specialty" name="specialty" required><br>
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" required><br>
                        <label for="time">Time:</label>
                        <input type="time" id="time" name="time" required><br>
                        <input type="hidden" id="appointmentId">
                        <button type="submit">Save</button>
                    </form>
                </div>
            </div>
            
<div id="appointmentModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h2 id="modalTitle">Add Appointment</h2>
        <form id="appointmentForm">
            <div class="form-group">
                <label for="doctor">Doctor:</label>
                <input type="text" id="doctor" name="doctor" required>
            </div>
            <div class="form-group">
                <label for="specialty">Specialty:</label>
                <input type="text" id="specialty" name="specialty" required>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Time:</label>
                <input type="time" id="time" name="time" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="Active">Active</option>
                    <option value="Upcoming">Upcoming</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
            <input type="hidden" id="appointmentId">
            <div class="form-actions">
                <button type="submit">Save</button>
                <button type="button" id="cancelForm">Cancel</button>
            </div>
        </form>
    </div>
</div>


<div class="appointments">
    <h2>Appointments</h2>
    <button id="addAppointmentBtn">Add Appointment</button>
    <table>
        <thead>
            <tr>
                <th>Doctor</th>
                <th>Specialty</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="appointmentTableBody">
            <tr>
                <td>Dr. Smith</td>
                <td>Cardiologist</td>
                <td>01/10/2024</td>
                <td>10:00 AM</td>
                <td class="status-active">Active</td>
            </tr>
            <tr>
                <td>Dr. Jones</td>
                <td>Dermatologist</td>
                <td>01/12/2024</td>
                <td>11:00 AM</td>
                <td class="status-upcoming">Upcoming</td>
            </tr>
            <tr>
                <td>Dr. Brown</td>
                <td>Neurologist</td>
                <td>01/15/2024</td>
                <td>02:00 PM</td>
                <td class="status-upcoming">Upcoming</td>
            </tr>
            <tr>
                <td>Dr. Lee</td>
                <td>Orthopedic</td>
                <td>01/20/2024</td>
                <td>09:00 AM</td>
                <td class="status-completed">Completed</td>
            </tr>
            <tr>
                <td>Dr. Green</td>
                <td>Ophthalmologist</td>
                <td>01/22/2024</td>
                <td>01:00 PM</td>
                <td class="status-completed">Completed</td>
            </tr>
            <tr>
                <td>Dr. Adams</td>
                <td>Pediatrician</td>
                <td>01/25/2024</td>
                <td>10:30 AM</td>
                <td class="status-upcoming">Upcoming</td>
            </tr>
            <tr>
                <td>Dr. Carter</td>
                <td>Radiologist</td>
                <td>01/27/2024</td>
                <td>03:00 PM</td>
                <td class="status-upcoming">Upcoming</td>
            </tr>
            <tr>
                <td>Dr. White</td>
                <td>Surgeon</td>
                <td>01/30/2024</td>
                <td>11:30 AM</td>
                <td class="status-active">Active</td>
            </tr>
        </tbody>
    </table>
</div>

            

        </div>

        <div class="right">
           
            <div class="calendar">
                <div class="calendar-container">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <script>
       
        const welcomeHeading = document.getElementById('welcome-heading');
        const welcomeText = document.getElementById('welcome-text');

        let welcomeMessage = "Good Morning, Patient!";
        let messageIndex = 0;
        let typingSpeed = 100;

        function typeWelcomeMessage() {
            if (messageIndex < welcomeMessage.length) {
                welcomeHeading.textContent += welcomeMessage.charAt(messageIndex);
                messageIndex++;
                setTimeout(typeWelcomeMessage, typingSpeed);
            } else {
                welcomeText.style.display = 'block';
            }
        }

        typeWelcomeMessage();

       
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

      /
const modal = document.getElementById('appointmentModal');
const addAppointmentBtn = document.getElementById('addAppointmentBtn');
const closeModal = document.getElementById('closeModal');
const cancelForm = document.getElementById('cancelForm');
const appointmentForm = document.getElementById('appointmentForm');
const modalTitle = document.getElementById('modalTitle');
const appointmentIdInput = document.getElementById('appointmentId');

addAppointmentBtn.addEventListener('click', function() {
    modalTitle.textContent = 'Add Appointment';
    appointmentForm.reset();
    appointmentIdInput.value = '';
    modal.style.display = 'block';
});

closeModal.addEventListener('click', function() {
    modal.style.display = 'none';
});

cancelForm.addEventListener('click', function() {
    modal.style.display = 'none';
});

window.addEventListener('click', function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
});

appointmentForm.addEventListener('submit', function(event) {
    event.preventDefault();
    const appointmentId = appointmentIdInput.value;
    const doctor = document.getElementById('doctor').value;
    const specialty = document.getElementById('specialty').value;
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;
    const status = document.getElementById('status').value;

    if (appointmentId) {
        editAppointment(appointmentId, doctor, specialty, date, time, status);
    } else {
        addAppointment(doctor, specialty, date, time, status);
    }
    modal.style.display = 'none';
});

function addAppointment(doctor, specialty, date, time, status) {
    const tableBody = document.getElementById('appointmentTableBody');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${doctor}</td>
        <td>${specialty}</td>
        <td>${date}</td>
        <td>${time}</td>
        <td class="status-${status.toLowerCase()}">${status}</td>
        <td>
            <button onclick="showEditForm(this)">Edit</button>
            <button onclick="deleteAppointment(this)">Delete</button>
        </td>
    `;
    tableBody.appendChild(newRow);
}

function showEditForm(button) {
    const row = button.closest('tr');
    const cells = row.getElementsByTagName('td');
    const doctor = cells[0].textContent;
    const specialty = cells[1].textContent;
    const date = cells[2].textContent;
    const time = cells[3].textContent;
    const status = cells[4].textContent;

    modalTitle.textContent = 'Edit Appointment';
    document.getElementById('doctor').value = doctor;
    document.getElementById('specialty').value = specialty;
    document.getElementById('date').value = date;
    document.getElementById('time').value = time;
    document.getElementById('status').value = status;
    appointmentIdInput.value = row.rowIndex;
    modal.style.display = 'block';
}

function editAppointment(appointmentId, doctor, specialty, date, time, status) {
    const tableBody = document.getElementById('appointmentTableBody');
    const row = tableBody.rows[appointmentId - 1];
    row.cells[0].textContent = doctor;
    row.cells[1].textContent = specialty;
    row.cells[2].textContent = date;
    row.cells[3].textContent = time;
    row.cells[4].textContent = status;
    row.cells[4].className = `status-${status.toLowerCase()}`;
}

function deleteAppointment(button) {
    const row = button.closest('tr');
    row.remove();
}

     
    </script>
</body>
</html>