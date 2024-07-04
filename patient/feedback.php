<?php

require "navbar/navbar.php";


$userID = isset($_GET['userID']) ? $_GET['userID'] : null;

require_once "../include/connection.php";

// Fetch departments
$departmentsQuery = "SELECT Id, Department_name FROM department";
$departmentsResult = $con->query($departmentsQuery);

// Fetch doctors with user details
$doctorsQuery = "
    SELECT doctors.DoctorID, users.Fname, users.Lname, department.Department_name 
    FROM doctors 
    INNER JOIN users ON doctors.UserID = users.id
    INNER JOIN department ON doctors.DepartmentID = department.Id
    WHERE doctors.verified='verified'";
$doctorsResult = $con->query($doctorsQuery);
?>

<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css'>
    <link rel='stylesheet' href='css/feedback.css'>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.4/datatables.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert -->

    <title>Feedback Form</title>
</head>

<style>
    .col {
        margin-left: 6%;
        margin-right: auto;
    }
</style>

<body>
    <div class="main-page">
        <div class="sphere top-sphere"></div>
        <div class="sphere mid-sphere-left"></div>

        <div class="col col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="container">
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Feedback Form</h5>
                        <form id="feedbackForm" method="post">
                            <input type="hidden" id="userID" name="userID" value="<?= $userID ?>">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="clinic">Select Clinic</label>
                                    <select class="form-control" id="clinic" name="clinic" required onchange="updateDoctors()">
                                        <option value="" disabled selected>Select Clinic</option>
                                        <?php while ($row = $departmentsResult->fetch_assoc()) : ?>
                                            <option value=" <?= $row['Id'] ?>"><?= $row['Department_name'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="doctor">Select Doctor</label>
                                    <select class="form-control" id="doctor" name="doctor" required onchange="fetchDoctorAvailability()">
                                        <option value="" disabled selected>Select Doctor</option>
                                        <?php while ($row = $doctorsResult->fetch_assoc()) : ?>
                                            <option value=" <?= $row['DoctorID'] ?>"><?= $row['Fname'] ?>
                                                <?= $row['Lname'] ?> (<?= $row['Department_name'] ?>)</option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="comment">Comment</label>
                                    <input type="text" class="form-control" id="comment" name="comment" placeholder="Enter your comment">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="rating">Ratings</label>
                                    <div class="container">
                                        <div class="feedback">
                                            <?php include "rating.php"; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="card-body" id="tableaufeddback">
                    <h2>Feedback</h2>

                    <div class="album  bg-light">
                        <div class="container">
                            <div class="table-responsive">
                                <table id="feedbackTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Doctor</th>
                                            <th scope="col">Rating</th>
                                            <th scope="col">Comment</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM feedback WHERE status = '1' ORDER BY UserID = $userID DESC";
                                        $result = mysqli_query($con, $query);

                                        if ($result && mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $querydr = "SELECT `Fname`, `Lname` FROM `users` WHERE `id`=" . $row['drID'];
                                                $resultdr = mysqli_query($con, $querydr);
                                                $rowdr = mysqli_fetch_assoc($resultdr);
                                                echo '<tr>';
                                                echo '<td>' . $rowdr['Fname'] . ' ' . $rowdr['Lname'] . '</td>';
                                                echo '<td>' . $row['rating'] . '</td>';
                                                echo '<td>' . $row['comment'] . '</td>';
                                                echo '<td>';
                                                if ($row['UserID'] == $userID) {
                                                    echo '<a href="edit_feedback.php?userID=' . $userID . '&id=' . $row['id'] . '" class="btn btn-primary">Edit</a>';
                                                    echo '<button type="button" class="btn btn-danger ml-2" onclick="deletec(' . $row['id'] . ')">Delete</button>';
                                                }
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="4">No feedback found.</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery and DataTables JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
        <script src="js/makeappointment.js"></script>
        <script src="js/sendAJAX.js"></script>
        <script>
            $(document).ready(function() {
                var table;
                try {
                    table = $('#feedbackTable').DataTable();
                } catch (error) {
                    console.error('Error initializing DataTables:', error);
                }
            });
            $(document).ready(function() {
                var table = $('#feedbackTable').DataTable();

                $('#feedbackForm').submit(function(event) {
                    event.preventDefault();

                    var formData = {
                        clinic: $('#clinic').val(),
                        doctor: $('#doctor').val(),
                        comment: $('#comment').val(),
                        rating: $('input[name=rating]:checked').val(),
                        userID: $('#userID').val()
                    };

                    $.ajax({
                        type: 'POST',
                        url: 'insert_feedback.php',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            if (response = 'success') {
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    table.ajax.reload(null, false);
                                    $('#feedbackForm')[0].reset();
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
                                text: 'Failed to add feedback. Please try again.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            console.error(xhr.responseText);
                        }
                    });
                });

                window.deletec = function(feedbackId) {

                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to delete this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: 'delete_feedback.php',
                                type: 'POST',
                                data: {
                                    id: feedbackId
                                },
                                success: function(response) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Your feedback has been deleted.",
                                        icon: "success"
                                    });
                                    table.ajax.reload(null, false);
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    // alert(errorThrown);
                                }
                            });
                        }
                    });
                };
            });
        </script>
    </div>
</body>

</html>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>