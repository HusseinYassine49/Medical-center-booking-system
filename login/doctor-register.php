<?php
require "../include/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['doctor-reg'])) {

    $errors = [];

    // Validate and sanitize form inputs
    $fname = filter_var($_POST['doctor-Fname'], FILTER_SANITIZE_STRING);
    $lname = filter_var($_POST['doctor-Lname'], FILTER_SANITIZE_STRING);
    $gender = $_POST['doctor-gender'];
    $dob = $_POST['doctor-dob'];
    $email = filter_var($_POST['doctor-email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['doctor-password'];
    $confirm_password = $_POST['doctor-confirm-password'];


    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    } elseif (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must contain at least one letter and one number.";
    }

    if (empty($confirm_password)) {
        $errors[] = "Confirm password is required.";
    } elseif ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        $hashed_password = md5($password);

        $sql = "INSERT INTO users (Fname, Lname, Email, Password, DOB, Gender, Role) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $role = 2; 
        $stmt->bind_param("ssssssi", $fname, $lname, $email, $hashed_password, $dob, $gender, $role);

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;

            session_start();
            $_SESSION['user_id'] = $user_id;

            echo "<script>alert('Registration successful'); window.location.href='apply.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "')</script>";
        }

        $stmt->close();
    } else {
        foreach ($errors as $error) {
            echo "<script>alert('$error')</script>";
        }
    }

    $con->close();
}
?>
