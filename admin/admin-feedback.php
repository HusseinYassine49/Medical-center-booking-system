<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback System</title>
    <link rel="stylesheet" href="css/adminfeedback.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>

<?php include 'navbar/navbar.php';?>

    <div class="main-page" id="main-page">

        <div class="bread-container">
            <ul class="breadcrumbs">
              <li class="breadcrumbs-item">
                <a href="../../index.html" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>     
              </li>
              <li class="breadcrumbs-item">
                <a href="adminpage.html" class="breadcrumbs-link">Dashboard</a> 
              </li>
              <li class="breadcrumbs-item">
                <a href="#" class="breadcrumbs-link active">Feedback</a>
              </li>
          
            </ul>
          </div>


          
  <div class="feedback-container">
    <h1>Feedback System</h1>
    
    <table id="feedback-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Patient</th>
                <th>Feedback</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="feedback-list">
            <!-- Feedback items will be dynamically added here -->
        </tbody>
    </table>
    <!-- Add this button where you see fit in your main page -->
<button class="feedbackinfo-btn" onclick="viewFeedbackInfo()">View Feedback Information</button>

</div>  


    </div>


    <script src="js/feedback.js"></script>
</body>
</html>
