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
  <style>
    .availability-card {
      position: relative;
      width: 100px;
      height: 100px;
      margin: 10px;
      background-color: #f2f2f2;
      border: 1px solid #ddd;
      cursor: pointer;
      transition: transform 0.6s;
      transform-style: preserve-3d;
    }
    .availability-card.flipped {
      transform: rotateY(180deg);
      position: fixed;
      top: 0;
      left: 0;
      width: 50%;
      height: 50%;
      z-index: 9999;
    }
    .availability-card .front, .availability-card .back {
      position: absolute;
      width: 50%;
      height: 50%;
      backface-visibility: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 1.2em;
    }
    .availability-card .back {
      background-color: #c8e6c9;
      transform: rotateY(180deg);
    }
    .availability-container {
      display: flex;
      flex-wrap: wrap;
    }
  </style>
</head>
<body>
  <?php include 'navbar/navbar.php'; ?>
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
          <p style="display: block;" class="description" id="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec libero non lacus cursus consectetur nec nec tortor.</p>
          <textarea rows="4" cols="35" style="display: none;" id="editdescription" name="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec libero non lacus cursus consectetur nec nec tortor.</textarea>
        </div>
        <div class="card-content">
          <div class="form-group">
            <label for="linkedin">LinkedIn:</label>
            <input type="url" class="form-control" id="linkedin" name="linkedin" value="https://www.linkedin.com/in/yourprofile">
          </div>
          <div class="form-group">
            <label for="optional-link1">Additional Link:</label>
            <input type="url" class="form-control" id="optional-link1" name="optional-link1" value="https://www.example.com">
          </div>
          <div class="form-group">
            <label for="optional-link2">Additional Link:</label>
            <input type="url" class="form-control" id="optional-link2" name="optional-link2" value="https://www.example.com">
          </div>
        </div>
        <button style="margin-left: 25%;" class="btn btn-primary save-btn button" id="edit-button">Edit</button>
        <button type="button" class="btn btn-primary save-btn button" id="save-links-button">Save</button>
      </form>
    </div>
    <div class="availability-container" id="availability-container">
      <!-- Availability cards will be dynamically inserted here -->
    </div>
  </div>

  <script src="js/include.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      $.ajax({
        type: 'GET',
        url: 'fetchAvailability.php',
        dataType: 'json',
        success: function (data) {
          const container = document.getElementById("availability-container");

          const daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
          const availabilityByDay = {};

          // Organize availability by day
          daysOfWeek.forEach(day => {
            availabilityByDay[day] = data.filter(slot => slot.day === day);
          });

          daysOfWeek.forEach(day => {
            const slots = availabilityByDay[day];
            const card = document.createElement("div");
            card.className = "availability-card";
            card.innerHTML = `
              <div class="front">${day}</div>
              <div class="back">${slots.map(slot => `${slot.start_time} - ${slot.end_time}`).join('<br>')}</div>
            `;
            card.addEventListener("click", function () {
              card.classList.toggle("flipped");
            });
            container.appendChild(card);
          });
        },
        error: function (error) {
          console.error('Error fetching availability data:', error);
        }
      });
    });
  </script>
</body>
</html>
