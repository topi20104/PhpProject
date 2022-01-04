<?php
$servername="127.0.0.1:3306";
$username="team9";
$password="cp7gzfTG";
$dbname ="default_team9";
// creating connection 
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) 
    die("Connection failed: ".$conn->connect_error);

$settimezone = "SET time_zone = '+02:00';";
mysqli_query($conn, $settimezone);
?>
