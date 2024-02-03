<?php
    session_start();
    include '../../config/db_config.php';

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Dashboard">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
  <div class="dashboard-container">
    <div class="sidebar">
      <h2>Dashboard</h2>
      <a href="index.php">My Courses</a>
    </div>
    <div class="main-content">
        <div class="header">
            <?php
                $user_id = $_SESSION['user_id'];
                $role = $_SESSION['role'];
                $userID = mysqli_query($conn, "SELECT username FROM users WHERE id = $user_id");
                $userData = mysqli_fetch_assoc($userID);
                $username = $userData['username'];
                
                echo "<p>Welcome, $username. Your role is $role.</p>
                        <form action='' method='post'>
                            <input type='submit' name='logout' value='Logout' class='login-btn'>
                        </form>";
            ?>
        </div>
        <div class="content-wrapper">
            <h4>My Courses</h4>
            <?php

                $result = mysqli_query($conn, "SELECT courses.*, users.username AS instructor
                FROM courses
                JOIN users ON courses.user_id = users.id
                WHERE courses.user_id = $loggedInUserId");

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='course-list'>
                            <p>Title: {$row['title']} | Description: {$row['description']} | Author: {$row['instructor']}</p>
                            <a href='edit_course.php?id={$row['id']}'>Edit</a> | 
                            <a href='delete_course.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this course?\")'>Delete</a>
                        </div>";
                }
            ?>
            <hr>
            <h4>Edit Course</h4>
            <?php

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $course_id = $_POST['course_id'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $duration = $_POST['duration'];
                    $curriculum = $_POST['curriculum'];
                    $thumbnail_image = $_FILES['thumbnail_image'];
                    $full_image = $_FILES['full_image'];

                    $thumbnail_image_path = processImage($thumbnail_image, "thumbs");
                    $full_image_path = processImage($full_image, "full");

                    $update_query = "UPDATE courses SET title = '$title', description = '$description', duration = '$duration', 
                                    course_thumbnail = '$thumbnail_image_path', course_image = '$full_image_path', curriculum = '$curriculum' WHERE id = $course_id";

                    if (mysqli_query($conn, $update_query)) {
                        echo "Course updated successfully. Go back to <a href='index.php'>Dashboard</a>";
                    } else {
                        echo "Error updating course: " . mysqli_error($conn);
                    }

                    mysqli_close($conn);
                }

                if (isset($_GET['id'])) {
                    $course_id = $_GET['id'];

                    $select_query = "SELECT * FROM courses WHERE id = $course_id";
                    $result = mysqli_query($conn, $select_query);

                    if ($row = mysqli_fetch_assoc($result)) {
                        $title = $row['title'];
                        $description = $row['description'];
                        $duration = $row['duration'];
                        $curriculum = $row['curriculum'];
                ?>

                <form action='edit_course.php' method='post' enctype='multipart/form-data'>
                    <input type='hidden' name='course_id' value='<?php echo $course_id; ?>'>
                    <label>Title: <input type='text' name='title' value='<?php echo $title; ?>'></label>
                    <label>Description: <textarea name='description'><?php echo $description; ?></textarea></label>
                    <label>Curriculum: <input type='text' name='duration' value='<?php echo $curriculum; ?>'></label>
                    <label>Duration: <input type='text' name='duration' value='<?php echo $duration; ?>'></label>
                    <label>Thumbnail: <input type='file' name='thumbnail_image'></label>
                    <label>Image: <input type='file' name='full_image'></label>
                    <input type='submit' value='Update Course'>
                </form>

                <?php
                    } else {
                        echo "Course not found";
                    }
                }

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
        </div>
    </div>
  </div>
</body>
</html>
