<div class="toggle">

  </div>


  <!-- <div class="navigation">
    <ul>
      <div class="logo" style="--bg:#333;">
        <a href="#">
        </a>
      </div>
      <li class="list active" style="--bg:#2262b1;">
        <a href="#">
          <span class="h-icon"><ion-icon name="home-outline"></ion-icon> </span>
          <span class="h-title">Home</span>
        </a>
      </li>
      <li class="list" style="--bg:#2262b1;">
        <a href="#">
          <span class="h-icon"><ion-icon name="person-outline"></ion-icon></span>
          <span class="h-title">Profile</span>
        </a>
      </li>
      <li class="list" style="--bg:#2262b1;">
        <a href="#">
          <span class="h-icon"><ion-icon name="chatbubble-outline"></ion-icon></span>
          <span class="h-title">Message</span>
        </a>
      </li>
      <li class="list" style="--bg:#2262b1;">
        <a href="#">
          <span class="h-icon"><ion-icon name="search-outline"></ion-icon></span>
          <span class="h-title">Search</span>
        </a>
      </li>
      <li class="list" style="--bg:#2262b1;">
        <a href="#">
          <span class="h-icon"><ion-icon name="exit-outline"></ion-icon></span>
          <span class="h-title">Exit</span>
        </a>
      </li>
    </ul>
  </div> -->


  <?php
$current_page = basename($_SERVER['PHP_SELF']);

$dashboard_active = '';
$doctor_active = '';
$user_active = '';
$feedback_active = '';



if ($current_page == 'admin-dashboard.php') {
    $dashboard_active = 'h-active';
} elseif ($current_page == 'admin-doctor-edit.php') {
    $doctor_active = 'h-active';
} elseif ($current_page == 'admin-user-edit.php') {
    $user_active = 'h-active';
} elseif ($current_page == 'admin-feedback.php') {
    $feedback_active = 'h-active';
}
?>

<div class="h-navigation">
    <ul>
        <div class="h-logo" style="--bg:#333;">
            <a href="#">
            </a>
        </div>
        <li class="list <?php echo $dashboard_active; ?>" style="--bg:#2262b1;">
            <a href="admin-dashboard.php">
                <span class="h-icon"><i class="fa-solid fa-house"></i></span>
                <span class="h-title">Home</span>
            </a>
        </li>
        <li class="list <?php echo $doctor_active; ?>" style="--bg:#2262b1;">
            <a href="admin-doctor-edit.php">
                <span class="h-icon"><i class="fa-solid fa-user-doctor"></i></span>
                <span class="h-title">Doctor</span>
            </a>
        </li>
        <li class="list <?php echo $user_active; ?>" style="--bg:#2262b1;">
            <a href="admin-user-edit.php">
                <span class="h-icon"><i class="fa-solid fa-user"></i></span>
                <span class="h-title">User</span>
            </a>
        </li>
        <li class="list <?php echo $feedback_active; ?>" style="--bg:#2262b1;">
            <a href="admin-feedback.php">
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


  <script src="../js/include.js"></script>
