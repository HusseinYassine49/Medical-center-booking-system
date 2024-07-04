<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION['user_id']; // Fetch user ID from session

// Fetch user data from the database
include "../include/connection.php";

$stmt = $con->prepare("SELECT Fname, Email FROM users WHERE id = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['user_fname'] = $row['Fname'];
    $_SESSION['Email'] = $row['Email'];
} else {
    // Handle case where user is not found
    header("Location: login.php");
    exit();
}

$userFname = $_SESSION['user_fname'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Page</title>
    <link href="css/patient.css" rel="stylesheet">
    <link href="css/appointment.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <script>
        const userFname = <?php echo json_encode($userFname); ?>;
    </script>
</head>

<body>
    <?php include 'navbar/navbar.php'; ?>

    <div class="main-page">

        <div class="bread-container">
            <ul class="breadcrumbs">
                <li class="breadcrumbs-item">
                    <a href="../home.php" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>
                </li>
                <li class="breadcrumbs-item">
                    <a href="#" class="breadcrumbs-link active">Patient</a>
                </li>
            </ul>
        </div>


    <div class="sphere top-sphere"></div>
    <div class="sphere mid-sphere-left"></div>

    
        <h1 id="welcome-heading"></h1>
        <p id="welcome-text" style="display:none;">Welcome to our website!</p>

        <div class="main-content" id="main-content">
            <div class="left">
                <a class="image-container" href="appointment.php?userID=<?php echo $userID; ?>">
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
                        <button type="button" class="close" data-dismiss="modal">&times;"></button>
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
            <div class="container">
                <button id="addAppointmentBtn" class="btn btn-primary mb-3" onclick="goToAppointment()">Add Appointment</button>
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="appointmentTableBody">
                    <?php
                    // Assuming $userID is set from the session or another secure source
                    $userID = $_SESSION['user_id']; // Corrected session variable
                    $query = '
                        SELECT a.id, a.doctorID, a.details, a.delete_, a.date_, u.Fname, u.Lname 
                        FROM appointment a
                        JOIN doctors d ON a.doctorID = d.DoctorID
                        JOIN users u ON d.UserID = u.id
                        WHERE a.userID = ?';
                    $stmt = $con->prepare($query);
                    $stmt->bind_param("i", $userID);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            // Convert delete_ column to a readable status
                            $status = $row['delete_'] == 0 ? 'Active' : 'Deleted';

                            // Extract time from date_
                            $dateTime = new DateTime($row['date_']);
                            $time = $dateTime->format('H:i');

                            echo '<tr>
                                <td>' . htmlspecialchars($row['Fname'] . ' ' . $row['Lname']) . '</td>
                                <td>' . htmlspecialchars($row['details']) . '</td>
                                <td>' . htmlspecialchars($row['date_']) . '</td>
                                <td>' . htmlspecialchars($time) . '</td>
                                <td class="status-' . strtolower($status) . '">' . htmlspecialchars($status) . '</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="showEditForm(this)">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteAppointment(this)">Delete</button>
                                </td>
                            </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function goToAppointment() {
            const userID = '<?php echo $userID; ?>';
            window.location.href = 'try.php?userID=' + userID;
        }

        const welcomeHeading = document.getElementById('welcome-heading');
        const welcomeText = document.getElementById('welcome-text');

        let welcomeMessage = `Good Morning, ${userFname}!`;
        let messageIndex = 0;
        let typingSpeed = 100;

        function typeWelcomeMessage() {
            if (messageIndex < welcomeMessage.length) {
                welcomeHeading.textContent += welcomeMessage.charAt(messageIndex);
                messageIndex++;
                setTimeout(typeWelcomeMessage, typingSpeed);
            } else {
                welcomeText.style.display = 'block';
            }
        }

        typeWelcomeMessage();

        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: true,
                events: [
                    // Array of event objects can be fetched here
                ]
            });
        });
    </script>
</body>

</html>
