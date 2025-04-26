<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_depedro_ems";

// to create a connection
$conn =  new mysqli($servername, $username, $password, $dbname);

// to check a connection
if ($conn->connect_error) {
    die("Connection field: " . $conn-> connect_error);
}

?>