<?php
session_start();
$userID = isset($_GET['userID']) ? $_GET['userID'] : null;
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Appointment</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="css/appointment.css" rel="stylesheet">
    <link href="navbar/navbar.css" rel="stylesheet">
</head>

<body>

    <?php include 'navbar/navbar.php '; ?>
    <div class="main-page">



        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <a href="javascript:void(0)" name="sidebar" class="sidebar-close-btn" id="sidebar-close-btn">&times;</a>
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

        <!-- Main Content -->
        <div class="container">
            <!-- Row for Instructions -->
            <div class="row">
                <div class="instructions">
                    <h1 class="text-center">Instructions</h1>
                    <ul>
                        <li>Any appointment can be made for the current day or for a future date.</li>
                        <li>No two appointments should overlap. If an appointment already exists for a day, a warning
                            should be shown.</li>
                        <li>Appointments can be edited and deleted.</li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="calendar col-md-8 offset-md-2">
                    <div class="card-header bg-primary">
                        <ul>
                            <li id="month" class="text-white text-uppercase text-center"></li>
                            <li id="year" class="text-white text-uppercase text-center"></li>
                        </ul>
                    </div>
                    <table class="table calendar table-bordered table-responsive-sm" id="calendar">
                        <thead>
                            <tr class="weekdays bg-dark">
                                <th scope="col" class="text-white text-center">Mo</th>
                                <th scope="col" class="text-white text-center">Tu</th>
                                <th scope="col" class="text-white text-center">We</th>
                                <th scope="col" class="text-white text-center">Th</th>
                                <th scope="col" class="text-white text-center">Fr</th>
                                <th scope="col" class="text-white text-center">Sa</th>
                                <th scope="col" class="text-white text-center">Su</th>
                            </tr>
                        </thead>
                        <tbody class="days bg-light" id="days"></tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col offset-md-1">
                    <form id="form_create_appointment">
                        <div class="col form-group">
                            <label class="required">Date</label>
                            <input class="form-control date-input" type="date" id="date" required>
                        </div>
                        <div class="col form-group">
                            <label>Description</label>
                            <input class="form-control" type="text" id="description">
                        </div>
                        <div class="col form-group">
                            <label class="required">Select Clinic</label>
                            <select class="form-control" id="clinic" required>
                                <option value="" disabled selected>Select Clinic</option>
                                <option value="Clinic 1">Clinic 1</option>
                                <option value="Clinic 2">Clinic 2</option>
                                <option value="Clinic 3">Clinic 3</option>
                            </select>
                        </div>
                        <div class="col form-group">
                            <label class="required">Select Doctor</label>
                            <select class="form-control" id="doctor" required>
                                <option value="" disabled selected>Select Doctor</option>
                                <option value="1">Doctor A</option>
                                <option value="2">Doctor B</option>
                                <option value="3">Doctor C</option>
                            </select>
                        </div>
                        <div class="col form-group">
                            <label class="required">Start Time</label>
                            <input class="form-control time-input" type="time" id="start_time" required>
                        </div>

                        <input type="hidden" id="original_datetime">
                        <div class="form-row">
                            <div class="col form-group">
                                <button type="button" class="btn btn-warning btn-block" id="clear" onclick="clear_input()">Clear Form</button>
                            </div>
                            <div class="col form-group">
                                <button type="button" class="btn btn-primary btn-block" id="submit" onclick="makeAppointment()">Make Appointment</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col offset-md-1">
                    <div class="row">
                        <div class="col">
                            <h3>Appointments</h3>
                        </div>
                        <div class="col form-group">
                            <button type="button" class="btn btn-danger btn-block" id="btn_clear_storage" onclick="clear_storage()">Clear Appointments</button>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover table-striped table-sm" id="appointment_list">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center align-middle">Date</th>
                                <th scope="col" class="text-center align-middle">Description</th>
                                <th scope="col" class="text-center align-middle">Clinic</th>
                                <th scope="col" class="text-center align-middle">Doctor</th>
                                <th scope="col" class="text-center align-middle">Start time</th>

                                <th scope="col" class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Appointment List Items -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
        <!-- <script src="js/appointment.js"></script> -->

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            alert('<?php echo $userID; ?>');

            const userID = '<?php echo $userID; ?>';

            function makeAppointment() {
                const doctorID = $('#doctor').val();
                const details = $('#description').val();
                const delete_ = '0'; // Or any other value you want to set for delete_
                const date_ = $('#date').val();
                const verified_ = '0'; // Or any other value you want to set for verified_

                $.ajax({
                    url: 'save_appointment.php',
                    type: 'POST',
                    data: {
                        doctorID: doctorID,
                        userID: userID,
                        details: details,
                        delete_: delete_,
                        date_: date_,
                        verified_: verified_
                    },
                    success: function(response) {
                        alert(response);
                        console(response);
                        // Optionally, you can refresh the appointment list or calendar here
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }

            function clear_input() {
                $('#form_create_appointment')[0].reset();
            }
        </script>
</body>

</html>
