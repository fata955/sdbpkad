<?php
include "../lib/conn.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Connect to database (make sure to replace with your database details)
    // $conn = new mysqli('localhost', 'root', '', 'your_database');
    
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }
    
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    
    if ($result->num_rows > 0) {
        $data = mysqli_fetch_array($result);
        $username = $data['username'];
        $_SESSION['username'] = $username; 
        header("Content-Type: application/json");
        echo json_encode([
            "statusCode" => 200,
            "message" => "Login succesfully"
          ]);
        // echo "Login successful!";
        // header('Location: /login'); // Redirect to admin page
        // exit();
    } else {
        echo "Invalid username or password.";
    }
    
    $conn->close();
}
