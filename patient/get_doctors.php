<?php
// get_doctors.php
<<<<<<< HEAD
require "../include/connection.php";
=======
require "../include/connection.php"; 
>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c

if (isset($_POST['department_id'])) {
    $departmentId = $_POST['department_id'];
    $query = "
        SELECT doctors.DoctorID, users.Fname, users.Lname 
        FROM doctors 
        INNER JOIN users ON doctors.UserID = users.id
        WHERE doctors.DepartmentID = ? AND doctors.verified = 'verified'";
<<<<<<< HEAD

=======
    
>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $departmentId);
    $stmt->execute();
    $result = $stmt->get_result();
<<<<<<< HEAD

=======
    
>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c
    $doctors = [];
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
<<<<<<< HEAD

    echo json_encode($doctors);
}
=======
    
    echo json_encode($doctors);
}
?>
>>>>>>> edbd8b926f5df3adf3082fd7889ca537e0b1cd3c
