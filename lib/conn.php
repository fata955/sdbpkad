<?php
$servername = "localhost";
$username = "root";
$password = "nadirad3mi208";
$database = "spm";

// $servername = "localhost";
// $username = "satuclo1_bpkad";
// $password = "nadirad3mi208";
// $database = "satuclo1_sipd";
// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>