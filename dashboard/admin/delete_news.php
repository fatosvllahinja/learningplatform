<?php
session_start();

include '../../config/db_config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $news_id = $_GET['id'];

    $delete_query = "DELETE FROM news WHERE id = $news_id";
    $result = mysqli_query($conn, $delete_query);

    if ($result) {
        echo "News deleted successfully. Go back to <a href='index.php'>Dashboard</a></p>";
    } else {
        echo "Error deleting news: " . mysqli_error($conn);
    }
} else {
    echo "News ID not provided.";
}

mysqli_close($conn);
?>