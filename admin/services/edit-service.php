<?php
require_once '../../conn.php';
session_start();

$service = null;
$categories = [];

if (isset($_GET['id'])) {
    $service_id = $_GET['id'];

    // Fetch service details
    $query = "SELECT id, category_id, title, time, image_url FROM services WHERE id = '$service_id'";
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        $service = $result->fetch_assoc();
    }

    // Fetch categories
    $query = "SELECT id, title FROM categories";  // Fix: Use `title` instead of `name`
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }

    // Update service data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $category_id = $_POST['category_id'];
        $title = $_POST['title'];
        $time = $_POST['time'];
        $image_url = $_POST['image_url'];

        $query = "UPDATE services 
                  SET category_id = '$category_id', title = '$title', time = '$time', image_url = '$image_url' 
                  WHERE id = '$service_id'";

        if ($conn->query($query)) {
            // Redirect to the service page or a list page after successful update
            header("Location: services.php");  // Replace with your actual service page
            exit;  // Make sure to exit after header to stop further script execution
        } else {
            echo "Error updating service.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Main Color Styling */
        .main-color {
            background-color: #4CAF50;
            color: white;
        }
        /* Custom button style */
        .btn-main {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }
        .btn-main:hover {
            background-color: #45a049;
            border-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h4 class="my-4">Edit Service</h4>
        <?php if ($service): ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $service['category_id'] ? 'selected' : ''; ?>>
                                <?php echo $category['title']; ?> <!-- Use `title` instead of `name` -->
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Service Title</label>
                    <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($service['title']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="time" class="form-label">Time</label>
                    <input type="text" id="time" name="time" class="form-control" value="<?php echo htmlspecialchars($service['time']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="image_url" class="form-label">Image URL</label>
                    <input type="text" id="image_url" name="image_url" class="form-control" value="<?php echo htmlspecialchars($service['image_url']); ?>" required>
                </div>
                <button type="submit" class="btn btn-main">Update Service</button>
            </form>
        <?php else: ?>
            <p>Service not found.</p>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
