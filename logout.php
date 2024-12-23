<?php
session_start();

session_destroy();

header("Location: ./login-signup/./html_css/login.php");
exit();
?>

