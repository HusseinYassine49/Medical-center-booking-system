<?php
session_start();

require "../include/connection.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
    header("Location: ../login/login.php");
    exit();
}

$sql = "SELECT * FROM department";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/department.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link href="css/table.css?v=<?php echo time(); ?>" rel="stylesheet">
    <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
</head>
<body>
    
<?php include 'navbar/navbar.php';?>

<div class="main-page" id="main-page">

<div class="sphere top-sphere"></div>
<div class="sphere bottom-sphere"></div>

<div class="bread-container">
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="../index.html" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>     
        </li>
        <li class="breadcrumbs-item">
          <a href="admin-dashboard.php" class="breadcrumbs-link">Dashboard</a> 
        </li>
        <li class="breadcrumbs-item">
          <a href="#" class="breadcrumbs-link active">Department</a>
        </li>
    
      </ul>
    </div>

    <div class="add-department" id="add-department">
            <h1>ADD Department</h1>

    <!--THE FORM TO SEND THE DATA TO BE VERIFIED TO BE INSERTED TO THE DATABASE -->
    <form id="departmentForm">
        <div class="input-row">
            <div class="input-group">
                <label>Department Name</label>
                <input type="text" id="department-name" name="name" required />
            </div>

            <div class="input-group">
                <label>Department Description</label>
                <input type="text" id="department-description" name="description" required />
            </div>
        </div>

        <div class="input-row">
            <div class="input-group">
                <label></label>
                <input type="submit" value="Insert" onclick="departmentInsertion(event)" />
            </div>
        </div>
    </form>
    </div>


   
      


    <div class="container">
            <div class="table-content">
                <h2>Department Table</h2>
    
                <table class="tbl" id="filter">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Department</th>
                            <th>Description</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td data-label='Doctor ID' class='user-id'>" . $row["Id"] . "</td>";
                    echo "<td data-label='Doctor Name'>" . $row["Department_name"] . "</td>";
                    echo "<td data-label='Doctor Name'>" . $row["Description"] . "</td>";
                    echo "<td data-label='Edit'><a href='edit-depart.php?id=" . $row["Id"] . "&name=" . $row["Department_name"]. "&desc=" . $row["Description"] ." ' class='btn-edit'><i class='fa-solid fa-pencil'></i></a></td>";
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

<script src="js/addbtn.js"></script>
<script src="js/deletebtn.js"></script>
<script src="js/department-AJAX.js"></script>

</body>
</html>
