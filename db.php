<?php
// db.php
$host = 'localhost';
$user = 'root';
$password = '';  // Empty password (default for XAMPP)
$database = 'seat_allocation';
$port = 3307;  // Use this port if you're on 3307, else change it to 3306

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
