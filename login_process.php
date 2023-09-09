<?php
session_start();

// Include the database connection file
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform user authentication (replace with your own logic)
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        
        // Redirect to the appropriate dashboard based on user role
        if ($_SESSION['role'] === 'admin') {
            header('Location: admin_dashboard.php');
        } elseif ($_SESSION['role'] === 'teacher') {
            header('Location: teacher_dashboard.php');
        } elseif ($_SESSION['role'] === 'student') {
            header('Location: student_dashboard.php');
        } else {
            // Handle unrecognized roles
            header('Location: login.php');
        }
    } else {
        // Invalid credentials
        header('Location: login.php');
    }
}
?>
