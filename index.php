<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Project - First Phase">
  <meta name="keywords" content="HTML, CSS, JavaScript">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Learning Platform</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .slider-container {
      width: 100%;
      position: relative;
      max-width: 100%;
      overflow: hidden;
      height: 500px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .slider {
      width: 100%;
      display: flex;
      overflow: hidden;
    }

    .slide {
      flex: 0 0 100%;
      height: 100%;
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: #ffffff;
    }

    .slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      position: absolute;
      top: 0;
      left: 0;
      z-index: -1;
    }

    .slide-content {
      padding: 20px;
      text-align: center;
    }

    .prev,
    .next {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background-color: #02cfc0;
      color: white;
      padding: 15px 30px;
      border: none;
      cursor: pointer;
      z-index: 1;
    }

    .prev {
      left: 10px;
    }

    .next {
      right: 10px;
    }

    @media screen and (max-width: 767px) {
      .course-box {
        width: 100%;
        margin-bottom: 20px;
      }
    }

    @media screen and (min-width: 768px) and (max-width: 991px) {
      .course-box {
        width: 48%;
        margin-bottom: 20px;
      }
    }

    @media screen and (min-width: 992px) {
      .course-box {
        width: 30%;
        margin-bottom: 20px;
      }
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
  <section class="slider-container">
    <div class="slider">
      <div class="slide">
        <img src="images/slider_image_1.jpg" alt="Slide 1 Image">
        <div class="slide-content">
          <h2>Welcome to the Online Learning Platform</h2>
          <p>Explore our courses and start learning today!</p>
        </div>
      </div>
      <div class="slide">
        <img src="images/slider_image_2.jpg" alt="Slide 2 Image">
        <div class="slide-content">
          <h2>Discover New Opportunities</h2>
          <p>Enhance your skills with our comprehensive courses.</p>
        </div>
      </div>
    </div>
    <button class="prev" onclick="moveSlide(-1)">Prev</button>
    <button class="next" onclick="moveSlide(1)">Next</button>
  </section>
  <main>
    <section class="course-section">
        <?php
            include 'config/db_config.php';

            $result = mysqli_query($conn, "SELECT courses.*, users.username AS instructor
                                            FROM courses
                                            JOIN users ON courses.user_id = users.id");

            while ($row = mysqli_fetch_assoc($result)) {

                $course_id = $row['id'];


                echo "<div class='course-box'>";
                echo "<a href='course.php?id=$course_id'>";
                echo "<img src='{$row['course_thumbnail']}' alt='Course Image'>";
                echo "<h2>{$row['title']}</h2>";
                echo "</a>";
                echo "<p>Description: {$row['description']}</p>";
                echo "<p>Instructor: {$row['instructor']}</p>";
                echo "<p>Duration: {$row['duration']}</p>";
                echo "<a href='course.php?id=$course_id' class='btn'>Enroll</a>";
                echo "</div>";
            }

            // Close the database connection
            mysqli_close($conn);
        ?>
    </section>
    <section class="why-choose-us">
        <div class="column">
           <h2>Why Choose Us?</h2>
        </div>
        <div class="column">
          <h3>Our platform offers:</h3>
          <ul>
            <li>High-quality courses</li>
            <li>Experienced instructors</li>
            <li>Flexible learning schedules</li>
            <li>Interactive learning resources</li>
          </ul>
        </div>
        <div class="column">
        <p>Start your learning journey with us today!</p>
          <div class="signup-btn">
            <a href="register.php">Register</a>
          </div>
        </div>
    </section>
  </main>
  <footer>
    <p>&copy; 2023 Online Learning Platform. All rights reserved. | Contact: info@onlinelearningplatform.com</p>
  </footer>
  <script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function moveSlide(n) {
      showSlides(slideIndex += n);
    }

    function showSlides(n) {
      let i;
      const slides = document.getElementsByClassName("slide");
      if (n > slides.length) { slideIndex = 1 }
      if (n < 1) { slideIndex = slides.length }
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      slides[slideIndex - 1].style.display = "block";
    }
  </script>
</body>
</html>