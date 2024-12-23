<?php
require_once '../../conn.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('User ID is required.');
}

$user_id = $_GET['id'];

$query = "DELETE FROM users WHERE id = $user_id";

if (mysqli_query($conn, $query)) {
    header("Location: ./manage_user.php");
    exit();
} else {
    die('Failed to delete user.');
}
?>

