<?php
require_once '../conn.php';
session_start();

$admin_name = 'Admin';

if (isset($_SESSION['user_id'])) {
    $admin_id = $_SESSION['user_id'];
    
    $query = "SELECT username FROM users WHERE id = '$admin_id' AND role = 'admin'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $admin_data = $result->fetch_assoc();
        $admin_name = htmlspecialchars($admin_data['username']);
    } else {
        echo "Admin not found!";
        exit();
    }
} else {
    echo "Please log in first!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php 
            require_once "./sidebar.php";
            ?>

            <!-- Main Content -->
            <div class="col-md-10 offset-md-2">
                <!-- Header -->
                <div class="header">
                    <h4>Dashboard</h4>
                    <div class="profile">
                        <img src="https://via.placeholder.com/40" alt="Profile">
                        <span><?php echo $admin_name; ?></span> <!-- Dynamic admin name -->
                    </div>
                </div>

                <!-- Statistics -->
                <div class="row my-4">
                    <div class="col-md-3">
                        <div class="card p-3 text-center">
                            <i class="fas fa-users fa-2x text-success"></i>
                            <h5 class="card-title mt-2">Total Users</h5>
                            <div class="card-body">120</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 text-center">
                            <i class="fas fa-briefcase fa-2x text-primary"></i>
                            <h5 class="card-title mt-2">Total Services</h5>
                            <div class="card-body">15</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 text-center">
                            <i class="fas fa-layer-group fa-2x text-warning"></i>
                            <h5 class="card-title mt-2">Total Categories</h5>
                            <div class="card-body">8</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 text-center">
                            <i class="fas fa-chart-line fa-2x text-danger"></i>
                            <h5 class="card-title mt-2">Profile Views</h5>
                            <div class="card-body">250</div>
                        </div>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="chart">
                            <h5>Statistics Overview</h5>
                            <canvas id="chart" width="400" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'User Growth',
                    data: [10, 20, 30, 40, 50, 60],
                    borderColor: '#4CAF50',
                    fill: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    </script>
</body>
</html>
