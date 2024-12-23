<?php
require_once '../../conn.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('Category ID is required.');
}

$category_id = $_GET['id'];

$query = "DELETE FROM categories WHERE id = $category_id";

if (mysqli_query($conn, $query)) {
    header("Location: manage-category.php?message=Category deleted successfully.");
    exit();
} else {
    die('Failed to delete category.');
}
?>
