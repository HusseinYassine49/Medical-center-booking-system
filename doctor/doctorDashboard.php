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
    <div class="container dashboard">
        <!-- hello section -->
        <div class="card mb-3 hello">
            <div class="row g-0" style="display: flex;">
                <div class="col-md-1">
                    <img src="../img/[removal.ai]_7af08f93-0a5c-45b9-9b7b-5a17045e773a-male-doctor-smiling-selfconfidence-flat-260nw-2281709217.png" class="img-fluid" alt="...">
                </div>
                <div class="col-md-11">
                    <div class="card-body">
                        <h3>Hello Doctor</h3>
                        <p>Whatever your do, do with determination. You have one life to live; do your work with passion and give your best.</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="row col1">
            <!-- calendar -->
            <div class="card mb-4 calendar">
                <div class="row g-0 ">
                    <div class="header">
                        <button id="prev-btn">
                            <i class="fas fa-arrow-left"></i>
                        </button>

                        <div class="monthYear" id="monthYear"></div>

                        <button id="next-btn">

                            <i class="fas fa-arrow-right"></i></i>
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
            </div>
            <!-- Appointments -->
            <div class="upcomingApp">
                <h5>Appointments:</h5>
                <table class="tbl" id="filter">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="Name">Fatima Atwi</td>
                            <td data-label="Date">5/20/2024</td>
                            <td data-label="Time">10:10 AM</td>
                            <td data-label="Status"><i class="fas fa-hourglass-half status-icon"></i> Pending</td>
                        </tr>
                        <tr>
                            <td data-label="Name">Fatima Atwi</td>
                            <td data-label="Date">5/20/2024</td>
                            <td data-label="Time">10:10 AM</td>
                            <td data-label="Status"><i class="fas fa-clock status-icon"></i> Waiting</td>
                        </tr>
                        <tr>
                            <td data-label="Name">Fatima Atwi</td>
                            <td data-label="Date">5/20/2024</td>
                            <td data-label="Time">10:10 AM</td>
                            <td data-label="Status"><i class="fas fa-clock status-icon"></i> Waiting</td>
                        </tr>

                    </tbody>
                </table>
            </div>



        </div>

        <!--  -->

    </div>

</body>

</html>


<script src="js/doctorDashboard.js"></script>
<script src="js/calender.js"></script>
<script src="js/include.js"></script>
<!-- Icon SCRIPT-->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>