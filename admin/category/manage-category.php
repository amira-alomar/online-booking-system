<?php
require_once '../../conn.php';

$query = "SELECT * FROM categories";
$result = mysqli_query($conn, $query);

if (isset($_GET['message'])) {
    $message = $_GET['message'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Categories</title>
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
        <h3>Manage Categories</h3>
        <?php if (isset($message)): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>
        <a href="add-category.php" class="btn btn-primary mb-3">Add Category</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Emoji</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($category = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $category['title']; ?></td>
                        <td><?php echo $category['emoji']; ?></td>
                        <td><?php echo $category['description']; ?></td>
                        <td>
                            <a href="edit-category.php?id=<?php echo $category['id']; ?>" class="btn btn-secondary">Edit</a>
                            <a href="delete-category.php?id=<?php echo $category['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
