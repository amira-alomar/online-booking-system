<?php
require_once '../../conn.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('User ID is required.');
}

$user_id = $_GET['id'];
$message = '';

$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($query);
$user = $result->fetch_assoc();

if (!$user) {
    die('User not found.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $role = htmlspecialchars($_POST['role']);

    $update_query = "UPDATE users SET username = '$username', email = '$email', role = '$role' WHERE id = '$user_id'";

    if ($conn->query($update_query)) {
        $message = "User updated successfully!";
        header("Location: manage_user.php");
        exit();
    } else {
        $message = "Failed to update user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h3>Edit User</h3>
        <?php if ($message): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="<?php echo $user['username']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo $user['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" name="role" id="role" class="form-control" value="<?php echo $user['role']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="./manage_user.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
<style>
        body {
            background-color: #f4f4f4;
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

</html>
