<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Project - First Phase">
  <meta name="keywords" content="HTML, CSS, JavaScript">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About - Online Learning Platform</title>
  <link rel="stylesheet" href="styles.css">
  <style>
      .about-us {
        display: flex;
        flex-direction: column;
        gap: 20px;
        padding: 60px;
        background-color: #3b3c36;
      }

      .about-description {
        text-align: center;
        color: #fff;
      }

      .about-image {
        border: 2px solid white;
        text-align: center;
      }

      .about-image img {
        display: block;
        max-width: 100%;
        height: auto;
      }

      .team {
        margin-top: 60px;
        margin-bottom: 60px;
        text-align: center;
      }

      .team-members {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        align-items: center;
      }

      .team-member {
        flex: 0 0 250px;
        max-width: 250px;
        padding: 10px;
        text-align: center;
      }

      .team-member img {
        max-width: 100%;
        height: auto;
      }

      @media screen and (min-width: 768px) {
        .about-us {
          flex-direction: row;
          align-items: center;
        }

        .about-description {
          flex: 1;
          text-align: left;
        }

        .about-image {
          flex: 1;
          text-align: right;
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
  <main>
    <section class="about-us">
        <div class="about-description">
        <h1>About Us</h1>
          <?php
            include 'config/db_config.php';

            $about_query = "SELECT description FROM about";
            $about_result = mysqli_query($conn, $about_query);

            if ($about_row = mysqli_fetch_assoc($about_result)) {
                $about_description = $about_row['description'];    
                echo "<p>$about_description</p>";
            }
        ?>
        </div>
        <div class="about-image">
          <img src="images/about-header.jpg" alt="About Us Image">
        </div>
      </section>
  
      <section class="team">
        <h2>Our Team</h2>
        <div class="team-members">
          <?php

            $team_query = "SELECT * FROM team";
            $team_result = mysqli_query($conn, $team_query);

            while ($team_member = mysqli_fetch_assoc($team_result)) {
              $name = $team_member['name'];
              $position = $team_member['position'];
              $imagePath = $team_member['profile_img'];

              echo "<div class='team-member'>
                      <img src='$imagePath' alt='$name'>
                      <h3>$name</h3>
                      <p>Position: $position</p>
                    </div>";
            }
          ?>
        </div>
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
</body>
</html>