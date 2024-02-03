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
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
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

                $select_query = "SELECT * FROM contact_data";
                $result = mysqli_query($conn, $select_query);
                
                echo "<p>Welcome, $username. Your role is $role.</p>
                        <form action='' method='post'>
                            <input type='submit' name='logout' value='Logout' class='login-btn'>
                        </form>";
             ?>
        </div>
        <div class="content-wrapper">
            <h4>Contact List</h4>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Submission Time</th>
      </tr>
    </thead>
    <tbody>
      <?php
      
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['message']}</td>";
        echo "<td>{$row['submission_time']}</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>

</body>
</html>

<?php
mysqli_close($conn);
?>


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