<?php
require "connection.php";

if(isset($_POST['login'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $date = $_POST['dob'];
    $gender = $_POST['gender'];

    // Hash the password
    $hashed_password = md5($password);
    $role = 0;

    // Prepare and bind the statement
    $sql = "INSERT INTO users (Fname, Lname, Email, Password, DOB, Gender, Role) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssssi", $fname, $lname, $email, $hashed_password, $date, $gender, $role);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Data inserted successfully')</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "')</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$con->close();
?>
