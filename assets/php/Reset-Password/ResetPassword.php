<?php

$token = $_GET["token"];

$token_hash = hash("md5",$token);

$con  = require "../connection.php";

$sql = "SELECT * FROM users WHERE reset_token_hash = ?";

$stmt = $con->prepare($sql);

$stmt->bind_param("s",$token_hash);

$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if($user === null){
    die("token not found");
}

if(strtotime($user["reset_token_expires_at"]) <= time()){
    die("token has expired");
}

echo
    "
    <script>
    alert('Token is Valid and havent Expired');
    </script>
    "; 

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../../css/ResetPassword.css" rel="stylesheet">
    <script src="../../js/eye.js" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
</head>

<body>

<h1>RESET PASSWORD</h1>

<form action="ResetVerification.php" method="post" id="login-form" >

<input type="hidden" name="token" value="<?=htmlspecialchars($token)?>">

    <div class="ResetContainer">

        <label for="login-password">Password</label>
        <div class="input-container">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="password" id="password" name="password" placeholder="............">
            <ion-icon class="eye" name="eye-off-outline"></ion-icon>
        </div>

        <label for="reset-password">Confirm Password</label>
        <div class="input-container">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="password" id="password-confirmation" name="password-confirmation" placeholder="............">
            <ion-icon class="eye" name="eye-off-outline"></ion-icon>
        </div>

        <button type="submit">Change Password</button>
    </div>
</form>


</body>

</html>


