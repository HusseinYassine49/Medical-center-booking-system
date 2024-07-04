<?php
// get_doctors.php
require "../include/connection.php";

if (isset($_POST['department_id'])) {
    $departmentId = $_POST['department_id'];
    $query = "
        SELECT doctors.DoctorID, users.Fname, users.Lname 
        FROM doctors 
        INNER JOIN users ON doctors.UserID = users.id
        WHERE doctors.DepartmentID = ? AND doctors.verified = 'verified'";

    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $departmentId);
    $stmt->execute();
    $result = $stmt->get_result();

    $doctors = [];
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }

    echo json_encode($doctors);
}
