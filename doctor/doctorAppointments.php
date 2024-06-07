<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Appointments</title>
  <link rel="stylesheet" href="navbar/navbar.css">
  <link rel="stylesheet" href="css/doctorAppointments.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
<?php include 'navbar/navbar.php';?>

      <div class="container dashboard table-content">

        <div>
          <table class="tbl" id="filter">
            <h5>Upcoming Appointments:</h5>
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
                <td data-label="Status"><i class="fas fa-clock status-icon"></i>  Waiting</td>
              </tr>
              <tr>
                <td data-label="Name">Fatima Atwi</td>
                <td data-label="Date">5/20/2024</td>
                <td data-label="Time">10:10 AM</td>
                <td data-label="Status"><i class="fas fa-clock status-icon"></i>  Waiting</td>
              </tr>
              <tr>
                <td data-label="Name">Fatima Atwi</td>
                <td data-label="Date">5/20/2024</td>
                <td data-label="Time">10:10 AM</td>
                <td data-label="Status"><i class="fas fa-clock status-icon"></i>  Waiting</td>
              </tr>

            </tbody>
          </table>
        </div>
        <div class="table2">
          <table class="tbl" id="filter">
            <h5>Pending Appointments:</h5>
            <thead>
              <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Approve</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td data-label="Name">Fatima Atwi</td>
                <td data-label="Date">5/20/2024</td>
                <td data-label="Time">10:10 AM</td>
                <td data-label="Status">
                  <input type="checkbox" id="confirmationCheckbox">
                </td>
              </tr>
              <tr>
                <td data-label="Name">Fatima Atwi</td>
                <td data-label="Date">5/20/2024</td>
                <td data-label="Time">10:10 AM</td>
                <td data-label="Status"><input type="checkbox" id="confirmationCheckbox"></td>
              </tr>
              <tr>
                <td data-label="Name">Fatima Atwi</td>
                <td data-label="Date">5/20/2024</td>
                <td data-label="Time">10:10 AM</td>
                <td data-label="Status"><input type="checkbox" id="confirmationCheckbox"></td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    
</body>

</html>
<!-- Icon SCRIPT-->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script><script src="js/include.js"></script>
<script src="js/include.js"></script>