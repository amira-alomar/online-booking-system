<?php
require_once '../../conn.php';
session_start();

$categories = [];
$query = "SELECT id, title FROM categories";  // Use `title` instead of `name`
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id = $_POST['category_id'];
    $title = $_POST['title'];
    $time = $_POST['time'];

    // File upload logic
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../user/./style/';
        $imageFile = $_FILES['image'];
        $imageName = basename($imageFile['name']);
        $imagePath = $uploadDir . $imageName;

        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($imageFile['type'], $allowedTypes)) {
            if (move_uploaded_file($imageFile['tmp_name'], $imagePath)) {
                $imageUrl = 'style/' . $imageName;

                // Insert into database
                $query = "INSERT INTO services (category_id, title, time, image_url) 
                        VALUES ('$category_id', '$title', '$time', '$imageUrl')";

                if ($conn->query($query)) {
                    echo "<script>
                            alert('Service added successfully!');
                            window.location.href = 'services.php';
                        </script>";
                } else {
                    echo "Error adding service.";
                }
            } else {
                echo "Error moving the uploaded file.";
            }
        } else {
            echo "Invalid file type. Only JPG, PNG, and GIF are allowed.";
        }
    } else {
        echo "Image upload failed. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .main-color { background-color: #4CAF50; color: white; }
        .btn-main { background-color: #4CAF50; border-color: #4CAF50; }
        .btn-main:hover { background-color: #45a049; border-color: #45a049; }
    </style>
</head>
<body>
    <div class="container">
        <h4 class="my-4">Add New Service</h4>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select id="category_id" name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['title']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Service Title</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">Time</label>
                <input type="text" id="time" name="time" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-main">Add Service</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
