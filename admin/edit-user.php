<?php
require "../include/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST["id"];
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $gender = $_POST["gender"];
  $email = $_POST["email"];
  $dob = $_POST["dob"];  // Adding DOB

  $sql = "UPDATE users SET Fname='$fname', Lname='$lname', Gender='$gender', Email='$email', DOB='$dob' WHERE id='$id'";

  if ($con->query($sql) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $con->error;
  }

  $con->close();
  header("Location: admin-user-edit.php");
  exit();
} else {
  $id = $_GET["id"];
  $fname = $_GET["fname"];
  $lname = $_GET["lname"];
  $gender = $_GET["gender"];
  $email = $_GET["email"];
  $dob = $_GET["dob"];  // Adding DOB
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Doctor</title>
  <link rel="stylesheet" href="css/adminpage.css">
  <link href="css/admin-doctor-edit.css" rel="stylesheet">
  <link href="css/doctoradmin.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
  <?php include 'navbar/navbar.php'; ?>

  <div class="main-page" id="main-page">

    <div class="bread-container">
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="../home.php" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>
        </li>
        <li class="breadcrumbs-item">
          <a href="admin-dashboard.php" class="breadcrumbs-link">Dashboard</a>
        </li>
        <li class="breadcrumbs-item">
          <a href="admin-user-edit.php" class="breadcrumbs-link">Patient</a>
        </li>
        <li class="breadcrumbs-item">
          <a href="#" class="breadcrumbs-link active">Edit Patient</a>
        </li>
      </ul>
    </div>

    <div class="edit-user" id="edit-user">
      <h1>Edit Users</h1>
      <form action="edit-user.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <div class="input-row">
          <div class="input-group">
            <label>First Name</label>
            <input type="text" name="fname" value="<?php echo $fname; ?>" />
          </div>
          <div class="input-group">
            <label>Last Name</label>
            <input type="text" name="lname" value="<?php echo $lname; ?>" />
          </div>
        </div>
        <div class="input-row">
          <div class="input-group">
            <label>Gender</label>
            <select class="select" name="gender">
              <option value="male" <?php if ($gender == 'male') echo 'selected'; ?>>Male</option>
              <option value="female" <?php if ($gender == 'female') echo 'selected'; ?>>Female</option>
              <option value="others" <?php if ($gender == 'others') echo 'selected'; ?>>Others</option>
            </select>
          </div>
          <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>" />
          </div>
        </div>
        <div class="input-row">
          <div class="input-group">
            <label>Date of Birth</label>
            <input type="date" name="dob" value="<?php echo $dob; ?>" /> <!-- Adding DOB input field -->
          </div>
        </div>
        <div class="input-row">
          <div class="input-group">
            <input type="submit" value="Update" />
          </div>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
