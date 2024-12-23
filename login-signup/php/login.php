<?php
require_once 'conn.php';
session_start();
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && !empty(trim($_POST['username'])) &&
        isset($_POST['password']) && !empty(trim($_POST['password']))) {

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

                if ($user['role'] === 'user') {
                    header("Location: ../../user/index.php");
                } else {
                    header("Location: ../../admin/index.php");
                }
                exit();
        } else {
            $error_message = "User does not exist or invalid credentials.";
        }
    } else {
        $error_message = "Please fill in all fields.";
    }
}
?>

