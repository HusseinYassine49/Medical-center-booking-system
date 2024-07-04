<?php
session_start();
$userID = isset($_GET['userID']) ? $_GET['userID'] : null;

require_once "../include/connection.php";

$departmentsQuery = "SELECT Id, Department_name FROM department";
$departmentsResult = $con->query($departmentsQuery);

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
    <style>
        .calendar {
            width: 100%;
            border-collapse: collapse;
        }
        .weekdays th,
        .hour-slot {
            border: 1px solid #ccc;
            padding: 8px;
        }
        .hour-row {
            border-top: 1px solid #ccc;
        }
        .days td {
            width: 14.28%;
        }
        .time-slot {
            padding: 4px;
            margin: 2px;
            border-radius: 4px;
            cursor: pointer;
        }
        .available {
            background-color: blue;
            color: white;
        }
        .selected {
            background-color: green;
            color: white;
        }
        .unavailable {
            background-color: lightgray;
            color: black;
            pointer-events: none;
        }
    </style>
</head>

<body>
    <?php include 'navbar/navbar.php'; ?>
    <div class="main-page">

    <div class="sphere top-sphere"></div>
    <div class="sphere mid-sphere-left"></div>

    <div class="bread-container">
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="../home.php" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>
        </li>
        <li class="breadcrumbs-item">
          <a href="patient-dahboard.php" class="breadcrumbs-link">Patient</a>
        </li>
        <li class="breadcrumbs-item">
          <a href="#" class="breadcrumbs-link active">Make Appointment</a>
        </li>

      </ul>
    </div>

        <div class="row-container">
            <div class="calendar-container">
                <div class="calendar">
                    <div class="card-header">
                        <ul>
                            <li id="month" class="text-center"></li>
                            <li id="year" class="text-center"></li>
                        </ul>
                    </div>

                    <table class="calendar" id="calendar">
                        <thead>
                            <tr class="weekdays">
                                <?php
                                $daysOfWeek = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'];
                                foreach ($daysOfWeek as $day) : ?>
                                    <th scope="col" class="text-center"><br><span class="date-label"><?= $day ?></span></th>
                                <?php endforeach; ?>

                            </tr>
                        </thead>
                        <tbody class="days" id="days">
                            <?php
                            $hours = range(9, 13); // Range from 9 am to 1 pm
                            $minutes = ['00', '15', '30', '45']; // 15-minute intervals

                            foreach ($hours as $hour) : ?>
                                <tr class="hour-row">
                                    <?php foreach ($daysOfWeek as $day) : ?>
                                        <td class="text-center hour-slot" data-day="<?= $day ?>">
                                            <?php foreach ($minutes as $minute) : ?>
                                                <div class="time-slot unavailable" data-day="<?= $day ?>" data-time="<?= $hour ?>:<?= $minute ?>" onclick="selectAppointment(this)">
                                                    <?= $hour ?>:<?= $minute ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="form-container">
            <form id="form_create_appointment">
            <input type="hidden" name="userID" id="userID" value="<?= $userID ?>">
                    <div class="group">
                        <label class="required">Date</label>
                        <input class="date-input" type="date" id="date" name="date_" required>
                    </div>
                    <div class="group">
                        <label>Description</label>
                        <input class="description-input" type="text" id="description" name="description">
                    </div>
                    <div class="group">
                        <label class="required">Select Clinic</label>
                        <select class="select-clinic" id="clinic" name="clinic" required onchange="updateDoctors()">
                            <option value="" disabled selected>Select Clinic</option>
                            <?php while ($row = $departmentsResult->fetch_assoc()) : ?>
                                <option value="<?= $row['Id'] ?>"><?= $row['Department_name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="group">
                        <label class="required">Select Doctor</label>
                        <select class="select-doctor" id="doctor" name="doctor" required onchange="fetchDoctorAvailability()">
                            <option value="" disabled selected>Select Doctor</option>
                            <?php while ($row = $doctorsResult->fetch_assoc()) : ?>
                                <option value="<?= $row['DoctorID'] ?>"><?= $row['Fname'] ?> <?= $row['Lname'] ?> (<?= $row['Department_name'] ?>)</option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="group">
                        <label class="required">Start Time</label>
                        <input class="time-input" type="time" id="start_time" name="start_time" required>
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
        </div>
    </div>

    <!-- THIS IS FOR THE SWAL ALERT -->>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="js/makeappointment.js"></script>
<script src="js/sendAJAX.js"></script>


</body>

</html>
