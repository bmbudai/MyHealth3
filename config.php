<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
/*
define('DB_SERVER', '192.168.0.14');
define('DB_USERNAME', 'myhealth3');
define('DB_PASSWORD', 'myhealthPass');
define('DB_NAME', 'myhealth3');
*/
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'myhealth3');
define('DB_PASSWORD', '2W,^SxWFfvAE');
define('DB_NAME', 'myhealth3');


/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
