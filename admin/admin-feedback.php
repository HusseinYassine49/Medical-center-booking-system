<?php
session_start();
require "../include/connection.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
    header("Location: ../login/login.php");
    exit();
}

// First Query
$sql_feedback = "SELECT users.Fname AS UserName, users.Lname AS UserLastName, feedback.rating, feedback.comment, feedback.status, feedback.id, doctors.DoctorID, CONCAT(doctor_user.Fname, ' ', doctor_user.Lname) AS DoctorName
        FROM feedback
        INNER JOIN users ON users.id = feedback.UserID
        INNER JOIN doctors ON doctors.DoctorID = feedback.DoctorID
        INNER JOIN users AS doctor_user ON doctors.UserID = doctor_user.id
        WHERE feedback.status = '0';";

$result_feedback = $con->query($sql_feedback);

// Second Query
$sql_appointment_feedback = "SELECT af.id, af.User_ID, af.Doctor_ID, af.rating, af.comment, af.status,
       users.Fname AS UserName, users.Lname AS UserLastName,
       CONCAT(doctor_user.Fname, ' ', doctor_user.Lname) AS DoctorName
FROM appointment_feedback af
INNER JOIN users ON users.id = af.User_ID
INNER JOIN doctors ON doctors.DoctorID = af.Doctor_ID
INNER JOIN users AS doctor_user ON doctors.UserID = doctor_user.id
WHERE af.status = '0';";

$result_appointment_feedback = $con->query($sql_appointment_feedback);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback System</title>
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
                    <a href="../../home.php" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>
                </li>
                <li class="breadcrumbs-item">
                    <a href="admin-dashboard.php" class="breadcrumbs-link">Dashboard</a>
                </li>
                <li class="breadcrumbs-item">
                    <a href="#" class="breadcrumbs-link active">Feedback</a>
                </li>
            </ul>
        </div>

        <!-- Feedback from 'feedback' Table -->
        <div class="feedback-container">
            <h1>Feedback from 'feedback' Table</h1>
            <table id="feedback-table" class="feedback-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Rating</th>
                        <th>Feedback</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody id="feedback-list">
                    <?php
                    if ($result_feedback->num_rows > 0) {
                        while ($row = $result_feedback->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td data-label='ID'>" . $row["id"] . "</td>";
                            echo "<td data-label='Patient'>" . $row["UserName"] . " " . $row["UserLastName"] . "</td>";
                            echo "<td data-label='Doctor'>" . $row["DoctorName"] . "</td>";
                            echo "<td data-label='Rating'>" . $row["rating"] . "</td>";
                            echo "<td data-label='Feedback'>" . $row["comment"] . "</td>";
                            echo "<td data-label='Accept'><button class='btn-accept' onclick='updateFeedbackStatus(" . $row["id"] . ", \"1\", \"feedback\")'>Accept</button></td>";
                            echo "<td data-label='Decline'><button class='btn-decline' onclick='updateFeedbackStatus(" . $row["id"] . ", \"2\", \"feedback\")'>Decline</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No results found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button class="feedbackinfo-btn" onclick="window.location.href = 'feedbackinfo.php';">View Feedback Information</button>
        </div>

        <!-- Feedback from 'appointment_feedback' Table -->
        <div class="feedback-container">
            <h1>Feedback from 'appointment_feedback' Table</h1>
            <table id="appointment-feedback-table" class="feedback-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Rating</th>
                        <th>Feedback</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody id="appointment-feedback-list">
                    <?php
                    if ($result_appointment_feedback->num_rows > 0) {
                        while ($row = $result_appointment_feedback->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td data-label='ID'>" . $row["id"] . "</td>";
                            echo "<td data-label='Patient'>" . $row["UserName"] . " " . $row["UserLastName"] . "</td>";
                            echo "<td data-label='Doctor'>" . $row["DoctorName"] . "</td>";
                            echo "<td data-label='Rating'>" . $row["rating"] . "</td>";
                            echo "<td data-label='Feedback'>" . $row["comment"] . "</td>";
                            echo "<td data-label='Accept'><button class='btn-accept' onclick='updateFeedbackStatus(" . $row["id"] . ", \"1\", \"appointment_feedback\")'>Accept</button></td>";
                            echo "<td data-label='Decline'><button class='btn-decline' onclick='updateFeedbackStatus(" . $row["id"] . ", \"2\", \"appointment_feedback\")'>Decline</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No results found</td></tr>";
                    }
                    // Close the connection
                    $con->close();
                    ?>
                </tbody>
            </table>
            <button class="feedbackinfo-btn" onclick="window.location.href = 'feedbackappointmentinfo.php';">View Appointment Feedback</button>
        </div>

    </div>

    <script src="navbar/include.js"></script>
    <script src="js/feedback.js"></script>
    <!-- Icon SCRIPT-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
        function updateFeedbackStatus(id, status, table) {
            $.ajax({
                url: 'update_feedback.php',
                type: 'POST',
                data: {
                    id: id,
                    status: status,
                    table: table
                },
                success: function(response) {
                    location.reload();
                },
                error: function(error) {
                    console.error("Error updating feedback status: ", error);
                }
            });
        }
    </script>

</body>

</html>