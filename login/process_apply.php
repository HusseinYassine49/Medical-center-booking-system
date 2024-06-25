<?php
session_start();

require "../include/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $department_id = $_POST['department'];
    $description = $_POST['description'];

    // Start transaction
    mysqli_begin_transaction($con, MYSQLI_TRANS_START_READ_WRITE);

    try {
        // Insert initial doctor details to get the generated ID
        $initial_query = "INSERT INTO doctors (UserID, verified, DepartmentID, CV, Description) VALUES (?, 'notVerified', ?, '', ?)";
        $initial_stmt = mysqli_prepare($con, $initial_query);
        mysqli_stmt_bind_param($initial_stmt, "iis", $user_id, $department_id, $description);

        if (!mysqli_stmt_execute($initial_stmt)) {
            throw new Exception("Error: " . mysqli_error($con));
        }

        $doctor_id = mysqli_insert_id($con);
        mysqli_stmt_close($initial_stmt);

        // Handle file upload
        if (isset($_FILES['cv']) && $_FILES['cv']['error'] == UPLOAD_ERR_OK) {
            $upload_dir = "../assets/CV/";
            
            // Create the directory if it doesn't exist
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            // Rename the file to doctor ID
            $cv_filename = $doctor_id . ".pdf";
            $cv_filepath = $upload_dir . $cv_filename;

            // Move the uploaded file to the target directory
            if (!move_uploaded_file($_FILES['cv']['tmp_name'], $cv_filepath)) {
                throw new Exception("Error moving uploaded file");
            }

            // Save only the relative path to the database
            $cv_relative_path = "assets/CV/" . $cv_filename;
        } else {
            throw new Exception("Error uploading file");
        }

        // Update the doctor record with the CV file path
        $update_query = "UPDATE doctors SET CV = ? WHERE DoctorID = ?";
        $update_stmt = mysqli_prepare($con, $update_query);
        mysqli_stmt_bind_param($update_stmt, "si", $cv_relative_path, $doctor_id);

        if (!mysqli_stmt_execute($update_stmt)) {
            throw new Exception("Error: " . mysqli_error($con));
        }

        mysqli_stmt_close($update_stmt);

        // Commit transaction
        mysqli_commit($con);

        echo "Application submitted successfully.";

    } catch (Exception $e) {
        // Roll back transaction if any error occurs
        mysqli_rollback($con);
        echo $e->getMessage();
    }

    $con->close();

    // Terminate session and redirect to home
    session_destroy();
    header("Location: ../index.html");
    exit();
} else {
    echo "Invalid request method.";
}
?>
