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
            <h4>About Description</h4>
            <form action='edit_about.php' method='post'>
                <label>Description: <textarea name='about_description'></textarea></label>
                <input type='submit' value='Save Changes'>
            </form> 
            <hr>
            <h4>Add/Remove Team Member</h4>
            <?php
                $result = mysqli_query($conn, "SELECT * FROM team");

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='course-list'>
                            <p>Name: {$row['name']}</p>
                            <a href='remove_team_member.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this member?\")'>Delete</a>
                         </div>";
                }
            ?>
            <form action='add_team_member.php' method='post' enctype='multipart/form-data'>
                <label>Name: <input type='text' name='name'></label>
                <label>Position: <input type='text' name='position'></label>
                <label>Team Member Image: <input type='file' name='profile_img'></label>
                <input type='submit' value='Add Team Member'>
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