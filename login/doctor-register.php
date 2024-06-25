<?php
require "../include/connection.php";

// Start session
session_start();

// Retrieve JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input)) {
    $fname = $input['fname'];
    $lname = $input['lname'];
    $date = $input['dob'];
    $gender = $input['gender'];

    $errors = [];

    if (empty($input['email'])) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } else {
        $email = $input['email'];
    }

    if (empty($input['password'])) {
        $errors[] = "Password is required.";
    } elseif (strlen($input['password']) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    } elseif (!preg_match('/[A-Za-z]/', $input['password']) || !preg_match('/[0-9]/', $input['password'])) {
        $errors[] = "Password must contain at least one letter and one number.";
    } else {
        $password = $input['password'];
    }

    if (empty($input['confirm-password'])) {
        $errors[] = "Confirm password is required.";
    } elseif ($input['password'] !== $input['confirm-password']) {
        $errors[] = "Passwords do not match.";
    }

    if (!$input['accept']) {
        $errors[] = "You must accept the terms and conditions.";
    }

    if (empty($errors)) {
        $hashed_password = md5($password);
        $role = 2;

        $sql = "INSERT INTO users (Fname, Lname, Email, Password, DOB, Gender, Role) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ssssssi", $fname, $lname, $email, $hashed_password, $date, $gender, $role);
            if ($stmt->execute()) {
                $userID = $stmt->insert_id; // Get the newly inserted userID
                $_SESSION['user_id'] = $userID; // Store UserID in session
                $response = ['success' => 'Data inserted successfully', 'userID' => $userID]; // Include userID in response
            } else {
                $response = ['error' => 'Error executing SQL statement: ' . $stmt->error];
            }
            $stmt->close();
        } else {
            $response = ['error' => 'Error preparing SQL statement: ' . $con->error];
        }
    } else {
        $response = ['error' => implode(', ', $errors)];
    }

    echo json_encode($response);
} else {
    $response = ['error' => 'No data received.'];
    echo json_encode($response);
}

$con->close();
?>
