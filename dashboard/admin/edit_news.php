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
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
  <div class="dashboard-container">
    <div class="sidebar">
      <h2>Dashboard</h2>
      <a href="index.php">Home</a>
      <a href="about.php">About Us</a>
      <a href="news.php">News</a>
      <a href="contact.php">Contact List</a>
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
            <h4>News</h4>
            <?php

                $result = mysqli_query($conn, "SELECT * FROM news");

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='news-list'>
                            <p>Title: {$row['title']} | Description: {$row['description']} | Author: {$row['id']}</p>
                            <a href='edit_news.php?id={$row['id']}'>Edit</a> | 
                            <a href='delete_news.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this news?\")'>Delete</a>
                        </div>";
                }
            ?>
            <hr>
            <h4>Edit News</h4>
            <?php

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                    $news_id = $_POST['news_id'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $thumbnail_image = $_FILES['news_thumbnail'];

                    $thumbnail_image_path = processImage($thumbnail_image, "thumbs");

                    $update_query = "UPDATE news SET title = '$title', description = '$description', news_thumbnail = '$thumbnail_image_path', date = NOW() WHERE id = $news_id";

                    if (mysqli_query($conn, $update_query)) {
                        echo "News updated successfully";
                    } else {
                        echo "Error updating news: " . mysqli_error($conn);
                    }
                    mysqli_close($conn);
                }

                if (isset($_GET['id'])) {
                    $news_id = $_GET['id'];

                    $select_query = "SELECT * FROM news WHERE id = $news_id";
                    $result = mysqli_query($conn, $select_query);

                    if ($row = mysqli_fetch_assoc($result)) {
                        $title = $row['title'];
                        $description = $row['description'];
                ?>

                <form action='edit_news.php' method='post' enctype='multipart/form-data'>
                    <input type='hidden' name='news_id' value='<?php echo $news_id; ?>'>
                    <label>Title: <input type='text' name='title' value='<?php echo $title; ?>'></label>
                    <label>Description: <textarea name='description'><?php echo $description; ?></textarea></label>
                    <label>Thumbnail Image: <input type='file' name='news_thumbnail'></label>
                    <input type='submit' value='Update News'>
                </form>

                <?php
                    } else {
                        echo "News not found";
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
