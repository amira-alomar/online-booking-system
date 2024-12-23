<?php
require_once '../conn.php';
session_start();

$user = null; // Default to null


if (isset($_SESSION['user_id'])) {
    $admin_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id = '$admin_id' AND role = 'admin'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }
} else {
    echo "User not logged in. Please log in to view the profile.";
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Update query if the password field is provided
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT); 
        $query = "UPDATE users SET username = '$username', email = '$email', password = '$password' WHERE id = '$admin_id'";
    } else {
        // If no password is provided, just update username and email
        $query = "UPDATE users SET username = '$username', email = '$email' WHERE id = '$admin_id'";
    }

    // Execute the query
    if ($conn->query($query)) {
        echo "Profile updated successfully.";
        header("Location: profile.php"); // Redirect to profile page after update
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.net/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 main-content">
                <div class="header">
                    <h4>Edit Profile</h4>
                </div>
                <div class="content">
                    <?php if ($user): ?>
                        <form method="POST">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password">New Password (leave empty to keep current password):</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success">Update Profile</button>
                        </form>
                    <?php else: ?>
                        <p>User not logged in. Please log in to edit the profile.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .main-content {
            padding: 20px;
        }

        .header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
</body>

</html>
