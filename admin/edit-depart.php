<?php
require "../include/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST["id"];
  $name = $_POST["name"];
  $desc = $_POST["desc"];
  $icon = $_POST["icon"]; // Retrieve icon from form data

  $sql = "UPDATE department SET Department_name='$name', Description='$desc', icon='$icon' WHERE id='$id'";

  if ($con->query($sql) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $con->error;
  }

  $con->close();
  header("Location: admin-department.php");
  exit();
} else {
  $id = $_GET["id"];
  $name = $_GET["name"];
  $desc = $_GET["desc"];
  $icon = $_GET["icon"]; // Retrieve icon from query parameters
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Department</title>
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
          <a href="admin-department.php" class="breadcrumbs-link">Department</a>
        </li>
        <li class="breadcrumbs-item">
          <a href="#" class="breadcrumbs-link active">Edit Department</a>
        </li>
      </ul>
    </div>

    <div class="edit-depart" id="edit-depart">
      <h1>Edit Department</h1>
      <form action="edit-depart.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <div class="input-row">
          <div class="input-group">
            <label>Department Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>" />
          </div>
          <div class="input-group">
            <label>Description</label>
            <input type="text" name="desc" value="<?php echo $desc; ?>" />
          </div>
        </div>
        <div class="input-row">
          <div class="input-group">
            <label>Icon</label>
            <input type="text" name="icon" value="<?php echo htmlspecialchars($icon); ?>" />
            <!-- Optionally, display the icon itself -->
            <!--<i class="<?php echo $icon; ?>"></i>-->
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