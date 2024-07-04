<?php
require "../include/connection.php";

// SQL queries to fetch accepted and declined feedback from appointment_feedback table
$acceptedSql = "SELECT users.Fname AS PatientName, users.Lname AS PatientLastName, CONCAT(doctor_user.Fname, ' ', doctor_user.Lname) AS DoctorName, feedback.rating, feedback.comment, feedback.status, feedback.id
                FROM users
                INNER JOIN appointment_feedback AS feedback ON users.id = feedback.User_ID
                INNER JOIN doctors ON doctors.DoctorID = feedback.Doctor_ID
                INNER JOIN users AS doctor_user ON doctors.UserID = doctor_user.id
                WHERE feedback.status = 1;";

$declinedSql = "SELECT users.Fname AS PatientName, users.Lname AS PatientLastName, CONCAT(doctor_user.Fname, ' ', doctor_user.Lname) AS DoctorName, feedback.rating, feedback.comment, feedback.status, feedback.id
                FROM users
                INNER JOIN appointment_feedback AS feedback ON users.id = feedback.User_ID
                INNER JOIN doctors ON doctors.DoctorID = feedback.Doctor_ID
                INNER JOIN users AS doctor_user ON doctors.UserID = doctor_user.id
                WHERE feedback.status = 2;";

$acceptedResult = $con->query($acceptedSql);
$declinedResult = $con->query($declinedSql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Information</title>
    <link rel="stylesheet" href="css/adminfeedback.css">
    <link rel="stylesheet" href="css/adminpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <?php include 'navbar/navbar.php'; ?>

    <div class="main-page" id="main-page">

    <div class="sphere top-sphere"></div>
        <div class="sphere mid-sphere-left"></div>


        <div class="bread-container">
            <ul class="breadcrumbs">
                <li class="breadcrumbs-item">
                    <a href="../home.php" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>
                </li>
                <li class="breadcrumbs-item">
                    <a href="admin-dashboard.php" class="breadcrumbs-link">Dashboard</a>
                </li>
                <li class="breadcrumbs-item">
                    <a href="admin-feedback.php" class="breadcrumbs-link">Feedback</a>
                </li>
                <li class="breadcrumbs-item">
                    <a href="#" class="breadcrumbs-link active">Feedback Information</a>
                </li>
            </ul>
        </div>

        <div class="middle-part">
            <button class="feedbackinfo-btn" onclick="window.location.href = 'admin-feedback.php'"><i class="fa-solid fa-chevron-left"></i></button>
            <h1 class="feedback-page-header">Appointment Feedback Information</h1>
            <button class="feedbackinfo-btn hidden" onclick=""><i class="fa-solid fa-chevron-left"></i></button>
        </div>

        <div class="accepted-feedback-container">
            <h2>Accepted Feedback</h2>
            <table id="accepted-feedback-table">
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Rating</th>
                        <th>Feedback</th>
                    </tr>
                </thead>
                <tbody id="accepted-feedback-list">
                    <?php
                    if ($acceptedResult->num_rows > 0) {
                        while ($row = $acceptedResult->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["PatientName"] . " " . $row["PatientLastName"] . "</td>";
                            echo "<td>" . $row["DoctorName"] . "</td>";
                            echo "<td>" . $row["rating"] . "</td>";
                            echo "<td>" . $row["comment"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No accepted feedback found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="declined-feedback-container">
            <h2>Declined Feedback</h2>
            <table id="declined-feedback-table">
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Rating</th>
                        <th>Feedback</th>
                    </tr>
                </thead>
                <tbody id="declined-feedback-list">
                    <?php
                    if ($declinedResult->num_rows > 0) {
                        while ($row = $declinedResult->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["PatientName"] . " " . $row["PatientLastName"] . "</td>";
                            echo "<td>" . $row["DoctorName"] . "</td>";
                            echo "<td>" . $row["rating"] . "</td>";
                            echo "<td>" . $row["comment"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No declined feedback found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="js/include.js"></script>
</body>

</html>
