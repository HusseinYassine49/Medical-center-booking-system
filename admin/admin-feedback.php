<?php 
session_start();
require "../include/connection.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
    header("Location: ../login/login.php");
    exit();
}


$sql = "SELECT users.Fname, feedback.rating , feedback.comment , feedback.status, feedback.id
        FROM users
        INNER JOIN feedback ON users.id = feedback.userID
        WHERE feedback.status = 'pending';";

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

<?php include 'navbar/navbar.php';?>

<div class="main-page" id="main-page">

  <div class="sphere top-sphere"></div>
  <div class="sphere mid-sphere-left"></div>


    <div class="bread-container">
        <ul class="breadcrumbs">
            <li class="breadcrumbs-item">
                <a href="../../index.html" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>     
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
                    <th>Rating</th>
                    <th>Feedback</th>
                    <th>Status</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody id="feedback-list">
                <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td data-label='ID'>" . $row["id"] . "</td>";
                            echo "<td data-label='Patient'>" . $row["Fname"] . "</td>";
                            echo "<td data-label='Rating'>" . $row["rating"] . "</td>";
                            echo "<td data-label='Feedback'>" . $row["comment"] . "</td>";
                            echo "<td data-label='Status'>" . $row["status"] . "</td>";
                            echo "<td data-label='Accept'><button class='btn-accept' onclick='updateFeedbackStatus(" . $row["id"] . ", \"accepted\")'>Accept</button></td>";
                            echo "<td data-label='Decline'><button class='btn-decline' onclick='updateFeedbackStatus(" . $row["id"] . ", \"declined\")'>Decline</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No results found</td></tr>";
                    }
                    $con->close();                
                ?>
            </tbody>
        </table>
        <button class="feedbackinfo-btn" onclick="viewFeedbackInfo()">View Feedback Information</button>
    </div>  
</div>

<script src="navbar/include.js"></script>
<script src="js/feedback.js"></script>
<!-- Icon SCRIPT-->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
