<?php
session_start();

require "../include/connection.php";

if (isset($_POST['enter'])) {
    $email = $_POST['login-email'];
    $password = $_POST['login-password'];

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

        if ($user_type == 1) {
            header("Location: ../admin/admin-dashboard.php");
            exit();
        } elseif ($user_type == 0) {
            header("Location: ../index.html");
            exit();
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
                    header("Location: ../doctor/doctorDashboard.php");
                    exit();
                } else {
                    header("Location: apply.php");
                    exit();
                }
            } else {
                header("Location: apply.php");
                exit();
            }

            mysqli_stmt_close($stmt_doctor);
        }
    } else {
        echo "Invalid username or password";
    }

    mysqli_stmt_close($stmt);
} else {
    header("Location: login.php");
    exit();
}
?>
