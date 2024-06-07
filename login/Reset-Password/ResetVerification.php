<?php

$token = $_POST["token"];

$token_hash = hash("md5", $token);

$con  = require "../../include/connection.php";

$sql = "SELECT * FROM users WHERE reset_token_hash = ?";

$stmt = $con->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    die("Token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Token has expired");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}
if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least 1 letter");
}
if (!preg_match("/[0-9]/i", $_POST["password"])) {
    die("Password must contain at least 1 number");
}

if ($_POST["password"] !== $_POST["password-confirmation"]) {
    die("Passwords must match");
}

$password_hash = hash("md5", $_POST["password"]);

// Remove the extra comma in the SQL query
$sql = "UPDATE users SET Password = ?, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE id = ?";

$stmt = $con->prepare($sql);

$stmt->bind_param("ss", $password_hash, $user["id"]);

$stmt->execute();

echo "<script>
alert('Password Changed Successfully');
document.location.href = '../login.php';
</script>"; 
?>
