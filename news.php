<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Project - First Phase">
  <meta name="keywords" content="HTML, CSS, JavaScript">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>News - Online Learning Platform</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .latest-news-section {
      text-align: center;
      padding: 20px;
    }

    .latest-news-container {
      display: inline-block;
      text-align: left;
    }

    .latest-news-row {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      margin-bottom: 20px;
    }

    .latest-news-item {
      display: flex;
      align-items: center;
      width: 100%;
      max-width: 600px;
    }

    .latest-news-item img {
      width: 250px;
      height: auto;
      margin-right: 15px;
    }

    .news-content {
      flex: 1;
    }
    .news-content p {
      margin-top: 20px;
    }

    .news-content a {
      color: #333;
      text-decoration: none;
    }

    .pagination {
      margin-top: 20px;
    }

    .pagination ul {
      list-style-type: none;
      display: flex;
      justify-content: center;
      gap: 10px;
    }

    .pagination li {
      display: inline;
    }

    .pagination a {
      text-decoration: none;
      padding: 5px 10px;
      border: 1px solid #02cfc0;
      border-radius: 5px;
      color: #02cfc0;
    }
    .pagination a:hover {
      background-color: #02cfc0;
      color: white;
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
    <h1>Latest News</h1>
    <div class="latest-news-section">
      <div class="latest-news-container">
        <div class="latest-news-row">
          <?php

            include 'config/db_config.php';

            $select_query = "SELECT * FROM news";
            $result = mysqli_query($conn, $select_query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $title = $row['title'];
                    $description = $row['description'];
                    $thumbnail = $row['news_thumbnail'];
                    $date = $row['date'];
                    $news_id = $row['id'];

                    echo "<div class='latest-news-item'>";
                    echo "<img src='$thumbnail' alt='News Thumbnail'>";
                    echo "<div class='news-content'>";
                    echo "<h3><a href='news_page.php?id=$news_id'>$title</a></h3>";
                    echo "<h6>$date</h6>";
                    echo "<p>$description</p>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "No news items available.";
            }
            ?>
        </div>
      </div>
      <div class="pagination">
        <ul>
          <li><a href="#">Previous</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">Next</a></li>
        </ul>
      </div>
    </div>
  </main>
  <footer>
    <p>&copy; 2023 Online Learning Platform. All rights reserved.</p>
  </footer>
</body>
</html>
