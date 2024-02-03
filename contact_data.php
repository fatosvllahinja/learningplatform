<?php
include 'config/db_config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Insert data into the database
    $insert_query = "INSERT INTO contact_data (name, email, message) VALUES ('$name', '$email', '$message')";

    if (mysqli_query($conn, $insert_query)) {
        echo "Form data saved successfully. <a href='index.php'>Go to Homepage.</a>";
    } else {
        echo "Error saving form data: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
