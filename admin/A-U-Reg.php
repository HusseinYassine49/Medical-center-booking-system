<?php
require "../include/connection.php";

if(isset($_POST['insert'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $date = $_POST['dob'];
    $gender = $_POST['gender'];
    $city = $_POST['address'];


    $hashed_password = md5($password);
    $role = 0;

    if ($password !== $confirm_password) {
        die("Passwords must match");
    }

    $sql = "INSERT INTO users (Fname, Lname, Email, Password, DOB, Gender, Role) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssssi", $fname, $lname, $email, $hashed_password, $date, $gender, $role);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Data inserted successfully'); window.location.href='admin-user-edit.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "')</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$con->close();
?>
