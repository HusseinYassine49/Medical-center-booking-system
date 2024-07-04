<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="css/adminpage.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="toggle">

</div>
<?php
$current_page = basename($_SERVER['PHP_SELF']);

$dashboard_active = '';
$doctor_active = '';
$user_active = '';
$feedback_active = '';
$department_active = '';
$verify= '';
$feedbackinfo_active = '';


if ($current_page == 'admin-dashboard.php') {
  $dashboard_active = 'h-active';
} elseif ($current_page == 'admin-doctor-edit.php') {
  $doctor_active = 'h-active';
} elseif ($current_page == 'admin-user-edit.php') {
  $user_active = 'h-active';
} elseif ($current_page == 'admin-feedback.php') {
  $feedback_active = 'h-active';
}elseif ($current_page == 'feedbackinfo.php') {
  $feedbackinfo_active = 'h-active';
}
elseif ($current_page == 'admin-department.php') {
  $department_active = 'h-active';
}elseif ($current_page == 'admin-verify.php') {
  $verify_active = 'h-active';
}
?>

<div class="h-navigation">
  <ul>
      <div class="h-logo" style="--bg:#333;">
          <a href="#">
          </a>
      </div>
      <li class="list <?php echo $dashboard_active; ?>" style="--bg:#2262b1;">
          <a href="../admin/admin-dashboard.php">
              <span class="h-icon"><i class="fa-solid fa-house"></i></span>
              <span class="h-title">Home</span>
          </a>
      </li>
      <li class="list <?php echo $doctor_active; ?>" style="--bg:#2262b1;">
          <a href="../admin/admin-doctor-edit.php">
              <span class="h-icon"><i class="fa-solid fa-user-doctor"></i></span>
              <span class="h-title">Doctor</span>
          </a>
      </li>
      <li class="list <?php echo $user_active; ?>" style="--bg:#2262b1;">
          <a href="../admin/admin-user-edit.php">
              <span class="h-icon"><i class="fa-solid fa-user"></i></span>
              <span class="h-title">User</span>
          </a>
      </li>
      <li class="list <?php echo $feedback_active; ?>  <?php echo $feedbackinfo_active ?>" style="--bg:#2262b1;">
          <a href="../admin/admin-feedback.php">
              <span class="h-icon"><i class="fa-solid fa-comment"></i></span>
              <span class="h-title">Feedback</span>
          </a>
      </li>
      <li class="list <?php echo $department_active; ?>" style="--bg:#2262b1;">
          <a href="../admin/admin-department.php">
              <span class="h-icon"><i class="fa-solid fa-house-chimney-medical"></i></span>
              <span class="h-title">Department</span>
          </a>
      </li>

      <li class="list <?php echo $verify_active; ?>" style="--bg:#2262b1;">
          <a href="../admin/admin-verify.php">
              <span class="h-icon"><i class="fa-solid fa-certificate"></i></span>
              <span class="h-title">Verify</span>
          </a>
      </li>

      <li class="list" style="--bg:#2262b1;">
          <a href="../login/logout.php">
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
<script src="navbar/include.js"></script>