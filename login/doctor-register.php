<?php
require "../include/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['doctor-reg'])) {
    $errors = [];

    $fname = $_POST['doctor-Fname'];
    $lname = $_POST['doctor-Lname'];
    $gender = $_POST['doctor-gender'];
    $date = $_POST['doctor-dob'];


    if (empty($_POST['doctor-email'])) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($_POST['doctor-email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } else {
        $email = $_POST['doctor-email'];
    }

    if (empty($_POST['doctor-password'])) {
        $errors[] = "Password is required.";
    } elseif (strlen($_POST['doctor-password']) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    } elseif (!preg_match('/[A-Za-z]/', $_POST['doctor-password']) || !preg_match('/[0-9]/', $_POST['doctor-password'])) {
        $errors[] = "Password must contain at least one letter and one number.";
    } else {
        $password = $_POST['doctor-password'];
    }

    if (empty($_POST['doctor-confirm-password'])) {
        $errors[] = "Confirm password is required.";
    } elseif ($_POST['doctor-password'] !== $_POST['doctor-confirm-password']) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        $hashed_password = md5($password);
        $role = 2;

        $sql = "INSERT INTO users (Fname, Lname, Email, Password, DOB, Gender, Role) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssssi", $fname, $lname, $email, $hashed_password, $date, $gender, $role);

        if ($stmt->execute()) {
            echo "<script>alert('Data inserted successfully'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "')</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo "<script>alert('$error')</script>";
        }
    }
}

// Close the connection
$con->close();
?>
