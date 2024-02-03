<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $lecture_id = $_GET['id'];

    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "UPDATE lectures SET title='$title', description='$description' WHERE id=$lecture_id";
    mysqli_query($conn, $sql);

    header("Location: index.php");
    exit();
} else {
    echo "Invalid request";
}
?>