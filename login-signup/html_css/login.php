
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #BDC3C7;
    color: #2c3e50;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    width: 100%;
    max-width: 400px;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.form-container {
    display: flex;
    flex-direction: column;
}

.form-box {
    display: block;
}

.form-box h2 {
    text-align: center;
    margin-bottom: 20px;
}

.form-box input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.cta-btn {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
}

.cta-btn:hover {
    background-color: #45a049;
}

.toggle-form {
    text-align: center;
    margin-top: 10px;
}

.toggle-form a {
    color: #4CAF50;
    text-decoration: none;
}

.toggle-form a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="form-box">
                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($error_message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                <?php endif; ?>
                <h2>Login</h2>
                <form action="../php/./login.php" method="POST">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" class="cta-btn">Login</button>
                    <p class="toggle-form">Don't have an account? <a href="../html_css/./signup.php">Sign Up</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
