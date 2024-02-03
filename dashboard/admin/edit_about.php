<?php
session_start();

include '../../config/db_config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $description = $_POST['about_description'];

    $update_query = "INSERT INTO about (id, description) VALUES (1, 'Description here') ON DUPLICATE KEY UPDATE description = VALUES(description);";

    if (mysqli_query($conn, $update_query)) {
        echo "About description updated successfully. <a href='index.php'>Go to Dashboard</a>";
    } else {
        echo "Error updating about description: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {

    $select_query = "SELECT * FROM about";
    $result = mysqli_query($conn, $select_query);

    if ($row = mysqli_fetch_assoc($result)) {
        $about_id = $row['id'];
        $description = $row['description'];
?>

<form action='edit_about.php' method='post'>
    <input type='hidden' name='about_id' value='<?php echo $about_id; ?>'>
    <label>About Description: <textarea name='description'><?php echo $description; ?></textarea></label>
    <input type='submit' value='Update Description'>
</form>

<?php
    } else {
        echo "About record not found.";
    }
}
?>
