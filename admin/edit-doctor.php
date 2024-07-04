<?php
session_start();

require "../include/connection.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
  header("Location: ../login/login.php");
  exit();
}

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
  header("Location: admin-doctor-edit.php");
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
          <a href="admin-doctor-edit.php" class="breadcrumbs-link">Doctor</a>
        </li>
        <li class="breadcrumbs-item">
          <a href="#" class="breadcrumbs-link active">Edit Doctor</a>
        </li>
      </ul>
    </div>

    <div class="edit-doctor" id="edit-doctor">
      <h1>Edit doctors</h1>
      <form action="edit-doctor.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <div class="input-row">
          <div class="input-group">
            <label>First Name</label>
            <input type="text" name="fname" value="<?php echo $fname; ?>" required />
          </div>
          <div class="input-group">
            <label>Last Name</label>
            <input type="text" name="lname" value="<?php echo $lname; ?>" required />
          </div>
        </div>
        <div class="input-row">
          <div class="input-group">
            <label>Gender</label>
            <select class="select" name="gender" required>
              <option value="male" <?php if ($gender == 'male') echo 'selected'; ?>>Male</option>
              <option value="female" <?php if ($gender == 'female') echo 'selected'; ?>>Female</option>
              <option value="others" <?php if ($gender == 'others') echo 'selected'; ?>>Others</option>
            </select>
          </div>
          <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>" required />
          </div>
        </div>
        <div class="input-row">
          <div class="input-group">
            <label>Date of Birth</label>
            <input type="date" name="dob" value="<?php echo $dob; ?>" required /> <!-- Adding DOB input field -->
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
