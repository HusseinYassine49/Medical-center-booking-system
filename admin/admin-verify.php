<?php 
require "../include/connection.php";

$sql = "SELECT d.DoctorID, u.Fname, d.Description, d.verified, d.CV, d.DepartmentID, dp.Department_name
        FROM doctors d 
        JOIN users u ON d.UserID = u.id 
        JOIN department dp ON d.DepartmentID = dp.Id
        WHERE d.verified = 'notVerified'";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Verification</title>
    <link href="css/table.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link href="css/verify.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>
<body>
<?php include 'navbar/navbar.php'; ?>

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
            <a href="#" class="breadcrumbs-link active">Verification</a>
        </li>
    </ul>
</div>

<div class="container">
        <h2>Doctor Certificates</h2>
        <div class="cards-content">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='card'>";
                    echo "<p><strong>Doctor ID:</strong> " . $row["DoctorID"] . "</p>";
                    echo "<p><strong>Doctor Name:</strong> " . $row["Fname"] . "</p>"; 
                    echo "<p><strong>Department:</strong> " . $row["Department_name"] . "</p>";
                    echo "<p class='description'><strong>Description:</strong> " . $row["Description"] . "</p>";
                    echo "<a href='download_cv.php?id=" . $row["DoctorID"] . "' class='btn-download'>Download CV</a>";
                    echo "<button class='btn-accept' data-doctorid='" . $row["DoctorID"] . "' data-userid='" . $row["Fname"] . "'>Accept</button>";
                    echo "</div>";
                }
            } else {
                echo "<p>No unverified doctors found</p>";
            }
            $con->close();                
            ?>
        </div>
    </div>

    <div class="space-down"></div>

    </div>

    <script src="js/verify.js"></script>

</body>
</html>
