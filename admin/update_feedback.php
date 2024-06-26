<?php
require "../include/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $stmt = $con->prepare("UPDATE feedback SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        echo "Feedback status updated successfully.";
    } else {
        echo "Error updating feedback status: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
?>
