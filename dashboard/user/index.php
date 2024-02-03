<!-- index.php Admin Dashboard -->
<?php
    session_start();

    include '../../config/db_config.php';

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
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
  <title>User Dashboard</title>
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
            <h4>Courses</h4>
            <?php
                $loggedUser = $_SESSION['user_id'];

                $result = mysqli_query($conn, "SELECT courses.*, users.username AS instructor
                FROM courses
                JOIN users ON courses.user_id = users.id
                WHERE courses.user_id = $loggedUser");

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='course-list'>
                            <p>Title: {$row['title']} | Description: {$row['description']} | Author: {$row['instructor']}</p>
                            <a href='edit_course.php?id={$row['id']}'>Edit</a> | 
                        </div>";
                }
            ?>
            <hr>
            <h4>Add Course</h4>
            <form action='add_course.php' method='post' enctype='multipart/form-data'>
                <label>Title: <input type='text' name='title'></label>
                <label>Description: <textarea name='description'></textarea></label>
                <label>Curriculum: <textarea name='curriculum'></textarea></label>
                <label>Duration: <input type='text' name='duration'></label>
                <label>Full Image: <input type='file' name='course_image'></label>
                <label>Thumbnail: <input type='file' name='course_thumbnail'></label>
                <input type='submit' value='Add Course'>
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