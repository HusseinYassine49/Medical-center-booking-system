<?php
session_start(); // Start the session
if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];
    echo "Welcome to Patient Dashboard, UserID: $userID";

    if (isset($_SESSION['user_email'])) {
        $userEmail = $_SESSION['user_email'];
        echo "<br>Your email: $userEmail";
    }
} else {
    header("Location: login.php");
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
     <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
     <link href="patient.css" rel="stylesheet">
     <link href="nav.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     
</head>


<body>

    <?php include 'nav.php';?>



    <div class="main-page">


    <div class="navbar">
        <ul>
            <li><a href="#"><i class="fas fa-calendar-alt"></i> Make Appointments</a></li>
            <li><a href="#"><i class="fas fa-calendar-alt"></i> clinics </a></li>
            <li><a href="{{ url('feedback') }}"><i class="fas fa-envelope"></i> Feedback</a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            <li><a href="#" id="toggle-sidebar"><i class="fas fa-bars"></i> Sidebar</a></li>
        </ul>
    </div>



    <div class="main-content" id="main-content">
        <div class="welcome-message">
            <h1 id="welcome-heading"></h1>
            <p id="welcome-text" style="display: none;">Welcome to your dashboard. Here's a summary of your recent activities.</p>
       
        </div>

        
        <div class="left">
            
            <a class="image-container" href="{{ url('/appointment') }}">
                <img src="images/1.jpg" alt="Placeholder Image">
            </a>

            

        </div>
        <div class="right">
            
            <div class="calendar">
                <div class="calendar-container">
                    <div id='calendar'></div>
                </div>
            </div>

        </div>
    </div>

    <div class="vitals">
        <h2>Vitals</h2>
        <div class="cards">
            <div class="card">
                <h3>Body Temperature</h3>
                <p>98.6°F</p>
            </div>
            <div class="card">
                <h3>Pulse</h3>
                <p>75 bpm</p>
            </div>
            <div class="card">
                <h3>Blood Pressure</h3>
                <p>120/80 mmHg</p>
            </div>
            <div class="card">
                <h3>Breathing Rate</h3>
                <p>16 breaths/min</p>
            </div>
        </div>
    </div>

<div id="appointmentModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalTitle" class="modal-title">Add Appointment</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="appointmentForm">
                    <div class="form-group">
                        <label for="doctor">Doctor:</label>
                        <input type="text" class="form-control" id="doctor" name="doctor" required>
                    </div>
                    <div class="form-group">
                        <label for="specialty">Specialty:</label>
                        <input type="text" class="form-control" id="specialty" name="specialty" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="time">Time:</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Active">Active</option>
                            <option value="Upcoming">Upcoming</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <input type="hidden" id="appointmentId">
                    <div class="form-actions d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="appointments">
    <h2>Appointments</h2>
    <button id="addAppointmentBtn" class="btn btn-primary mb-3" data-toggle="modal" data-target="#appointmentModal">Add Appointment</button>
    <table class="table table-bordered table-hover">
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
           
        </tbody>
    </table>
</div>

    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>

    <script src="patient.js"></script>
    

</body>
</html>
