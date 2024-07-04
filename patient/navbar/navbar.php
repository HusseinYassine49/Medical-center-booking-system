<!DOCTYPE html>
<html lang="en">

<head>
  <!-- <link rel="stylesheet" href="./css/adminpage.css"> -->
  <link href="navbar/navbar.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="toggle"></div>
  <?php
  require_once '../include/connection.php';
  if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session only if it hasn't been started yet
  }
  if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];
    echo "Welcome to Patient Dashboard, UserID: $userID";

    if (isset($_SESSION['user_email'])) {
      $userEmail = $_SESSION['user_email'];
      echo "<br>Your email: $userEmail";
    }
  } else {
    header("Location: login.php");
    exit();
  }
  $current_page = basename($_SERVER['PHP_SELF']);

  $dashboard_active = '';
  $doctor_active = '';
  $user_active = '';
  $feedback_active = '';

  if ($current_page == 'patient.php') {
    $dashboard_active = 'h-active';
  } elseif ($current_page == 'doctor.php') {
    $doctor_active = 'h-active';
  } elseif ($current_page == 'appointment.php') {
    $user_active = 'h-active';
  } elseif ($current_page == 'feedback.php') {
    $feedback_active = 'h-active';
  }
  ?>

  <div class="h-navigation">
    <ul>
      <div class="h-logo" style="--bg:#333;">
        <a href="#"></a>
      </div>
      <li class="list <?php echo $dashboard_active; ?>" style="--bg:#2262b1;">
        <a href="patient.php?userID=<?php echo $userID; ?>">
          <span class="h-icon"><i class="fa-solid fa-house"></i></span>
          <span class="h-title">Home</span>
        </a>
      </li>
      <li class="list <?php echo $doctor_active; ?>" style="--bg:#2262b1;">
        <a href="doctor.php?userID=<?php echo $userID; ?>">
          <span class="h-icon"><i class="fa-solid fa-user-doctor"></i></span>
          <span class="h-title">Doctor</span>
        </a>
      </li>
      <li class="list <?php echo $user_active; ?>" style="--bg:#2262b1;">
        <a href="user-edit.php?userID=<?php echo $userID; ?>">
          <span class="h-icon"><i class="fa-solid fa-user"></i></span>
          <span class="h-title">User</span>
        </a>
      </li>
      <li class="list <?php echo $feedback_active; ?>" style="--bg:#2262b1;">
        <a href="feedback.php?userID=<?php echo $userID; ?>">
          <span class="h-icon"><i class="fa-solid fa-comment"></i></span>
          <span class="h-title">Feedback</span>
        </a>
      </li>
      <li class="list" style="--bg:#2262b1;">
        <a href="login.php">
          <span class="h-icon"><i class="fa-solid fa-right-from-bracket"></i></span>
          <span class="h-title">Exit</span>
        </a>
      </li>
    </ul>
  </div>

</body>

</html>

<!-- Icon SCRIPT-->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="./navbar/include.js"></script>