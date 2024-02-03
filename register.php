<?php

include 'config/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checkUsername = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($checkUsername);

    if ($result->num_rows > 0) {
        $error = "Username already taken. Please choose a different one.";
    } else {
        $insertUser = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', 'user')";
        if ($conn->query($insertUser) === TRUE) {
            $successMessage = "User created successfully!";
        } else {
            $error = "An error occurred during registration. Please try again later.";
        }
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
    input[type="email"],
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
        <a href="login.php">Login</a>
      </div>
  </nav>
</header>
  <main>
    <h1>Register</h1>
    <div class="register-form-container">
    <?php
      if (isset($successMessage)) {
          echo "<p class='success-message'>$successMessage</p>";
          echo "<p>Go back to <a href='login.php'>Login</a></p>";
      } elseif (isset($error)) {
          echo "<p class='error-message'>$error</p>";
      }
      ?>
      <form action="register.php" method="post" id="registerForm">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" id="submitBtn">Register</button>
      </form>
    </div>
  </main>
  <footer>
    <p>&copy; 2023 Online Learning Platform. All rights reserved. | Contact: info@onlinelearningplatform.com</p>
  </footer>
  <script>
    document.getElementById('registerForm').addEventListener('submit', function(event) {

      function validate() {
        const username = document.getElementById('username').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
  
        const hasNumbers = /\d/.test(username);
        if (hasNumbers) {
          alert('Username cannot contain numbers.');
          return false;
        }
  
        if (username === '' || email === '' || password === '') {
          alert('Please fill in all fields.');
          return false;
        }
  
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
          alert('Please enter a valid email address.');
          return false;
        }
  
        const hasSpecialCharacter = /[!@#$%^&*(),.?":{}|<>]/.test(password);
        if (!hasSpecialCharacter) {
          alert('Password should contain at least one special character.');
          return false;
        }
        return true;
      }

      if(validate() == false)
        event.preventDefault();
      });
      
    </script>
</body>
</html>