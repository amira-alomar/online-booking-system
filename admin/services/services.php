<?php
require_once '../../conn.php';

$query = "SELECT s.id, s.category_id, s.title, s.time, s.image_url, c.title AS category_name
        FROM services s
        JOIN categories c ON s.category_id = c.id";

$result = $conn->query($query);

if (isset($_GET['message'])) {
    $message = $_GET['message'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services</title>
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

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h3>Manage Services</h3>

        <?php if (isset($message)): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>

        <a href="add-service.php" class="btn btn-primary mb-3">Add Service</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Time</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($service = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($service['title']); ?></td>
                        <td><?php echo htmlspecialchars($service['category_name']); ?></td>
                        <td><?php echo htmlspecialchars($service['time']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($service['image_url']); ?>" alt="Service Image" width="50"></td>
                        <td>
                            <a href="edit-service.php?id=<?php echo $service['id']; ?>" class="btn btn-secondary">Edit</a>
                            <a href="delete-service.php?id=<?php echo $service['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
