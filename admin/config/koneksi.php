<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_edel";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
//! untuk tidak 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
?>