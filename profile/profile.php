<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$userID = isset($_GET['userID']) ? $_GET['userID'] : null;
include "../include/connection.php";




$query = "SELECT Fname, Lname, Email, DOB, Gender, BloodType, height, weight FROM users WHERE id = $userID";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css'>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="../css/prof.css" rel="stylesheet">
    <link href="../patient/navbar/navbar.css" rel="stylesheet">
    <link href="../patient/css/appointment.css" rel="stylesheet">
</head>

<body>

<?php include '../patient/navbar/navbar.php'; ?>
<script src="../patient/navbar/include.js"> </script>
<div class="main-page">


<div class="bread-container">
            <ul class="breadcrumbs">
                <li class="breadcrumbs-item">
                    <a href="../home.php" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>
                </li>
                <li class="breadcrumbs-item">
                    <a href="doctorDashboard.php" class="breadcrumbs-link">Dashboard</a>
                </li>
                <li class="breadcrumbs-item">
                    <a href="#.php" class="breadcrumbs-link active">Profile</a>
                </li>
             </ul>  
             <div class="left">
             <button onclick="history.back()" class="goBack">Go Back</button>
            </div>
        </div>



    <div class="container">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar">
                                    <img style="width: 100%;" src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                        alt="Maxwell Admin">
                                </div>
                                <h5 class="user-name"><?php echo $row['Fname'] . ' ' . $row['Lname']; ?></h5>
                                <h6 class="user-email"><?php echo $row['Email']; ?></h6>
                            </div>
                            <div class="about">
                                <!-- About section -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <form id="updateForm">
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mb-2 text-primary">Personal Details</h6>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="fullName">Full Name</label>
                                        <input type="text" class="form-control" id="fullName" name="fullName"
                                            value="<?php echo $row['Fname'] . ' ' . $row['Lname']; ?>"
                                            placeholder="Enter full name">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="eMail">Email</label>
                                        <input type="email" class="form-control" id="eMail" name="email"
                                            value="<?php echo $row['Email']; ?>" placeholder="Enter email ID">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="dob">Date Of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob"
                                            value="<?php echo $row['DOB']; ?>" placeholder="Enter date of birth">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="bloodType">Blood Type</label>
                                        <input type="text" class="form-control" id="bloodType" name="bloodType"
                                            value="<?php echo $row['BloodType']; ?>" placeholder="Enter blood type">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="bloodType">Height</label>
                                        <input type="text" class="form-control" id="height" name="height"
                                            value="<?php echo $row['height']; ?>" placeholder="Enter height">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="bloodType">Width</label>
                                        <input type="text" class="form-control" id="weight" name="weight"
                                            value="<?php echo $row['weight']; ?>" placeholder="Enter weight">
                                    </div>
                                </div>
                            </div>

                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
                                        <button type="button" id="cancel" name="cancel"
                                            class="btn btn-secondary">Cancel</button>
                                        <button type="button" id="update" name="update"
                                            class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    <script src="../js/include.js"></script>
    <!-- Icon SCRIPT-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--SCRIPT FOR PIE CHART-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../js/chart.js"></script>

    <script>
    $(document).ready(function() {
        $('#update').on('click', function() {
            var formData = $('#updateForm').serialize();

            $.ajax({
                type: 'POST',
                url: 'edit_profile.php',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to update profile. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    console.error(xhr.responseText);
                }
            });
        });
    });
    </script>
</body>

</html>