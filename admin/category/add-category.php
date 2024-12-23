<?php
require_once '../../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $emoji = $_POST['emoji'];
    $description = $_POST['description'];

    $insert_query = "INSERT INTO categories (title, emoji, description) VALUES ('$title', '$emoji', '$description')";

    if (mysqli_query($conn, $insert_query)) {
        header("Location: manage-category.php?message=Category added successfully.");
        exit();
    } else {
        die('Failed to add category.');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h3 {
            color: #4CAF50;
        }
        .btn-primary {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }
        .btn-primary:hover {
            background-color: #45a049;
            border-color: #45a049;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }
        .alert-info {
            background-color: #e9f7fe;
            color: #31708f;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h3>Add Category</h3>
        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="emoji" class="form-label">Emoji</label>
                <input type="text" name="emoji" id="emoji" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
            <a href="manage-category.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html
