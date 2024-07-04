<?php
 require '../phpmailer/src/Exception.php';
 require '../phpmailer/src/PHPMailer.php';
 require '../phpmailer/src/SMTP.php';

function sendConfirmationEmail($email, $name, $appointmentDate) {
   
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host ='smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'MedicalBookingSystem@gmail.com';
        $mail->Password = 'dpmsnrnqxmbhxfow';
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPDebug = 2;

        $mail->Port = 465;
        // Recipients
        $mail->setFrom('MedicalBookingSystem@gmail.com', 'Clinic Click');
        $mail->addAddress($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Appointment Confirmation';
        $mail->Body = "Dear $name,<br><br>This is a reminder that you have an appointment scheduled for $appointmentDate.<br><br>Thank you,<br>Clinic Name";

        $mail->send();
        echo "Confirmation email has been sent to $email\n";
    } catch (Exception $e) {
        echo "Message could not be sent to $email. Mailer Error: {$mail->ErrorInfo}\n";
    }
}

require "../include/connection.php";

// Get appointments for the next day
$tomorrow = date('Y-m-d', strtotime('+1 day'));
$sql = "
    SELECT a.date_, u.Email, u.Fname, u.Lname
    FROM appointment a
    JOIN users u ON a.userID = u.id
    WHERE DATE(a.date_) = '$tomorrow'
";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $email = $row['Email'];
        $name = $row['Fname'] . ' ' . $row['Lname'];
        $appointmentDate = $row['date_'];
        sendConfirmationEmail($email, $name, $appointmentDate);
    }
} else {
    echo "No appointments for tomorrow.\n";
}

$con->close();
