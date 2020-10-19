<?php
$user = 'root';
$password = '';
$database = 'open_timer';
$servername='localhost';
$conn = new mysqli($servername, $user,$password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
