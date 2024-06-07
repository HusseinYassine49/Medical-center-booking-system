<?php
define("db_SERVER", "localhost");
<<<<<<< HEAD
define("db_USER", "root");
define("db_PASSWORD", "");
define("db_DBNAME", "medical-center-booking-system");
=======
define("db_USER","root");
define("db_PASSWORD","");
define("db_DBNAME", "clinicclick");
>>>>>>> 00a3dd5f83cf2a3a17f606007e350d778e925cec

$con = mysqli_connect(
    db_SERVER,
    db_USER,
    db_PASSWORD,
    db_DBNAME
);



if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
<<<<<<< HEAD
=======

return $con;
?>
>>>>>>> 00a3dd5f83cf2a3a17f606007e350d778e925cec
