<?php
require "../include/connection.php";
$patient_id = $_GET['id'];

$response = array();

if (!empty($patient_id)) {
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $patient = $result->fetch_assoc();
        $response['name'] = $patient['Fname'] . ' ' . $patient['Lname'];
        $response['email'] = $patient['Email'];
        $response['gender'] = $patient['Gender'];
        $response['birthday'] = $patient['DOB'];
        $response['blood_group'] = $patient['BloodType'];
       // Fetch last appointment date
       $stmt = $con->prepare("SELECT MAX(date_) AS max_appointment_date FROM appointment WHERE userID = ? AND date_ < NOW()");
       $stmt->bind_param("i", $patient_id);
       $stmt->execute();
       $result = $stmt->get_result();
       $max_appointment_date = $result->fetch_assoc();
      

       $response['last_appointment_date'] = $max_appointment_date['max_appointment_date'];

        // Fetch past and upcoming appointments
        $sql = "SELECT COUNT(*) AS count FROM appointment WHERE userID = ? AND date_ < NOW()";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $patient_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $past_appointments = $result->fetch_assoc();
        $response['past_appointments'] = $past_appointments['count'];

        $sql = "SELECT COUNT(*) AS count FROM appointment WHERE userID = ? AND date_ >= NOW()";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $patient_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $upcoming_appointments = $result->fetch_assoc();
        $response['upcoming_appointments'] = $upcoming_appointments['count'];

        // Fetch appointment history
        $sql = "SELECT date_, time_, dr_notes FROM appointment WHERE userID = ? AND date_ < NOW() ORDER BY date_ DESC";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $patient_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $appointment_history = array();

        while ($row = $result->fetch_assoc()) {
            $appointment_history[] = $row;
        }

        $response['appointment_history'] = $appointment_history;
    } else {
        $response['error'] = "Patient not found";
    }

    $stmt->close();
} else {
    $response['error'] = "Invalid patient ID";
}

$con->close();

header('Content-Type: application/json');
echo json_encode($response);
?>