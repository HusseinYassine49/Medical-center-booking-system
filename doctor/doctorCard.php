<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Card</title>
  <link rel="stylesheet" href="navbar/navbar.css">
  <link rel="stylesheet" href="css/doctorCard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>

<?php include 'navbar/navbar.php';?>
  <div class="container dashboard">
 
     
        <div class="card info">
          <div class="image-content">
            <span class="overlay"></span>
            <div class="card-image">
              <img src="../img//images.jpeg" alt="" class="card-img">
            </div>
          </div>
          <div class="card-content">
            <div>
              <h2 class="name"><i class="fas fa-user"></i> Doctor Name</h2>
              <h2 class="name"><i class="fas fa-map-marker-alt"></i> Address</h2>
            </div>
            <div>
              <h2 class="name"><i class="fas fa-phone"></i> Phone number</h2>
              <h2 class="name"><i class="fas fa-envelope"></i> Email</h2>
            </div><br>
            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec libero non lacus
              cursus consectetur nec nec tortor.</p>
            <button class="btn btn-primary button">Edit</button>
          </div>
        </div>
     
     
        <div class="card major">
          <div class="image-content">
            <span class="overlay"></span>
            <div class="card-image">
              <img src="../img//micro-lessons.jpg" alt="" class="card-img">
            </div>
          </div>
          <div class="card-content">
            <h5 class="major">Major: <span>Cardiology</span></h5>
            <p class="certification">About certification: <span>Board Certified</span></p>
            <button class="btn btn-primary button">Edit</button>
          </div>
        </div>
   
     
        <div class="card availability">
          <div class="availability-picker">
            <input type="datetime-local" /><br>
            <button id="addAvailability" class="btn btn-primary mt-2">Add Availability</button>
          </div><br>
          <div id="availabilityList">
            <!-- Availability slots will be displayed here -->
          </div>
        </div>
     
   
  </div>





</body>

</html>
<script>
  document.getElementById('addAvailability').addEventListener('click', function() {
      const input = document.querySelector('.availability-picker input');
      const availabilityList = document.getElementById('availabilityList');

      const selectedTime = input.value;

      if (selectedTime) {
          const newAvailability = document.createElement('div');
          newAvailability.textContent = new Date(selectedTime).toLocaleString();
          availabilityList.appendChild(newAvailability);

          input.value = '';  // Clear the input after adding
      } else {
          alert('Please select a date and time.');
      }
  });
</script>
<script src="js/include.js"></script>
<!-- Icon SCRIPT-->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>