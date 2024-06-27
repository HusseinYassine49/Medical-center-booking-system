<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
</head>
<body>

 <?php
$current_page = basename($_SERVER['PHP_SELF']);

$dashboard_active = '';
$Appointments_active = '';
$Patients_active = '';
$Card_active = '';
$feedback_active='';
if ($current_page == 'doctorDashboard.php') {
    $dashboard_active = 'h-active';
} elseif ($current_page == 'doctorAppointments.php') {
    $Appointments_active = 'h-active';
} elseif ($current_page == 'doctorPatients.php') {
    $Patients_active = 'h-active';
} elseif ($current_page == 'doctorCard.php') {
    $Card_active = 'h-active';
}elseif ($current_page == 'doctorFeedback.php') {
  $feedback_active = 'h-active';
}
?>
<div class="navigation">
  <ul>
    <div class="logo" style="--bg:#333;">
      <a href="#">
      </a>
    </div>
    <li class="list <?php echo $dashboard_active; ?> " style="--bg:#f5f5f5;">
      <a href="doctorDashboard.php">
        <span class="h-icon"><ion-icon name="home-outline"></ion-icon> </span>
        <span class="h-title">Home</span>
      </a>
    </li>
    
    <li class="list <?php echo $Patients_active; ?>" style="--bg:#2262b1;">
      <a href="doctorPatients.php">
        <span class="h-icon"><ion-icon name="people-outline"></ion-icon>
        </span>
        <span class="h-title">Patients</span>
      </a>
    </li>
    <li class="list <?php echo $Card_active; ?>" style="--bg:#2262b1;">
      <a href="doctorCard.php">
        <span class="h-icon"><ion-icon name="card-outline"></ion-icon>
        </span>
        <span class="h-title">My Card</span>
      </a>
    </li>
    <li class="list <?php echo $feedback_active; ?>" style="--bg:#2262b1;">
      <a href="doctorFeedback.php">
        <span class="h-icon"><ion-icon name="chatbubble-ellipses-outline"></ion-icon>
        </span>
        <span class="h-title">Feedback</span>
      </a>
    </li>
    <li class="list" style="--bg:#2262b1;">
      <a href="logout.php">
        <span class="h-icon"><ion-icon name="exit-outline"></ion-icon></span>
        <span class="h-title">Exit</span>
      </a>
    </li>
  </ul>
</div>


<div class="h-navigation">
<div class="toggle">
</div>
  <ul>
    <div class="h-logo" style="--bg:#333;">
      <a href="#">
      </a>
    </div>
    <li class="list <?php echo $dashboard_active; ?>" style="--bg:#ffffff;">
      <a href="doctorDashboard.php">
        <span class="h-icon"><i class="fa-solid fa-house"></i></span>
        <span class="h-title">Home</span>
      </a>
    </li>
  
    <li class="list <?php echo $Patients_active; ?>" style="--bg:#ffffff;">
      <a href="doctorPatients.php">
        <span class="h-icon"><i class="fas fa-users"></i>
        </span>
        <span class="h-title">Patients</span>
      </a>
    </li>
    <li class="list <?php echo $Card_active; ?>" style="--bg:#ffffff;">
      <a href="doctorCard.php">
        <span class="h-icon"><i class="fas fa-id-card"></i>
        </span>
        <span class="h-title">My Card</span>
      </a>
    </li>
    <li class="list <?php echo $feedback_active; ?>" style="--bg:#ffffff;">
      <a href="doctorFeedback.php">
        <span class="h-icon"><i class="fas fa-comment-dots"></i>
        </span>
        <span class="h-title">Feedback</span>
      </a>
    </li>
    <li class="list" style="--bg:#ffffff">
      <a href="logout.php">
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
<!--SCRIPT FOR PIE CHART-->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
