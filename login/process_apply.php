<?php
session_start();

require "../include/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $department_id = $_POST['department'];
    $description = $_POST['description'];
    
    // Handle file upload
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] == UPLOAD_ERR_OK) {
        $cv = file_get_contents($_FILES['cv']['tmp_name']);
    } else {
        die("Error uploading file");
    }

    $query = "INSERT INTO doctors (UserID, verified, DepartmentID, CV, Description) VALUES (?, 'notVerified', ?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "iiss", $user_id, $department_id, $cv, $description);

    if (mysqli_stmt_execute($stmt)) {
        echo "Application submitted successfully.";
        // Optionally redirect or notify the user
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
    $con->close();

    // Terminate session and redirect to home
    session_destroy();
    header("Location: ../index.html");
    exit();
} else {
    echo "Invalid request method.";
}
?>
