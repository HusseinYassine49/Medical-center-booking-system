<?php
include 'session_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback</title>
  <link rel="stylesheet" href="navbar/navbar.css">
  <link rel="stylesheet" href="css/doctorFeedback.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
  <?php include 'navbar/navbar.php';?>
  <div class="bread-container">
    <ul class="breadcrumbs">
      <li class="breadcrumbs-item">
        <a href="../index.html" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>
      </li>
      <li class="breadcrumbs-item">
        <a href="doctorDashboard.php" class="breadcrumbs-link">Dashboard</a>
      </li>
      <li class="breadcrumbs-item">
        <a href="doctorFeedback.php" class="breadcrumbs-link active">Feedback</a>
      </li>
    </ul>
  </div>
  <div class="container" id="feedback-container">
   
  </div>
  
  <script src="js/doctorFeedback.js"></script>
</body>
</html>
