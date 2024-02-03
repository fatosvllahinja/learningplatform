<?php
session_start();

include '../../config/db_config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $course_id = $_GET['id'];

    $delete_query = "DELETE FROM courses WHERE id = $course_id";
    $result = mysqli_query($conn, $delete_query);

    if ($result) {
        echo "<p>Course deleted successfully. Go back to <a href='index.php'>Dashboard</a></p>";
    } else {
        echo "Error deleting course: " . mysqli_error($conn);
    }
} else {
    echo "Course ID not provided.";
}

mysqli_close($conn);
?>