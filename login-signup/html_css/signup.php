<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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

        .alert {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .alert ul {
            list-style-type: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="form-box">
                <h2>Sign Up</h2>

                <?php if (!empty($errors)) : ?>
                    <div class="alert">
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="../php/./signup.php" method="POST">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" class="cta-btn">Sign Up</button>
                    <p class="toggle-form">Already have an account? <a href="../html_css/./login.php">Login</a></p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
