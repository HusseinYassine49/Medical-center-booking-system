<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patients</title>
  <link rel="stylesheet" href="navbar/navbar.css">
  <link rel="stylesheet" href="css/doctorPaients.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
<?php include 'navbar/navbar.php';?>
 
  <div class="container dashboard">
    <div class="table-content">
      <table class="tbl" id="filter">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th colspan="2">Check History</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td data-label="Name">John Doe</td>
            <td data-label="Email">example@gmail.com</td>
            <td data-label="Phone">76782908</td>
            <td data-label="History"><Button class="btn-edit"><i class="fas fa-arrow-right"></i></Button>
            </td>
          </tr>
          <tr>
            <td data-label="Name">John Doe</td>
            <td data-label="Email">example@gmail.com</td>
            <td data-label="Phone">76782908</td>
            <td data-label="History"><Button class="btn-edit"><i class="fas fa-arrow-right"></i></Button>
            </td>
          </tr>
          <tr>
            <td data-label="Name">John Doe</td>
            <td data-label="Email">example@gmail.com</td>
            <td data-label="Phone">76782908</td>
            <td data-label="History"><Button class="btn-edit"><i class="fas fa-arrow-right"></i></Button>
            </td>
          </tr>
          <tr>
            <td data-label="Name">John Doe</td>
            <td data-label="Email">example@gmail.com</td>
            <td data-label="Phone">76782908</td>
            <td data-label="History"><Button class="btn-edit"><i class="fas fa-arrow-right"></i></Button>
            </td>
          </tr>

        </tbody>
      </table>
    </div>

    <div class="patient-history-container" id="patient-history-container">

      <div class="patient-details">
        <div>
          <p><strong>Name:</strong> John Doe</p>
          <p><strong>Age:</strong> 45</p>
        </div>
        <div style="margin-left: 20%;">
          <p><strong>Gender:</strong> Male</p>
          <p><strong>Blood Type:</strong> B+</p>
        </div>
      </div>
      <div class="appointment-history">
        <h5>Appointment History</h5>
        <table class="appointment-table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Time</th>
              <th>Notes</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>01/10/2024</td>
              <td>10:00 AM</td>
              <td>Routine check-up</td>
            </tr>
            <tr>
              <td>02/15/2024</td>
              <td>11:30 AM</td>
              <td>Follow-up on blood test results</td>
            </tr>
            <tr>
              <td>03/20/2024</td>
              <td>2:00 PM</td>
              <td>Consultation for knee pain</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>





  </div>

  


</html>
<script>
  // Get all elements with the class name "btn-check"
  var buttons = document.querySelectorAll(".btn-edit");

  // Add event listener to each button
  buttons.forEach(function (button) {
    button.addEventListener("click", function () {
      var patientWindow = document.getElementById("patient-history-container");
      patientWindow.style.visibility = "visible";
    });
  });
</script>
<script src="js/include.js"></script>
<!-- Icon SCRIPT-->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>