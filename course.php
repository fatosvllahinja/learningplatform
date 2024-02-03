<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Project - First Phase">
  <meta name="keywords" content="HTML, CSS, JavaScript">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Course Page - Online Learning Platform</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .course-container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      text-align: center;
    }

    .course-image {
      max-width: 100%;
      height: auto;
      margin-bottom: 20px;
    }

    .course-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .course-description {
      margin-bottom: 20px;
    }

    .instructor-info {
      margin-bottom: 20px;
    }

    .curriculum {
      text-align: left;
    }

    .curriculum ul {
      list-style-type: disc;
      padding: 0;
    }

    .curriculum li {
      margin-bottom: 10px;
      margin-top: 10px;
      margin-left: 20px;
    }
    .curriculum-container {
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 50px;
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
  <main class="course-container">  
    <?php

    include 'config/db_config.php';

    if (isset($_GET['id'])) {

        $course_id = $_GET['id'];
        // Id osht mire

        $result = mysqli_query($conn, "SELECT courses.*, users.username AS instructor, users.email AS instructor_email
        FROM courses
        JOIN users ON courses.user_id = users.id
        WHERE courses.id = $course_id;");

        if ($row = mysqli_fetch_assoc($result)) {
     
          echo "<img src='{$row['course_image']}' alt='Course Image' class='course-image'>
                <div class='course-description-container'>
                  <h1 class='course-title'>{$row['title']}</h1>
                  <p class='course-description'>{$row['description']}</p>
                  <div class='instructor-info'>
                    <p>Instructor: {$row['instructor']}</p>
                    <p>Email: {$row['instructor_email']}</p>
                    <p>Duration: {$row['duration']}</p>
                  </div>
                </div>";
    ?>    
    <div class="curriculum-container">
      <div class="curriculum">
        <h2>Curriculum</h2>
        <!-- <ul>
          <li>Introduction to HTML</li>
          <li>Styling with CSS</li>
          <li>JavaScript Basics</li>
          <li>Project: Building a Simple Website</li>
        </ul> -->
          
        <?php
          echo "<div>{$row['curriculum']}</div>";
        ?>
      </div>
      <div class="signup-btn">
        <a href="register.php">Purchase</a>
      </div>
    </div>
    <?php
      } else {
        echo "News item not found.";
      }
      } else {
        echo "Invalid request. News ID not provided.";
        mysqli_close($conn);
      }
    ?>
  </main>
  <footer>
    <p>&copy; 2023 Online Learning Platform. All rights reserved. | Contact: info@onlinelearningplatform.com</p>
  </footer>
</body>
</html>