<?php
define("db_SERVER", "localhost");
define("db_USER", "root");
define("db_PASSWORD", "");
define("db_DBNAME", "medical-center-booking-system");

$con = mysqli_connect(
    db_SERVER,
    db_USER,
    db_PASSWORD,
    db_DBNAME
);



if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
