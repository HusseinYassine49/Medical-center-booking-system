<?php
// Example: Generate a random 6-digit numeric token for 2FA
$random_2fa_token = sprintf('%06d', mt_rand(0, 999999));

// Example: Use this token as part of the reset token (you can adjust as needed)
$token = $_GET["token"];
$combined_token = $token . $random_2fa_token;

// Hash the combined token for database storage
$token_hash = hash("md5", $combined_token);

// Example database connection (adjust as per your setup)
$con = require "../../include/connection.php"; // Adjust the path as necessary

$sql = "SELECT * FROM users WHERE reset_token_hash = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    die("Token not found or invalid");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Token has expired");
}

// Continue with your existing HTML and form
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="../css/reset_password.css" rel="stylesheet">
    <!-- Include any necessary scripts or styles -->
</head>

<body>

<h1>RESET PASSWORD</h1>

<form action="reset_verification.php" method="post" id="reset-password-form">

    <!-- Hidden input field to store the combined token (for verification in reset_verification.php) -->
    <input type="hidden" name="token" value="<?= htmlspecialchars($combined_token) ?>">

    <div class="reset-container">
        <label for="password">Password</label>
        <div class="input-container">
            <input type="password" id="password" name="password" placeholder="Enter your new password">
        </div>

        <label for="password-confirm">Confirm Password</label>
        <div class="input-container">
            <input type="password" id="password-confirm" name="password-confirm" placeholder="Confirm your new password">
        </div>

        <!-- Example: Input field for the 2FA token -->
        <label for="2fa-token">2FA Token</label>
        <div class="input-container">
            <input type="text" id="2fa-token" name="2fa-token" placeholder="Enter 6-digit code">
        </div>

        <button type="submit">Change Password</button>
    </div>
</form>

</body>

</html>
