<?php
require "../include/connection.php";

if(isset($_POST['insert'])){
    $name = $_POST['name'];
    $desc = $_POST['description'];

    $sql = "INSERT INTO department (Department_name, Description) VALUES (?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $name, $desc);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Data inserted successfully'); window.location.href=depart-Reg.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "')</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$con->close();
?>
