<?php
// Get email from POST request
$email = $_POST["email"];


$token = bin2hex(random_bytes(16));
$token_hash = hash("md5", $token);


$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$con = require "../../include/connection.php";

if (!$con) {
    die("Connection failed: " . $con->connect_error);
}
$sql = "UPDATE users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $con->error);
}


$stmt->bind_param("sss", $token_hash, $expiry, $email);
if ($stmt->execute()) {
    echo "Password reset token and expiry time updated successfully.";
} else {
    echo "Execute failed: " . $stmt->error;
}


if($con->affected_rows){

    $mail = require "sendEmail.php";
 
    $mail->setFrom('MedicalBookingSystem@gmail.com');
    $mail->addAddress($email);
    
    $mail->Subject = 'Password Reset ';
    $mail->Body    = <<<END

    Click <a href="http://localhost/ESAproject/Medical-center-booking-system/login/Reset-Password/ResetPassword.php?token=$token">Here </a> To Reset Your Password.
    
    END;

    try{
        $mail->send();
    }
    catch(Exception $e){
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

    }  
}

 echo
    "
    <script>
    alert('Sent Successfully');
    document.location.href = '../login.php';
    </script>
    "; 

$stmt->close();
$con->close();
?>

