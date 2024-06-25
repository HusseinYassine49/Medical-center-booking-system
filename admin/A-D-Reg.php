<?php
require "../include/connection.php";

// Check if JSON data is received
$input = json_decode(file_get_contents('php://input'), true);

if(isset($input)){
    $fname = $input['fname'];
    $lname = $input['lname'];
    $email = $input['email'];
    $password = $input['password'];
    $confirm_password = $input['confirm-password'];
    $date = $input['dob'];
    $gender = $input['gender'];

    // Perform form validation
    $errors = [];
    if(empty($fname)){
        $errors[] = "First name is required.";
    }
    if(empty($lname)){
        $errors[] = "Last name is required.";
    }
    if(empty($email)){
        $errors[] = "Email is required.";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Invalid email format.";
    }
    if(empty($password)){
        $errors[] = "Password is required.";
    }
    if(empty($confirm_password)){
        $errors[] = "Confirm password is required.";
    }
    if($password !== $confirm_password){
        $errors[] = "Passwords do not match.";
    }
    if(empty($date)){
        $errors[] = "Date of birth is required.";
    }
    if(empty($gender)){
        $errors[] = "Gender is required.";
    }

    // Check for errors
    if(!empty($errors)){
        $response = [
            'success' => false,
            'message' => implode("<br>", $errors)
        ];
        echo json_encode($response);
        exit;
    }

    $hashed_password = md5($password);
    $role = 2;

    $sql = "INSERT INTO users (Fname, Lname, Email, Password, DOB, Gender, Role) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssssi", $fname, $lname, $email, $hashed_password, $date, $gender, $role);

    // Execute the statement
    if ($stmt->execute()) {
        $response = [
            'success' => true,
            'message' => 'Data inserted successfully'
        ];
        echo json_encode($response);
    } else {
        $response = [
            'success' => false,
            'message' => 'Error: ' . $stmt->error
        ];
        echo json_encode($response);
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$con->close();
?>
