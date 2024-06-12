<?php
require "../include/connection.php";

if(isset($_POST['login'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $date = $_POST['dob'];
    $gender = $_POST['gender'];

    if (empty($_POST['email'])) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } else {
        $email = $_POST['email'];
    }

    if (empty($_POST['password'])) {
        $errors[] = "Password is required.";
    } elseif (strlen($_POST['password']) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    } elseif (!preg_match('/[A-Za-z]/', $_POST['password']) || !preg_match('/[0-9]/', $_POST['password'])) {
        $errors[] = "Password must contain at least one letter and one number.";
    } else {
        $password = $_POST['password'];
    }

    if (empty($_POST['confirm-password'])) {
        $errors[] = "Confirm password is required.";
    } elseif ($_POST['password'] !== $_POST['confirm-password']) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
    $hashed_password = md5($password);
    $role = 0;

    $sql = "INSERT INTO users (Fname, Lname, Email, Password, DOB, Gender, Role) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssssi", $fname, $lname, $email, $hashed_password, $date, $gender, $role);

    if ($stmt->execute()) {
        echo "<script>alert('Data inserted successfully'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "')</script>";
    }


    $stmt->close();
} else {
    foreach ($errors as $error) {
        echo "<script>alert('$error')</script>";
    }
}
}

$con->close();
?>
