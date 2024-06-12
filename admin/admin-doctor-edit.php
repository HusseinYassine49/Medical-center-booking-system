<?php 
require "../include/connection.php";

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
    <link rel="stylesheet" href="css/adminpage.css">
    <link href="css/admin-doctor-edit.css" rel="stylesheet">
    <link href="css/doctoradmin.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    


</head>


<body>

<?php include 'navbar/navbar.php';?>

  <div class="main-page" id="main-page">


    <div class="bread-container">
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="../index.html" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>     
        </li>
        <li class="breadcrumbs-item">
          <a href="admin-dashboard.php" class="breadcrumbs-link">Dashboard</a> 
        </li>
        <li class="breadcrumbs-item">
<<<<<<< HEAD
          <a href="#" class="breadcrumbs-link active">Doctor</a>
        </li>
=======
          <a href="#" class="breadcrumbs-link active">Add Doctor</a>
        </li>
    
>>>>>>> ali
      </ul>
    </div>
    
    
    
        <div class="add-doctor" id="add-doctor" style="display: none;">
            <h1>ADD DOCTOR</h1>

            <!--THE FORM TO SEND THE DATA TO BE VERIFIED TO BE INSERTED TO THE DATABASE -->
            <form action="A-D-Reg.php" method="post">

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
            <label for="register-gender">City Address</label>
            <select class="select" name="address">
              <option value="male">Beirut</option>
              <option value="female">Saida</option>
              <option value="others">Tyre</option>
            </select>
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
    
                
                    <div class="top-circle" ><button id="toggle-btn"class="circle"><i class="fa-solid fa-plus"></i></button>
                 
    
                <h2>Table admin to see doctors</h2>
                <b>
    
                    <div class="form__group">
                        <input type="text" class="form__input" id="gfg"
                            placeholder="Search the table for Doctor's Name, Major, or ID:" required="" />
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
                  while($row = $result->fetch_assoc()) {
                    echo "<tr>";
<<<<<<< HEAD
                    echo "<td data-label='Doctor ID' class='user-id'>" . $row["id"] . "</td>";
                    echo "<td data-label='Doctor Name'>" . $row["Fname"] . "</td>";
                    echo "<td data-label='Doctor Name'>" . $row["Lname"] . "</td>";
                    echo "<td data-label='Doctor Email'>" . $row["Email"] . "</td>";
                    echo "<td data-label='DoB'>" . $row["DOB"] . "</td>";
                    echo "<td data-label='Gender'>" . $row["Gender"] . "</td>";
                    echo "<td data-label='Edit'><a href='edit-doctor.php?id=" . $row["id"] . "&fname=" . $row["Fname"] . "&lname=" . $row["Lname"] . "&dob=" . $row["DOB"]  . "&email=" . $row["Email"] . "&gender=" . $row["Gender"] . "' class='btn-edit'><i class='fa-solid fa-pencil'></i></a></td>";
=======
                    echo "<td data-label='Patient ID'>" . $row["id"] . "</td>";
                  echo "<td data-label='Patient Name'>" . $row["Fname"] . "</td>";
                  echo "<td data-label='Patient Name'>" . $row["Lname"] . "</td>";
                  echo "<td data-label='Patient Email'>" . $row["Email"] . "</td>";
                  echo "<td data-label='DoB'>" . $row["DOB"] . "</td>";
                  echo "<td data-label='Gender'>" . $row["Gender"] . "</td>";
                  echo "<td data-label='Edit'><a href='edit-doctor.php?id=" . $row["id"] . "&fname=" . $row["Fname"] . "&lname=" . $row["Lname"] . "&dob=" . $row["DOB"]  . "&email=" . $row["Email"] . "&gender=" . $row["Gender"] . "' class='btn-edit'><i class='fa-solid fa-pencil'></i></a></td>";
>>>>>>> ali
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


</body>

</html>


<!--SCRIPT FOR PIE CHART-->
<script src="navbar/include.js"></script>
<script src="js/addbtn.js"></script>
<script src="js/deletebtn.js"></script>
<<<<<<< HEAD
=======

>>>>>>> ali
