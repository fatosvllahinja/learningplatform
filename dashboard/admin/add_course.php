<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 'On');
session_start();

include '../../config/db_config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    $curriculum = $_POST['curriculum'];
    $fullImage = $_FILES['course_image'];
    $thumbImage = $_FILES['course_thumbnail'];
    $fImage = processImage($fullImage, "full");
    $thImage = processImage($thumbImage, "thumbs");

    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO courses (user_id, title, description, course_image, course_thumbnail, duration, curriculum) 
              VALUES ('$user_id', '$title', '$description', '$fImage', '$thImage', '$duration', '$curriculum')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

header("Location: index.php");
exit();

function processImage($image, $type) {
    $uploadPath = '';

        $fileName = basename($image['name']);
        $ImageTargetDir="./images/".$type."/";
        $FinalImage=$ImageTargetDir.$fileName;

        move_uploaded_file($image['tmp_name'], __DIR__.'/../../images/'.$type.'/'. $fileName);
        $uploadPath = $FinalImage;

    return $uploadPath;
}
?>
