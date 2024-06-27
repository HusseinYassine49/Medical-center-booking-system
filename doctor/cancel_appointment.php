<?php
require "../include/connection.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $data = json_decode(file_get_contents('php://input'), true);

    
    if (isset($data['appointment_id'])) {
        $appointmentId = $data['appointment_id'];

        // Fetch appointment details
        $stmt = $con->prepare("SELECT a.date_, a.time, u.Email, u.Fname AS patient_name FROM appointment a JOIN users u ON a.userID = u.id
                               WHERE a.id = ?");
        $stmt->bind_param("i", $appointmentId);
        $stmt->execute();
        $result = $stmt->get_result();
        $appointmentDetails = $result->fetch_assoc();
        if ($appointmentDetails) {
        $query = "UPDATE appointment SET delete_ = 1 WHERE id = ?";
        
       
        $stmt = mysqli_prepare($con, $query);
        
       
        mysqli_stmt_bind_param($stmt, "i", $appointmentId);
        
       
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
          
            $response = array('success' => true);
            // Send email to the patient
            require '../phpmailer/src/Exception.php';
            require '../phpmailer/src/PHPMailer.php';
            require '../phpmailer/src/SMTP.php';

            $mail = new PHPMailer\PHPMailer\PHPMailer();

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host ='smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'MedicalBookingSystem@gmail.com';
                $mail->Password = 'dpmsnrnqxmbhxfow';
                $mail->SMTPSecure = 'ssl';
                $mail->SMTPDebug = 2;

                $mail->Port = 465;
                //Recipients
                $mail->setFrom('MedicalBookingSystem@gmail.com', 'Clinic Click');
                $mail->addAddress($appointmentDetails['Email'], $appointmentDetails['patient_name']);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Appointment Canceled';
                $mail->Body    = "Dear " . $appointmentDetails['patient_name'] . ",<br><br>" .
                                         "We regret to inform you that your appointment with Dr.  on " . $appointmentDetails['date_'] . " at " . $appointmentDetails['time'] . " has been canceled.<br><br>" .
                                         "Please contact us to reschedule.<br><br>" .
                                         "Best regards,<br>Clinic Click";
                $mail->send();
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo]);
            }
            echo json_encode($response);
        } else {
          
            $response = array('success' => false, 'error' => mysqli_error($con));
            echo json_encode($response);
        }

    }  
        mysqli_stmt_close($stmt);
    } else {
       
        $response = array('success' => false, 'error' => 'Appointment ID not provided');
        echo json_encode($response);
    }
} else {
    
    $response = array('success' => false, 'error' => 'Invalid request method');
    echo json_encode($response);
}


mysqli_close($con);
?>
