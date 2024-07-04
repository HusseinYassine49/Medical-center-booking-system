<?php
session_start();
require "../include/connection.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
    header("Location: ../login/login.php");
    exit();
}

$sql = "SELECT d.UserID,d.DoctorID, u.Fname, d.Description, d.verified, d.CV, d.DepartmentID, dp.Department_name
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
                    <a href="../home.php" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>
                </li>
                <li class="breadcrumbs-item">
                    <a href="admin-dashboard.php" class="breadcrumbs-link">Dashboard</a>
                </li>
                <li class="breadcrumbs-item">
                    <a href="#" class="breadcrumbs-link active">Verification</a>
                </li>
            </ul>
            <div class="left">
        <button onclick="history.back()" class="goBack">Go Back</button>
      </div>
        </div>

        <div class="container">
            <h2>Doctor Certificates</h2>
            <div class="cards-content">
            <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<iframe id="pdf-viewer-' . $row["DoctorID"] . '" src="../' . $row["CV"] . '" frameborder="0" style="display: none; width: 100%; height: 800px;"></iframe>';
                        echo "<div class='card'>";
                        echo "<p><strong>Doctor ID:</strong> " . $row["DoctorID"] . "</p>";
                        echo "<p><strong>Doctor Name:</strong> " . $row["Fname"] . "</p>";
                        echo "<p><strong>Department:</strong> " . $row["Department_name"] . "</p>";
                        echo "<p class='description'><strong>Description:</strong> " . $row["Description"] . "</p>";

                        if (!empty($row["CV"])) {
                            echo '<a href="javascript:void(0);" id="btn-download-' . $row["DoctorID"] . '" class="btn-download">See CV</a>';
                        } else {
                            echo "<p>PDF not available</p>";
                        }

                        echo "<button class='btn-accept' data-doctorid='" . $row["DoctorID"] . "' data-userid='" . $row["Fname"] . "'>Accept</button>";
                        echo "<button class='btn-decline' data-doctorid='" . $row["DoctorID"] . "' data-userid='" . $row["Fname"] . "'>Decline</button>";
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
    <script src="js/decline.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var downloadButtons = document.querySelectorAll('.btn-download');
            downloadButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var doctorID = this.id.replace('btn-download-', '');
                    var iframe = document.getElementById('pdf-viewer-' + doctorID);
                    if (iframe.style.display === 'none') {
                        iframe.style.display = 'block';
                    } else {
                        iframe.style.display = 'none';
                    }
                });
            });
        });
    </script>

</body>

</html>