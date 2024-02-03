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
    $name = $_POST['name'];
    $position = $_POST['position'];
    $image = $_FILES['profile_img'];
    $imagePath = processImage($image, "../images/thumbs/", "thumbs");

    $insert_query = "INSERT INTO team (name, position, profile_img) VALUES ('$name', '$position', '$imagePath')";

    if (mysqli_query($conn, $insert_query)) {
        echo "Team member added successfully. Go back to <a href='index.php'>Dashboard</a>";
    } else {
        echo "Error adding team member: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>