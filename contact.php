<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Project - First Phase">
  <meta name="keywords" content="HTML, CSS, JavaScript">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - Online Learning Platform</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .contact-us {
      background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('images/contact_header.jpg');
      background-size: cover;
      background-position: center;
      color: #fff;
      padding: 60px;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
    }
    .main-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
    }

    .left-section {
      flex: 1;
      margin-right: 20px;
    }

    .right-section {
      flex: 1;
    }

    .contact-form-container {
      border: 2px solid #c2c2c2;
      padding: 20px;
      max-width: 600px;
      margin: 0 auto;
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
    textarea {
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

    @media screen and (max-width: 767px) {
      .main-container {
        flex-direction: column;
        padding: 10px;
      }

      .left-section,
      .right-section {
        width: 100%;
        margin-right: 0;
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
  <section class="contact-us">
    <h2>Contact Us</h2>
</section>
  <main class="main-container">
    <div class="left-section">
      <h1>Contact Us</h1>
      <p>Please use the form below to get in touch with us.</p>
    </div>
    <div class="right-section">
      <div class="contact-form-container">
        <form id="contactForm" action="contact_data.php" method="post">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>
          </div>
          <button type="submit" id="submitBtn">Submit</button>
        </form>
      </div>
    </div>
  </main>
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
  <footer>
    <p>&copy; 2023 Online Learning Platform. All rights reserved.</p>
  </footer>
</body>
<!-- <script>
  document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('contactForm');

  form.addEventListener('submit', function(event) {
    event.preventDefault();

    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const message = document.getElementById('message').value.trim();

    if (name === '' || email === '' || message === '') {
      alert('Please fill in all fields.');
      return false;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      alert('Please enter a valid email address.');
      return false;
    }
    alert('Form submitted successfully!');
  });
});
</script> -->
</html>