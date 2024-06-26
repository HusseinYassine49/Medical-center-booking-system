<?php
session_start();
require "../include/connection.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
  header("Location: ../login/login.php");
  exit();
}

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
  <link rel="stylesheet" href="navbar/navbar.css">
  <link href="css/table.css" rel="stylesheet">
  <link href="css/admin-doctor-edit.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  
</head>
<body>
  <?php include 'navbar/navbar.php';?>

  <div class="main-page" id="main-page">

  <div class="sphere top-left-sphere"></div>
  <div class="sphere bottom-right-sphere"></div>
  
    <div class="bread-container">
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="../index.html" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>
        </li>
        <li class="breadcrumbs-item">
          <a href="admin-dashboard.php" class="breadcrumbs-link">Dashboard</a>
        </li>
        <li class="breadcrumbs-item">
          <a href="#" class="breadcrumbs-link active">Add Patient</a>
        </li>
      </ul>
    </div>

    <div class="add-doctor" id="add-doctor" style="display: none;">
      <h1>ADD Patient</h1>

      
      <form id="registration-form">
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
            <input type="submit" value="Register" onclick="registerPatient(event)"/>
        </div>
    </div>
</form>
    </div>

    <div class="container">
      <h2>Table admin to see Patient</h2>
      <button id="toggle-btn" class="circle"><i class="fa-solid fa-plus"></i></button>
      <div class="search-and-table-container">
      <div class="table-content">      
          <div class="form__group search-container">
            <input type="text" class="form__input" id="gfg" placeholder="Search the table for Patient's Name, Status, or ID:" required="" />
            <label for="name" class="form__label">Search the table for Patient's Name, Status, or ID:</label>
          </div>

          <table class="tbl" id="filter">
            <thead>
              <tr>
                <th>Patient ID</th>
                <th>Patient FirstName</th>
                <th>Patient LastName</th>
                <th>Patient Email</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td data-label='Patient ID' class='user-id'>" . $row["id"] . "</td>";
                  echo "<td data-label='Patient Name'>" . $row["Fname"] . "</td>";
                  echo "<td data-label='Patient Name'>" . $row["Lname"] . "</td>";
                  echo "<td data-label='Patient Email'>" . $row["Email"] . "</td>";
                  echo "<td data-label='DoB'>" . $row["DOB"] . "</td>";
                  echo "<td data-label='Gender'>" . $row["Gender"] . "</td>";
                  echo "<td data-label='Edit'><a href='edit-user.php?id=" . $row["id"] . "&fname=" . $row["Fname"] . "&lname=" . $row["Lname"] . "&dob=" . $row["DOB"]  . "&email=" . $row["Email"] . "&gender=" . $row["Gender"] . "' class='btn-edit'><i class='fa-solid fa-pencil'></i></a></td>";
                  echo "<td data-label='Delete'><button class='btn-trash'><i class='fa-solid fa-trash'></i></button></td>";
                  echo "</tr>";
                }
              } else {
                echo "<tr><td colspan='8'>No results found</td></tr>";
              }
              $con->close();
              ?>
            </tbody>
          </table>
          </div>
      </div>
    </div>
  </div>
  
<script src="js/addbtn.js"></script>
<script src="js/deletebtn.js"></script>
<script src="js/A-U-AJAX.js"></script>

</body>
</html>


<!-- Icon SCRIPT-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="navbar/include.js"></script>

