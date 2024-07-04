<?php
session_start();

require "../include/connection.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
    header("Location: ../login/login.php");
    exit();
}

$role = 2;
$sql = "SELECT * FROM users WHERE Role = $role";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="css/admin-doctor-edit.css?v=<?php echo time(); ?>" rel="stylesheet">
  <link href="css/table.css?v=<?php echo time(); ?>" rel="stylesheet">
  <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.min.css">




</head>


<body>


  <?php include 'navbar/navbar.php'; ?>

  <div class="main-page" id="main-page">

    <div class="sphere top-sphere"></div>
    <div class="sphere bottom-sphere"></div>

    <div class="bread-container">
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="../home.php" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>
        </li>
        <li class="breadcrumbs-item">
          <a href="admin-dashboard.php" class="breadcrumbs-link">Dashboard</a>
        </li>
        <li class="breadcrumbs-item">
          <a href="#" class="breadcrumbs-link active">Add Doctor</a>
        </li>
      </ul>
    </div>



    <div class="add-doctor" id="add-doctor" style="display: none;">
      <h1>ADD DOCTOR</h1>

      <!--THE FORM TO SEND THE DATA TO BE VERIFIED TO BE INSERTED TO THE DATABASE -->
      <form action="A-U-Reg.php" method="post">

        <div class="input-row">
          <div class="input-group">
            <label>First Name</label>
            <input type="text" name="fname" id="doctor-Fname" required />
          </div>
          <div class="input-group">
            <label>Last Name</label>
            <input type="text" name="lname" id="doctor-Lname" required />
          </div>
        </div>

        <div class="input-row">
          <div class="input-group">
            <label>Date of Birth</label>
            <input type="date" name="dob" id="doctor-dob" required />
          </div>
          <div class="input-group">
            <label>Gender</label>
            <select name="gender" id="doctor-gender" required>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="others">Others</option>
            </select>
          </div>
        </div>

        <div class="input-row">
          <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" id="doctor-email" required />
          </div>
          <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" id="doctor-password" required />
          </div>
        </div>

        <div class="input-row">
          <div class="input-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm-password" id="doctor-confirm-password" required />
          </div>
          <div class="input-group">
            <label></label>
            <input type="submit" value="Register" onclick="AdminregisterDoctor(event)"/>
          </div>
        </div>

      </form>


    </div>





    <div class="container">
      <h2>Table admin to see doctors</h2>
      <button id="toggle-btn" class="circle"><i class="fa-solid fa-plus"></i></button>
      <div class="search-and-table-container">
        <div class="table-content">
          <b>
            <div class="form__group search-container">
              <input type="text" class="form__input" id="gfg" placeholder="Search the table for Doctor's Name, Major, or ID:" required="" />
              <label for="name" class="form__label">Search the table for Doctor's Name, Major, or ID:</label>
            </div>
          </b>
          <table class="tbl" id="filter">
            <thead>
              <tr>
                <th>Doctor ID</th>
                <th>Doctor FirstName</th>
                <th>Doctor LastName</th>
                <th>Doctor Email</th>
                <th>Date of Birth</th>
                <th>Major</th>
                <th>Gender</th>
                <th colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td data-label='Doctor ID' class='user-id'>" . $row["id"] . "</td>";
                  echo "<td data-label='Doctor Name'>" . $row["Fname"] . "</td>";
                  echo "<td data-label='Doctor Name'>" . $row["Lname"] . "</td>";
                  echo "<td data-label='Doctor Email'>" . $row["Email"] . "</td>";
                  echo "<td data-label='DoB'>" . $row["DOB"] . "</td>";
                  echo "<td data-label='Gender'>" . $row["Gender"] . "</td>";
                  echo "<td data-label='Edit'><a href='edit-doctor.php?id=" . $row["id"] . "&fname=" . $row["Fname"] . "&lname=" . $row["Lname"] . "&dob=" . $row["DOB"]  . "&email=" . $row["Email"] . "&gender=" . $row["Gender"] . "' class='btn-edit'><i class='fa-solid fa-pencil'></i></a></td>";
                  echo "<td data-label='Delete'><button class='btn-trash'><i class='fa-solid fa-trash'></i></button></td>";
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

<script src="navbar/include.js"></script>
<script src="js/addbtn.js"></script>
<script src="js/deletebtn.js"></script>
<script src="js/A-D-AJAX.js"></script>

</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.min.js"></script>

