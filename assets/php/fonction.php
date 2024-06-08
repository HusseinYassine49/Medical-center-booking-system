<?php
include "connection.php";
function updateuser($id, $Fname, $Lname, $Email, $DOB, $Gender, $BloodType)
{
    global $con;


    $query = "UPDATE `users` SET `Fname`='" . $Fname . "',`Lname`='" . $Lname . "',`Email`='" . $Email . "',`DOB`='" . $DOB . "',`Gender`='" . $Gender . "',`BloodType`='" . $BloodType . "' WHERE id='" . $id . "' ";

    $result = mysqli_query($con, $query);


    if ($result) {
        $Time = date("Y-m-d"); // Insert log entry
        $logQuery = "INSERT INTO `action_`( `userID`, `action_`, `time_`) VALUES ('" . $id . "','update information form the profile','" . $Time . "')";
        $logResult = mysqli_query($con, $logQuery);

        if ($logResult) {
            echo true; // Success
        } else {
            echo mysqli_error($con); // Log entry insertion failed
        }
    } else {
        echo mysqli_error($con); // Car insertion failed
    }
};
function doctor($id, $address, $specially, $verified_)
{
    global $con;

    // Check if the userID exists in the doctor table
    $checkQuery = "SELECT `userID` FROM `doctor` WHERE `userID` = '$id'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // If userID exists, update the existing record
        $query = "UPDATE `doctor` SET `address` = '$address', `specially` = '$specially', `verified_` = '$verified_' WHERE `userID` = '$id'";
        $result = mysqli_query($con, $query);

        if ($result) {
            $Time = date("Y-m-d"); // Insert log entry
            $logQuery = "INSERT INTO `action_` (`userID`, `action_`, `time_`) VALUES ('$id', 'update information for the doctor', '$Time')";
            $logResult = mysqli_query($con, $logQuery);

            if ($logResult) {
                echo true; // Success
            } else {
                echo mysqli_error($con); // Log entry insertion failed
            }
        } else {
            echo mysqli_error($con); // Query execution failed
        }
    } else {
        // If userID does not exist, insert a new record
        $query = "INSERT INTO `doctor` (`userID`, `address`, `specially`, `verified_`) VALUES ('$id', '$address', '$specially', '$verified_')";
        $result = mysqli_query($con, $query);

        if ($result) {
            $Time = date("Y-m-d"); // Insert log entry
            $logQuery = "INSERT INTO `action_` (`userID`, `action_`, `time_`) VALUES ('$id', 'insert information for the doctor', '$Time')";
            $logResult = mysqli_query($con, $logQuery);

            if ($logResult) {
                echo true; // Success
            } else {
                echo mysqli_error($con); // Log entry insertion failed
            }
        } else {
            echo mysqli_error($con); // Query execution failed
        }
    }
}
function feedback($id, $address, $specially, $verified_)
{
    global $con;


    $query = "INSERT INTO `doctor`( `userID`, `address`, `specially`, `verified_`) VALUES ('" . $id . "','" . $address . "','" . $specially . "','" . $verified_ . "') ";

    $result = mysqli_query($con, $query);


    if ($result) {
        $Time = date("Y-m-d"); // Insert log entry
        $logQuery = "INSERT INTO `action_`( `userID`, `action_`, `time_`) VALUES ('" . $id . "','insert information for the docter','" . $Time . "')";
        $logResult = mysqli_query($con, $logQuery);

        if ($logResult) {
            echo true; // Success
        } else {
            echo mysqli_error($con); // Log entry insertion failed
        }
    } else {
        echo mysqli_error($con); // Car insertion failed
    }
};
