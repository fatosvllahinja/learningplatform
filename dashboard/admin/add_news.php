<?php
session_start();
include '../../config/db_config.php';

function processImage($image, $type) {
    $uploadPath = '';

        $fileName = basename($image['name']);
        $ImageTargetDir="./images/".$type."/";
        $FinalImage=$ImageTargetDir.$fileName;

        move_uploaded_file($image['tmp_name'], __DIR__.'/../../images/'.$type.'/'. $fileName);
        $uploadPath = $FinalImage;

    return $uploadPath;
}

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $thumbnail_image = $_FILES['news_thumbnail'];
    $thImage = processImage($thumbnail_image, 'thumbs');
    $date = date('Y-m-d');

    $insert_query = "INSERT INTO news (title, description, news_thumbnail, date) VALUES ('$title', '$description', '$thImage', '$date')";

    if (mysqli_query($conn, $insert_query)) {
        echo "News added successfully. <a href='index.php'>Go to Dashboard</a>";
    } else {
        echo "Error adding news: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}

?>