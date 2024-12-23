<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        :root {
            --main-green: #4CAF50;
            --light-grey: #f4f4f4;
            --dark-grey: #333;
            --card-hover: rgba(0, 0, 0, 0.05);
        }

        body {
            background-color: var(--light-grey);
        }

        .sidebar {
            background-color: var(--dark-grey);
            min-height: 100vh;
            color: white;
            position: fixed;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: flex;
            align-items: center;
        }

        .sidebar a:hover {
            background-color: var(--main-green);
            transition: 0.3s;
        }
        .sidebar i {
            margin-right: 10px;
        }

        .header {
            background-color: var(--main-green);
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .profile {
            display: flex;
            align-items: center;
        }

        .header .profile img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .card {
            border: none;
            border-radius: 10px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px var(--card-hover);
        }

        .chart {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="col-md-2 sidebar p-4">
        <h3 class="text-center">Admin</h3>
        <ul class="nav flex-column">
            <li class="nav-item my-2">
                <a href="#"><i class="fas fa-chart-pie"></i> Dashboard</a>
            </li>
            <li class="nav-item my-2">
                <a href="../admin/./user/./manage_user.php"><i class="fas fa-users"></i> Manage Users</a>
            </li>
            <li class="nav-item my-2">
                <a href="../admin/./services/./services.php"><i class="fas fa-briefcase"></i> Manage Services</a>
            </li>
            <li class="nav-item my-2">
                <a href="../admin/./category/manage-category.php"><i class="fas fa-layer-group"></i> Manage Categories</a>
            </li>
            <li class="nav-item my-2">
                <a href="../admin/./profile.php"><i class="fas fa-user-circle"></i> Profile</a>
            </li>
            <li class="nav-item my-2">
                <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>
</body>
</html>