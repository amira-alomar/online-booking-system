<?php
require_once '../conn.php';
session_start();

$user = null; // Default to null

// Ensure the user is logged in before fetching the profile
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.net/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 main-content">
                <div class="header">
                    <h4>Admin Profile</h4>
                </div>
                <div class="content">
                    <?php if ($user): ?>
                        <div class="card" style="max-width: 600px; margin: 0 auto;">
                            <div class="card-body">
                                <h5 class="card-title">Profile Information</h5>
                                <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                                <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
                                
                                <a href="edit-profile.php" class="btn btn-warning">Edit Profile</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <p>User not logged in. Please log in to view the profile.</p>
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
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }
    </style>
</body>
</html>
