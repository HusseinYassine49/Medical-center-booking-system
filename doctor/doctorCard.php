<?php
include 'session_check.php';
$dr = $_SESSION['user_info']['id'];
require "../include/connection.php";


$query = "SELECT Description, linkedin, optional_link1, optional_link2 FROM doctors WHERE UserId = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $dr);
$stmt->execute();
$result = $stmt->get_result();
$doctor = $result->fetch_assoc();

$description = $doctor['Description'];
$linkedin = $doctor['linkedin'];
$optionalLink1 = $doctor['optional_link1'];
$optionalLink2 = $doctor['optional_link2'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Card</title>
  <link rel="stylesheet" href="navbar/navbar.css">
  <link rel="stylesheet" href="css/doctorCard.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
  <?php include 'navbar/navbar.php'; ?>


  <div class="main-page">


  <div class="top-sphere"></div>
  <div class="bottom-sphere"></div>
 
  <div class="bread-container">
    <ul class="breadcrumbs">
      <li class="breadcrumbs-item">
        <a href="../index.html" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>
      </li>
      <li class="breadcrumbs-item">
        <a href="doctorDashboard.php" class="breadcrumbs-link">Dashboard</a>
      </li>
      <li class="breadcrumbs-item">
        <a href="doctorCard.php" class="breadcrumbs-link active">My Card</a>
      </li>
    </ul>
  </div>
  <div class="containerr dashboard">
    <div class="info">
      <form id="doctor-info-form">
        <div class="image-content">
          <span class="overlay"></span>
          <p class="description" id="description"><?php echo htmlspecialchars($description); ?></p>
          <textarea rows="4" cols="25" id="editdescription" name="description" style="display: none;"><?php echo htmlspecialchars($description); ?></textarea>
        </div>
        <div class="card-content">
          <div class="form-group">
            <label for="linkedin">LinkedIn:</label>
            <input type="url" class="form-control" id="linkedin" name="linkedin" value="<?php echo htmlspecialchars($linkedin); ?>" readonly>
          </div>
          <?php if (!empty($optionalLink1)): ?>
          <div class="form-group">
            <label for="optional-link1">Additional Link:</label>
            <input type="url" class="form-control" id="optional-link1" name="optional-link1" value="<?php echo htmlspecialchars($optionalLink1); ?>" readonly>
          </div>
          <?php endif; ?>
          <?php if (!empty($optionalLink2)): ?>
          <div class="form-group">
            <label for="optional-link2">Additional Link:</label>
            <input type="url" class="form-control" id="optional-link2" name="optional-link2" value="<?php echo htmlspecialchars($optionalLink2); ?>" readonly>
          </div> <?php endif; ?>
        </div>
        <button type="button" class="btn btn-primary save-btn button" id="edit-button">Edit</button>
        <button type="button" class="btn btn-primary save-btn button" id="save-links-button" style="display: none;">Save</button>
      </form>
    </div>
    <div style="display: flex;flex-direction:row">
      <form id="doctor-available-form">

        <h4 class="text-center">Weekly Availability:</h4>
        <div>
          <div class="container mt-3">
            <div class="availability-container" id="availability-container">

            </div>
          </div>
        </div>

        <div>
          <table class="editavailability">
            <thead>
              <tr>
                <th>Day</th>
                <?php
                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                foreach ($days as $day) {
                  echo '<th>' . $day . '</th>';
                }
                ?>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Start Time</td>
                <?php
                foreach ($days as $day) {
                  echo '<td><input type="time" id="' . strtolower($day) . '-start" class="time-input"></td>';
                }
                ?>
              </tr>
              <tr>
                <td>End Time</td>
                <?php
                foreach ($days as $day) {
                  echo '<td><input type="time" id="' . strtolower($day) . '-end" class="time-input"></td>';
                }
                ?>
              </tr>
            </tbody>
          </table>
        </div>
        <button style="margin-left: 40%;" type="button" class="btn btn-primary save-btn mt-3 text-center" id="save-availability-button">Save Availability</button>
      </form>
    </div>
  </div>
  </div>

  
  <script src="js/include.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/doctorCard.js"></script>
</body>

</html>