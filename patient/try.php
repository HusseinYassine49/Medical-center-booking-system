<?php
session_start();
$userID = isset($_GET['userID']) ? $_GET['userID'] : null;

require_once "../include/connection.php";

// Fetch departments
$departmentsQuery = "SELECT Id, Department_name FROM department";
$departmentsResult = $con->query($departmentsQuery);

// Fetch doctors with user details
$doctorsQuery = "
    SELECT doctors.DoctorID, users.Fname, users.Lname, department.Department_name 
    FROM doctors 
    INNER JOIN users ON doctors.UserID = users.id
    INNER JOIN department ON doctors.DepartmentID = department.Id
    WHERE doctors.verified='verified'";
$doctorsResult = $con->query($doctorsQuery);
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Appointment</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="css/makeappointment.css" rel="stylesheet">
    <link href="css/try.css" rel="stylesheet">
    <link href="navbar/navbar.css" rel="stylesheet">
    
<link rel="apple-touch-icon" type="image/png" href="https://cpwebassets.codepen.io/assets/favicon/apple-touch-icon-5ae1a0698dcc2402e9712f7d01ed509a57814f994c660df9f7a952f3060705ee.png" />
<meta name="apple-mobile-web-app-title" content="CodePen">
<link rel="shortcut icon" type="image/x-icon" href="https://cpwebassets.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico" />
<link rel="mask-icon" type="image/x-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg" color="#111" /> 
<script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-2c7831bb44f98c1391d6a4ffda0e1fd302503391ca806e7fcc7b9b87197aec26.js"></script>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Playfair+Display:700,900|Source+Sans+Pro:400,600,700'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>


</head>

<body>

    <?php include 'navbar/navbar.php'; ?>

    <div class="main-page">
        <div class="bread-container">
            <ul class="breadcrumbs">
                <li class="breadcrumbs-item">
                    <a href="../index.html" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>
                </li>
                <li class="breadcrumbs-item">
                    <a href="admin-dashboard.php" class="breadcrumbs-link ">Patient</a>
                </li>
                <li class="breadcrumbs-item">
                    <a href="admin-dashboard.php" class="breadcrumbs-link active">Appointment</a>
                </li>
            </ul>
        </div>

        <div class="main-content">
            <!-- Form Container -->
            <div class="form-container">


<form id="form_create_appointment">

<input type="hidden" name="userID" id="userID" value="<?= $userID ?>">
   
    <div class="group">
        <label>Description</label>
        <input class="description-input" type="text" id="description">
    </div>
    <div class="group">
        <label class="required">Select Clinic</label>
        <select class="select-clinic" id="clinic" required onchange="updateDoctors()">
            <option value="" disabled selected>Select Clinic</option>
            <?php while ($row = $departmentsResult->fetch_assoc()) : ?>
                <option value="<?= $row['Id'] ?>"><?= $row['Department_name'] ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="group">
        <label class="required">Select Doctor</label>
        <select class="select-doctor" id="doctor" required onchange="fetchDoctorAvailability()">
            <option value="" disabled selected>Select Doctor</option>
            <?php while ($row = $doctorsResult->fetch_assoc()) : ?>
                <option value="<?= $row['DoctorID'] ?>"><?= $row['Fname'] ?> <?= $row['Lname'] ?> (<?= $row['Department_name'] ?>)</option>
            <?php endwhile; ?>
        </select>
    </div>

     <div class="group">
        <label>Selected Date</label>
        <input type="text" id="selected_date_display" readonly>
    </div>
    <div class="group">
        <label>Selected Time</label>
        <input type="text" id="selected_time_display" readonly>
    </div>
   
    <div class="form-row">
        <div class="group">
            <button type="button" class="btn btn-warning btn-block" id="clear" onclick="clear_input()">Clear Form</button>
        </div>
        <div class="group">
            <button type="submit" class="btn btn-primary btn-block" id="submit">Make Appointment</button>
        </div>
    </div>
   
</form>

            </div>

            <!-- Calendar Container -->
            <div class="wrapper">
  
  <div id="calendar">
    <div class="header">
      <div class="overlay">
        <h1>Make appointment</h1>
      </div>
    </div>
    <div class="monthChange"></div>
  </div>
  
  <div class="inner-wrap">
  
    <form>
     
      
      <button type="submit" class="request disabled">
        Request appointment <br class="break">
        <span>on</span>
        <span class="day"></span>
        <span>at</span>
        <span class="time"></span>
        <div class="sendRequest"></div>
      </button>
    </form>

  </div>
  
  <div class='timepicker'>
    <div class="owl">
      <div>07:00</div>
      <div>08:00</div>
      <div>09:00</div>
      <div>10:00</div>
      <div>11:00</div>
      <div>12:00</div>
      <div>13:00</div>
      <div>14:00</div>
      <div>15:00</div>
      <div>16:00</div>
      <div>17:00</div>
      <div>18:00</div>
    </div>
    <div class="fade-l"></div>
    <div class="fade-r"></div>
  </div>
    
</div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.2/owl.carousel.min.js'></script>

    <script src="js/makeAJAX.js"> </script>
    

</body>

</html>