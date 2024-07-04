<?php
session_start();
require "../include/connection.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
    header("Location: ../login/login.php");
    exit();
}

$sql = "SELECT users.Fname AS UserName, users.Lname AS UserLastName, feedback.rating, feedback.comment, feedback.status, feedback.id, doctors.DoctorID, CONCAT(doctor_user.Fname, ' ', doctor_user.Lname) AS DoctorName
        FROM feedback
        INNER JOIN users ON users.id = feedback.UserID
        INNER JOIN doctors ON doctors.DoctorID = feedback.DoctorID
        INNER JOIN users AS doctor_user ON doctors.UserID = doctor_user.id
        WHERE feedback.status = '0';";

$result = $con->query($sql);
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

        <div class="feedback-container">
            <h1>Feedback System</h1>
            <table id="feedback-table">
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
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td data-label='ID'>" . $row["id"] . "</td>";
                            echo "<td data-label='Patient'>" . $row["UserName"] . " " . $row["UserLastName"] . "</td>";
                            echo "<td data-label='Doctor'>" . $row["DoctorName"] . "</td>";
                            echo "<td data-label='Rating'>" . $row["rating"] . "</td>";
                            echo "<td data-label='Feedback'>" . $row["comment"] . "</td>";
                            echo "<td data-label='Accept'><button class='btn-accept' onclick='updateFeedbackStatus(" . $row["id"] . ", \"1\")'>Accept</button></td>";
                            echo "<td data-label='Decline'><button class='btn-decline' onclick='updateFeedbackStatus(" . $row["id"] . ", \"2\")'>Decline</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No results found</td></tr>";
                    }
                    $con->close();
                    ?>
                </tbody>

            </table>
            <button class="feedbackinfo-btn" onclick="window.location.href = 'feedbackinfo.php';">View Feedback Information</button>
        </div>
        
    </div>

    <script src="navbar/include.js"></script>
    <script src="js/feedback.js"></script>
    <!-- Icon SCRIPT-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
