<?php

session_start();

include 'config/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == 'admin') {
                header("Location: dashboard/admin/index.php");
            } else {
                header("Location: dashboard/user/index.php");
            }
            exit();
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "Invalid username";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Project - First Phase">
  <meta name="keywords" content="HTML, CSS, JavaScript">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Online Learning Platform</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .register-form-container {
      border: 1px solid #c2c2c2;
      padding: 20px;
      max-width: 600px;
      margin: 0 auto;
      background-color: white;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      text-align: left;
    }

    input[type="text"],
    input[type="password"] {
      width: calc(100% - 24px);
      padding: 8px;
      border: 1px solid #c2c2c2;
      border-radius: 5px;
    }

    button {
      background-color: #02cfc0;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #00afa0;
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
    <h1>Login</h1>
    <div class="register-form-container">
      <form action="login.php" method="post">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" id="submitBtn">Login</button>
      </form>
    </div>
  </main>
  <footer>
    <p>&copy; 2023 Online Learning Platform. All rights reserved. | Contact: info@onlinelearningplatform.com</p>
  </footer>
</body>
</html>