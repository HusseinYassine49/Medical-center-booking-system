<?php 
require "connection.php";

$role = 0;
$sql = "SELECT * FROM users WHERE Role = $role";
$result = $con->query($sql);


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="../css/admin-user-edit.css" rel="stylesheet">
  <link href="../css/adminpage.css" rel="stylesheet">
  <link href="../css/admin-doctor-edit.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>


<body>

  <?php include 'navbar.php'; ?>

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
          <a href="#" class="breadcrumbs-link">Patient</a>
        </li>
        <li class="breadcrumbs-item">
          <a href="#" class="breadcrumbs-link active">Add Patient</a>
        </li>

      </ul>
    </div>

    <div class="add-doctor" id="add-doctor" style="display: none;">
      <h1>ADD Patient</h1>


<!--THE FORM TO SEND THE DATA TO BE VERIFIED TO BE INSERTED TO THE DATABASE -->
      <form action="A-U-Reg.php" method="post">

        <div class="input-row">
          <div class="input-group">
            <label>Fist Name</label>
            <input type="text" name="fname" />
          </div>

          <div class="input-group">
            <label>Last Name</label>
            <input type="text" name="lname" />
          </div>
        </div>

        <div class="input-row">
          <div class="input-group">
            <label for="register-gender">Gender</label>

            <select class="select" name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="others">Others</option>
            </select>

          </div>

          <div class="input-group">
            <label>Address</label>
            <input type="text" name="address" />
          </div>
        </div>

        <div class="input-row">
          <div class="input-group">
            <label>Date</label>
            <input type="date" name="dob" />
          </div>

          <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" />
          </div>
        </div>

        <div class="input-row">
          <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" />
          </div>

          <div class="input-group">
            <label>Confirm</label>
            <input type="password" name="confirm-password" />
          </div>
        </div>


        <div class="input-row">

          <div class="input-group">
            <label></label>
            <input type="submit" name="insert" />
          </div>
        </div>


    </div>


    </form>





    <div class="container">
      <div class="table-content">


        <div class="top-circle"><button id="toggle-btn" class="circle"><i class="fa-solid fa-plus"></i></button>


          <h2>Table admin to see Patient</h2>
          <b>

            <div class="form__group">
              <input type="text" class="form__input" id="gfg" placeholder="Search the table for Patient's Name, Status, or ID:" required="" />
              <label for="name" class="form__label">Search the table for Patient's Name, Status, or ID:</label>
            </div>

          </b>


          <table class="tbl" id="filter">
              <thead>
                <tr>
                  <th>Patient ID</th>
                  <th>Patient FirstName</th>
                  <th>Patient LastName</th>
                  <th>Patient Email</th>
                  <th>Gender</th>
                  <th colspan="2">Action</th>
                </tr>
              </thead>
              <tbody>

                <?php
                if ($result->num_rows > 0) {
                  // Output data of each row
                  while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td data-label='Patient ID'>" . $row["id"] . "</td>";
                    echo "<td data-label='Patient Name'>" . $row["Fname"] . "</td>";
                    echo "<td data-label='Patient Name'>" . $row["Lname"] . "</td>";
                    echo "<td data-label='Patient Email'>" . $row["Email"] . "</td>";
                    echo "<td data-label='Gender'>" . $row["Gender"] . "</td>";
                    echo "<td data-label='Edit'><Button class='btn-edit'><i class='fa-solid fa-pencil'></i></Button></td>";
                    echo "<td data-label='Delete'><Button class='btn-trash'><i class='fa-solid fa-trash'></i></Button></td>";
                    echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='6'>No results found</td></tr>";
                }
                $con->close();                
                 ?>
              </tbody>
            </table>
        </div>

      </div>
    </div>
  </div>

  </div>

</body>

</html>


<script src="../js/include.js"></script>
<script>
  $(document).ready(function() {
    $("#gfg").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#filter tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });


  const toggle = document.getElementById('toggle-btn');
  const form = document.getElementById('add-doctor');

  toggle.addEventListener('click', () => {
    if (form.style.display === "none") {
      form.style.display = "block";
    } else {
      form.style.display = "none";
    }
  })
</script>