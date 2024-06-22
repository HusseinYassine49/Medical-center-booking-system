<?php 
require "../include/connection.php";

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
    
</head>
<body>
    
<?php include 'navbar/navbar.php';?>

<div class="main-page" id="main-page">

<div class="top-sphere"></div>
<div class="bottom-sphere"></div>

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
    <form action="depart-Reg.php" method="post">

        <div class="input-row">
          <div class="input-group">
            <label>Department Name</label>
            <input type="text" name="name" />
          </div>

          <div class="input-group">
            <label>Department Description</label>
            <input type="text" name="description" />
          </div>
        </div>

        <div class="input-row">

          <div class="input-group">
            <label></label>
            <input type="submit" name="insert" />
          </div>
        </div>

    </form>
    </div>


   
      


    <div class="container">
            <div class="table-content">
    
                
                <div class="top-circle" >
                 
    
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


</body>
</html>

<script src="js/addbtn.js"></script>
<script src="js/deletebtn.js"></script>