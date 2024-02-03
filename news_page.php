<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Project - First Phase">
  <meta name="keywords" content="HTML, CSS, JavaScript">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>News Page - Online Learning Platform</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .detailed-news-item img {
        max-width: 100%;
        height: auto;
    }
  </style>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="news.php">News</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            </ul>
            <div class="login-btn">
            <?php
            session_start();
            if (isset($_SESSION['user_id'])) {
                echo '<a href="logout.php">Logout</a></li>';
            } else {
                echo '<a href="login.php">Login</a>';
            }
        ?>
            </div>
    </nav>
</header>
<main>
<?php

include 'config/db_config.php';

if (isset($_GET['id'])) {
    $news_id = $_GET['id'];

    $select_query = "SELECT * FROM news WHERE id = $news_id";
    $result = mysqli_query($conn, $select_query);

    if ($row = mysqli_fetch_assoc($result)) {
        $title = $row['title'];
        $description = $row['description'];
        $thumbnail = $row['news_thumbnail'];
        $date = $row['date'];

        echo "<div class='detailed-news-item'>";
        echo "<img src='$thumbnail' alt='News Thumbnail'>";
        echo "<div class='news-content'>";
        echo "<h2>$title</h2>";
        echo "<h6>$date</h6>";
        echo "<p>$description</p>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "News item not found.";
    }
} else {
    echo "Invalid request. News ID not provided.";
}
?>
</main>
<footer>
    <p>&copy; 2023 Online Learning Platform. All rights reserved. | Contact: info@onlinelearningplatform.com</p>
</footer>
</body>
</html> 