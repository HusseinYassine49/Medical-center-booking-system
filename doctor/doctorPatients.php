<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patients</title>
  <link rel="stylesheet" href="navbar/navbar.css">
  <link rel="stylesheet" href="css/doctorPaients.css">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
  <?php include 'navbar/navbar.php'; ?>

  <div class="main-page">
    <div class="sphere top-sphere"></div>
    <div class="sphere bottom-sphere"></div>

    <div class="bread-container">
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="../home.php" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>
        </li>
        <li class="breadcrumbs-item">
          <a href="doctorDashboard.php" class="breadcrumbs-link">Dashboard</a>
        </li>
        <li class="breadcrumbs-item">
          <a href="doctorPatients.php" class="breadcrumbs-link active">Patients</a>
        </li>
      </ul>
    </div>
    <div class="containerr dashboard">
      
      <div class="table-content">
      <div class="search-container">
        <input type="text" id="searchInput" class="form-control" placeholder="Search by patient name">
      </div>
        <table class="tbl" id="filter">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Birth</th>
              <th colspan="2">History</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <div class="patient-history-container" id="patient-history-container">
        <div class="row row1">
          <div class="col-md-6">
            <h4 class="text-center" id="patient-name"></h4><br>
            <div class="row text-center">
              <div class="col-md-12 d-flex flex-row">
                <div class="col-md-6">
                  <p><span class="info-label">Gender</span><br><span id="patient-gender"></span></p>
                </div>
                <div class="col-md-6">
                  <p><span class="info-label">Birthday</span><br><span id="patient-birthday"></span></p>
                </div>
              </div>
              <div class="divider"></div>
              <div class="col-md-12 d-flex flex-row">
                <div class="col-md-5">
                  <p><span class="info-label">Blood Group</span><br><span id="patient-blood-group"></span></p>
                </div>
                <div class="col-md-8">
                  <p><span class="info-label">Last Appointment Date</span><br><span id="last-appointment-date"></span></p>
                </div>
              </div>
            </div>
          </div>
          <div class="appointments-divider"></div>
          <div class="col-md-5" style="margin-top: 5%;font-size:1.3rem">
            <h5 class="text-center">Appointments</h5>
            <div class="d-flex flex-row appointments">
              <div class="col-md-4">
                <div class="appointment-count" id="past-appointments"></div>
                <div class="appointment-label">Past</div>
              </div>
              <div class="appointments-divider"></div>
              <div class="col-md-6">
                <div class="appointment-count" id="upcoming-appointments"></div>
                <div class="appointment-label">Upcoming</div>
              </div>
            </div>
          </div>
        </div>
        <div class="row row2">
          <div class="col-12">
            <h5 class="text-center">Previous Appointments</h5>
            <table class="table table-striped appointment-table tbl">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Notes</th>
                </tr>
              </thead>
              <tbody id="appointment-history">
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="notes">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h5 class="text-center mb-4">Doctor's Prescription</h5>
              <form id="appointment-notes-form" action="generate_report.php" method="POST">
                <div class="row">
                  <div class="col-md-4 form-group">
                    <label for="patient-name">Patient Name:</label>
                    <input type="text" class="form-control" id="patient-name" name="patient-name">
                  </div>
                  <div class="col-md-4 form-group">
                    <label for="doctor-name">Doctor Name:</label>
                    <input type="text" class="form-control" id="doctor-name" name="doctor-name">
                  </div>
                  <div class="col-md-4 form-group">
                    <label for="date">Date:</label>
                    <input type="text" class="form-control" id="date" name="date">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 form-group">
                    <label for="reason">Reason for Admission:</label>
                    <textarea class="form-control" id="reason" rows="4" name="reason"></textarea>
                  </div>
                  <div class="col-md-6 form-group">
                    <label for="diagnosis">Diagnosis:</label>
                    <textarea class="form-control" id="diagnosis" rows="4" name="diagnosis"></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 form-group">
                    <label for="medications">Medications:</label>
                    <textarea class="form-control" id="medications" rows="4" name="medications"></textarea>
                  </div>
                  <div class="col-md-6 form-group">
                    <label for="examinations">Examinations and X-ray Needed:</label>
                    <textarea class="form-control" id="examinations" rows="4" name="examinations"></textarea>
                  </div>
                </div>
                <button type="submit" class="text-center btn btn-primary mt-1 print-report-btn" id="print-report-btn">Print PDF</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="js/doctorPatients.js"></script>
  <script src="js/include.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  
</body>
</html>
