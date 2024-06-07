<?php

session_start();


require "../include/connection.php";

if (isset($_POST['enter'])) {
    $email = $_POST['login-email'];
    $password = $_POST['login-password'];

    $hashed_password = md5($password);
    echo $hashed_password;

    $query = "SELECT * FROM users WHERE Email = ? AND Password = ? LIMIT 1";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ss", $email, $hashed_password);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_type = $row['Role'];
        $stored_hashed_password = $row['Password'];

            if ($user_type == 1) {
                // Admin user
                echo "Redirecting to admin dashboard...";
                header("Location: ../admin/admin-dashboard.php");
                exit();
            } elseif ($user_type == 0) {
                // Member user
                echo "Redirecting to index page...";
                header("Location: ../index.html");
                exit();
            } else {
                // Handle other cases
                echo "Unknown user role.";
            }
       
    } else {
        echo "Invalid username or password";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

?>
