<?php
    session_start();

    include '../../config/db_config.php';

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../../login.php");
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
      <a href="index.php">Courses</a>
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
                    echo "<div class='course-list'>
                            <p>Title: {$row['title']} | Description: {$row['description']} | Author: {$row['author']}</p>
                            <a href='edit_news.php?id={$row['id']}'>Edit</a> | 
                            <a href='delete_news.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this course?\")'>Delete</a>
                        </div>";
                }
            ?>
            <hr>
            <h4>Add News</h4>
            <form action='add_news.php' method='post' enctype='multipart/form-data'>
                <label>Title: <input type='text' name='title'></label>
                <label>Description: <textarea name='description'></textarea></label>
                <label>Thumbnail Image: <input type='file' name='news_thumbnail'></label>
                <input type='submit' value='Add News'>
            </form>
        </div>
    </div>
  </div>
</body>
</html>
<?php
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../../login.php");
    exit();
}
?>