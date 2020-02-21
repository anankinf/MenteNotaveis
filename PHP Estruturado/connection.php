<?php
$server = "localhost";
$user 	= "root";
$pass	= "secret";
$database = "mnteste";

// Conect Mysql
@$mysqli = new mysqli($server,$user,$pass,$database);

// Error

if(mysqli_connect_errno()){
echo "Failed to connect to MySQL:(".$mysqli->connect_errno.") ".$mysqli->connect_error;
exit;
}