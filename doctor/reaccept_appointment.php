<?php
require "../include/connection.php";
session_start();
$dr = $_SESSION['user_info']['Fname'];
$drLname = $_SESSION['user_info']['Lname'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id'])) {
        $appointmentId = $data['id'];


        $stmt = $con->prepare("SELECT a.date_, a.time, u.Email, u.Fname AS patient_name FROM appointment a JOIN users u ON a.userID = u.id WHERE a.id = ?");

        $stmt->bind_param("i", $appointmentId);
        $stmt->execute();
        $result = $stmt->get_result();
        $appointmentDetails = $result->fetch_assoc();

        if ($appointmentDetails) {
            // Send email to the patient
            require '../phpmailer/src/Exception.php';
            require '../phpmailer/src/PHPMailer.php';
            require '../phpmailer/src/SMTP.php';

            $mail = new PHPMailer\PHPMailer\PHPMailer();

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'MedicalBookingSystem@gmail.com';
                $mail->Password = 'dpmsnrnqxmbhxfow';
                $mail->SMTPSecure = 'ssl';
                $mail->SMTPDebug = 2;
                $mail->Port = 465;

                // Recipients
                $mail->setFrom('MedicalBookingSystem@gmail.com', 'Clinic Click');
                $mail->addAddress($appointmentDetails['Email'], $appointmentDetails['patient_name']);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Appointment Approved';
                $mail->Body = "Dear " . $appointmentDetails['patient_name'] . ",<br><br>" .
                    "We are pleased to inform you that your previously canceled appointment with Dr. " . $dr . " " . $drLname . " on " . $appointmentDetails['date_'] . " at " . $appointmentDetails['time_'] . " has been rescheduled.<br>" .
                    "If this new appointment time is convenient for you, there is no need to take further action. However, if you need to reschedule, please contact us or respond to this email, and we will be happy to assist you.<br>" .
                    "Best regards,<br>Clinic Click";

                $mail->send();

                // Delete the appointment from the database
                $deleteStmt = $con->prepare("DELETE FROM appointment WHERE id = ?");
                $deleteStmt->bind_param("i", $appointmentId);
                $deleteStmt->execute();
                $deleteStmt->close();

                echo json_encode(['success' => true, 'message' => 'Email sent and appointment deleted']);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Appointment not found']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request data']);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}

mysqli_close($con);
?>
