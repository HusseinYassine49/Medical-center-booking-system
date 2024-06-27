<?php
session_start();

if (!isset($_SESSION['user_info'])) {
    header("Location: ../login/login.php");
    exit();
}
$role=$_SESSION['user_info']['Role'];
if($role!=2)
{
    header("Location: ../login/login.php");
    exit();
}
?>
