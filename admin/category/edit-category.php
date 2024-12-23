<?php
require_once '../../conn.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('Category ID is required.');
}

$category_id = $_GET['id'];

$query = "SELECT * FROM categories WHERE id = $category_id";
$result = mysqli_query($conn, $query);
$category = mysqli_fetch_assoc($result);

if (!$category) {
    die('Category not found.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $emoji = $_POST['emoji'];
    $description = $_POST['description'];

    $update_query = "UPDATE categories SET title = '$title', emoji = '$emoji', description = '$description' WHERE id = $category_id";
    if (mysqli_query($conn, $update_query)) {
        header("Location: manage-category.php?message=Category updated successfully.");
        exit();
    } else {
        die('Failed to update category.');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Category</title>
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
        <h3>Edit Category</h3>
        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="<?php echo $category['title']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="emoji" class="form-label">Emoji</label>
                <input type="text" name="emoji" id="emoji" class="form-control" value="<?php echo $category['emoji']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" required><?php echo $category['description']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="manage_category.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
