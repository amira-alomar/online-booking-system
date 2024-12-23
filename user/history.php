<?php
session_start();
include '../conn.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];

    $sql = "SELECT * FROM bookings WHERE user_id = '$user_id' ORDER BY booking_date DESC";
    $result = mysqli_query($conn, $sql);


    //cancel
    if (isset($_POST['cancel_booking'])) {
        $booking_id = $_POST['booking_id'];
        $update_sql = "UPDATE bookings SET status = 'cancelled' WHERE id = '$booking_id'";
        mysqli_query($conn, $update_sql);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BookNow - Booking History</title>
        <link rel="stylesheet" href="history.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="logo">Book<span>Now</span></div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle username" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $username ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="../user/./profile.php">Profile</a>
                        <a class="dropdown-item" href="../logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="container my-5">
            <h2 class="text-center mb-4">Booking History</h2>

            <button class="btn btn-back mb-3"><a href="../user/./index.php">Back</a></button>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Booking Date</th>
                        <th>Appointment Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $statusClass = strtolower($row['status']);
                        echo "<tr>";
                        echo "<td>" . $row['service_name'] . "</td>";
                        echo "<td>" . date('Y-m-d', strtotime($row['booking_date'])) . "</td>";
                        echo "<td>" . date('Y-m-d', strtotime($row['appointment_date'])) . "</td>";
                        echo "<td class='status $statusClass'>" . $row['status'] . "</td>";
                        echo "<td>";

                        if ($row['status'] == 'pending') {
                            echo "<form method='POST'>
                        <input type='hidden' name='booking_id' value='" . $row['id'] . "'>
                        <button type='submit' name='cancel_booking' class='btn btn-danger btn-sm'>Cancel</button>
                        </form>";
                        }

                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No bookings found.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Please log in to see your bookings.</td></tr>";
            }
                ?>
                </tbody>

            </table>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    </body>

    </html>
