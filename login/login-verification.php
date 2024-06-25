<?php
session_start();
require "../include/connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['login-email']) && isset($_POST['login-password'])) {
        $email = $_POST['login-email'];
        $password = $_POST['login-password'];

        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $password = trim($password); 

        if ($email && !empty($password)) {
            $hashed_password = md5($password);

            $query = "SELECT * FROM users WHERE Email = ? AND Password = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "ss", $email, $hashed_password);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $user_type = $row['Role'];

                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_email'] = $row['Email'];
                $_SESSION['user_role'] = $user_type;

                $_SESSION['user_info'] = $row;

                if ($user_type == 1) {
                    echo json_encode(['success' => 'Admin login successful','userID' => $row['id']]);
                } elseif ($user_type == 0) {
                    echo json_encode(['success' => 'User login successful', 'userID' => $row['id']]);
                } elseif ($user_type == 2) {
                    $doctor_id = $row['id'];
                    $query_doctor = "SELECT verified FROM doctors WHERE UserID = ? LIMIT 1";
                    $stmt_doctor = mysqli_prepare($con, $query_doctor);
                    mysqli_stmt_bind_param($stmt_doctor, "i", $doctor_id);
                    mysqli_stmt_execute($stmt_doctor);
                    $result_doctor = mysqli_stmt_get_result($stmt_doctor);

                    if ($result_doctor && mysqli_num_rows($result_doctor) > 0) {
                        $doctor_row = mysqli_fetch_assoc($result_doctor);
                        if ($doctor_row['verified'] == 'verified') {
                            echo json_encode(['success' => 'Doctor login successful']);
                        } else {
                            echo json_encode(['success' => 'Doctor not verified']);
                        }
                    } else {
                        echo json_encode(['success' => 'Doctor havent applied yet']);
                    }

                    mysqli_stmt_close($stmt_doctor);
                }
            } else {
                echo json_encode(['error' => 'Invalid username or password']);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo json_encode(['error' => 'Invalid email or password']);
        }
    } else {
        echo json_encode(['error' => 'Email and password are required']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
