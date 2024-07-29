<?php
$servername = "localhost";
$username = "root";
$password = "n4dir4d3mi208";
$database = "sipd";
// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>