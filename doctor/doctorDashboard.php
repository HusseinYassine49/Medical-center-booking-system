<?php
include 'session_check.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <link rel="stylesheet" href="navbar/navbar.css">
    <link rel="stylesheet" href="css/doctorDashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <?php include 'navbar/navbar.php'; ?>
    <div class="bread-container">
        <ul class="breadcrumbs">
            <li class="breadcrumbs-item">
                <a href="../index.html" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>
            </li>
            <li class="breadcrumbs-item">
                <a href="doctorDashboard.php" class="breadcrumbs-link active">Dashboard</a>
            </li>
        </ul>
    </div>

    <div class="container dashboard">
        <div class="row col1">
            <div class="card mb-4 calendar">
                <div class="row g-0">
                    <div class="header">
                        <button id="prev-btn">
                            <i class="fas fa-arrow-left"></i>
                        </button>

                        <div class="monthYear" id="monthYear"></div>

                        <button id="next-btn">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                    <div class="days">
                        <div class="day">Mon</div>
                        <div class="day">Tue</div>
                        <div class="day">Wed</div>
                        <div class="day">Thu</div>
                        <div class="day">Fri</div>
                        <div class="day">Sat</div>
                        <div class="day">Sun</div>
                    </div>
                    <div class="dates" id="dates"></div>
                </div>
                <div class="modal" id="modal">
                    <div class="modal-content">
                        <span class="close-btn">&times;</span>
                        <div id="modal-appointments" class="modal-appointments"></div>
                    </div>
                </div>
            </div>

            <div class="upcomingApp">
                <h6>Pending Appointments, Awaiting Acceptance:</h6>
                <table class="tbl" id="appointmentsTable">
                    <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Accept</th>
                            <th>Cancel</th>
                        </tr>
                    </thead>
                    <tbody id="appointmentsBody"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="js/doctorDashboard.js"></script>
    <script src="js/include.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>