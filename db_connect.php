<?php
$servername = 'localhost';
$username = 'admin';
$password = 'administrator';
$database = 'attendance_management';

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
