<?php
session_start();

include '../../config/db_config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $team_member_id = $_GET['id'];

    $delete_query = "DELETE FROM team WHERE id = $team_member_id";

    if (mysqli_query($conn, $delete_query)) {
        echo "Team member removed successfully. Go back to <a href='index.php'>Dashboard</a>";
    } else {
        echo "Error removing team member: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request. Team member ID not provided.";
}

mysqli_close($conn);
?>