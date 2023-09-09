<?php
include '../includes/db_connect.php';
include '../includes/functions.php';

// Implement CRUD operations for classes here
// Example: List all classes, add a new class, edit class details, delete a class
?>

<!-- HTML content for managing classes -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Classes</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h1>Manage Classes</h1>

        <!-- Form to Add New Class -->
        <h2>Add New Class</h2>
        <form action="add_class.php" method="POST">
            <label for="class_name">Class Name:</label>
            <input type="text" id="class_name" name="class_name" required>
            <button type="submit">Add Class</button>
        </form>

        <!-- Table to Display Existing Classes -->
        <h2>Existing Classes</h2>
        <table>
            <tr>
                <th>Class ID</th>
                <th>Class Name</th>
                <th>Action</th>
            </tr>
            <!-- Loop through and display classes from the database -->
            <?php
       
            // Include the database connection file
            include '../includes/db_connect.php';

            // Check if the user is logged in as an admin (you should implement user authentication)
            if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
                header('Location: login.php'); // Redirect to the login page if not logged in as an admin
                exit();
            }

            // CRUD operations for managing classes
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Add a new class
                if (isset($_POST['add_class'])) {
                    $class_name = $_POST['class_name'];

                    // Perform input validation (e.g., check if the class name is not empty)

                    // Insert the new class into the database
                    $sql = "INSERT INTO classes (class_name) VALUES ('$class_name')";

                    if ($conn->query($sql) === TRUE) {
                        header('Location: manage_classes.php'); // Redirect to the manage classes page
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                // Update an existing class
                elseif (isset($_POST['update_class'])) {
                    $class_id = $_POST['class_id'];
                    $new_class_name = $_POST['new_class_name'];

                    // Perform input validation and update the class name in the database
                    $sql = "UPDATE classes SET class_name = '$new_class_name' WHERE id = $class_id";

                    if ($conn->query($sql) === TRUE) {
                        header('Location: manage_classes.php'); // Redirect to the manage classes page
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }    
                }

                // Delete a class
                elseif (isset($_POST['delete_class'])) {
                    $class_id = $_POST['class_id'];

                    // Delete the class from the database
                    $sql = "DELETE FROM classes WHERE id = $class_id";

                    if ($conn->query($sql) === TRUE) {
                        header('Location: manage_classes.php'); // Redirect to the manage classes page
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            }

            // Fetch a list of all classes from the database
            $sql = "SELECT * FROM classes";
            $result = $conn->query($sql);

            $classes = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $classes[] = $row;
                }
            }

            $conn->close();


            ?>
        </table>
    </div>
</body>
</html>
