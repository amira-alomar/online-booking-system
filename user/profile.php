<?php
session_start();
include '../conn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$error_message = "";
$success_message = "";


$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$user_data = mysqli_fetch_assoc($result);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = trim($_POST['username']);
    $new_password = trim($_POST['password']);

    if (!empty($new_username) && !empty($new_password)) {
        $update_query = "UPDATE users SET username = '$new_username', password = '$new_password' WHERE id = '$user_id'";
        if (mysqli_query($conn, $update_query)) {
            $_SESSION['username'] = $new_username;
            $success_message = "Profile updated successfully!";
        } else {
            $error_message = "Failed to update profile.";
        }
    } else {
        $error_message = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookNow - Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="logo">Book<span>Now</span></div>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="history.php" class="nav-link">History</a>
            </li>
            <li class="nav-item">
                <a href="../logout.php" class="nav-link">Logout</a>
            </li>
        </ul>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Your Profile</h2>

        <?php if (!empty($error_message)) : ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <?php if (!empty($success_message)) : ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="<?php echo htmlspecialchars($user_data['username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success btn-block">Update Profile</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>

</html>

<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Roboto', sans-serif;
    }

    .navbar {
        background-color: #4CAF50;
    }

    .navbar .logo {
        font-size: 24px;
        color: #fff;
    }

    .navbar ul li a {
        color: #fff;
    }

    .container {
        max-width: 600px;
    }
</style>
