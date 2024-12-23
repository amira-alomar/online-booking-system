<?php
require_once 'conn.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['username']) || strlen($_POST['username']) < 3) {
        $errors[] = "Username is required and must be at least 3 characters.";
    }
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email address is required.";
    }
    if (empty($_POST['password']) || strlen($_POST['password']) < 6) {
        $errors[] = "Password is required and must be at least 6 characters long.";
    }

    if (empty($errors)) {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $query = "INSERT INTO `users`(`id`, `username`, `email`, `password`, `role`) 
                VALUES (NULL, '$username', '$email', '$password', 'user')";
        if ($conn->query($query)) {
            header("Location: ../html_css/./login.php");
            exit();
        } else {
            $errors[] = "An error occurred. Please try again later.";
        }
    }
}
?>