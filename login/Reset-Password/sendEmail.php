
<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '../../phpmailer/src/Exception.php';
    require '../../phpmailer/src/PHPMailer.php';
    require '../../phpmailer/src/SMTP.php';

    if(isset($_POST["send"])){
        $mail = new PHPMailer(true);

        $mail ->isSMTP();
        $mail->Host ='smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'MedicalBookingSystem@gmail.com';
        $mail->Password = 'dpmsnrnqxmbhxfow';
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPDebug = 2; // Enable verbose debug output

        $mail->Port = 465;
        $mail->isHTML(true);

        return $mail;

    }
    ?>