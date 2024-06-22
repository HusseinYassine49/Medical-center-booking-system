<?php
require "../include/connection.php";

if (isset($_GET['id'])) {
    $doctorId = $_GET['id'];

    // Fetch the CV data and the doctor's first name
    $sql = "
        SELECT d.CV, u.Fname 
        FROM doctors d 
        JOIN users u ON d.UserID = u.id 
        WHERE d.DoctorID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $doctorId);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($cvData, $doctorName);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && !empty($cvData)) {
        header('Content-Type: application/pdf'); // Assuming the CV is a PDF
        header('Content-Disposition: attachment; filename="CV_' . $doctorName . '.pdf"');
        echo $cvData;
    } else {
        echo "CV not found.";
    }

    $stmt->close();
}
?>
