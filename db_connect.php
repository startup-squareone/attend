<?php
$servername = 'your_db_servername';
$username = 'your_db_username';
$password = 'your_db_password';
$database = 'your_db_name';

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
