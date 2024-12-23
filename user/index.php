<?php
session_start();
include '../conn.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_booking'])) {
    $user_id = $_SESSION['user_id'];
    $service_id = mysqli_real_escape_string($conn, $_POST['service_id']);
    $service_name = mysqli_real_escape_string($conn, $_POST['service_name']);
    $booking_date = date('Y-m-d');
    $appointment_date = date('Y-m-d', strtotime('+1 week'));

    $status = ($appointment_date > $booking_date) ? 'Pending' : 'Completed';
    
    $check_sql = "SELECT * FROM bookings WHERE user_id = '$user_id' AND service_name = '$service_name'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('You have already reserved this service.');</script>";
    } else {
        $sql = "INSERT INTO bookings (user_id, service_name, booking_date, appointment_date, status) 
                VALUES ('$user_id', '$service_name', '$booking_date', '$appointment_date', '$status')";

        if (mysqli_query($conn, $sql)) {
            header('Location: history.php');
            exit;
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>

    <header class="bg-light border-bottom py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="logo fw-bold" style="color: #4CAF50;">BookNow</h1>
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link text-dark" href="../user/history.php">My Bookings</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#">About us</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#">Help</a></li>
                    <li class="nav-item"><a class="btn btn-outline-dark" href="../logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero-section text-center text-white py-5" style="background-image: url(style/pexels-shvetsa-3987020.jpg); background-size: cover; background-position: center;">
        <div class="container">
            <h2 class="display-4 fw-bold">Your World, Just a <span style="color: #4CAF50;">Booking Away.</span></h2>
            <form class="mt-4 row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for event" aria-label="Search">
                        <button class="btn btn-success" type="submit"><i class="bi bi-search"></i> Search</button>
                    </div>
                </div>
            </form>
            <p class="mt-3 fs-5">From doctors to events, book everything you need <span class="fw-bold" style="color: #4CAF50;">quickly and hassle-free</span>.</p>
        </div>
    </section>

    <section class="categories py-5">
        <div class="container">
            <div class="row g-4">
                <?php
                $query = "SELECT * FROM categories";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-6 col-md-3">';
                        echo '<div class="card text-center p-3 shadow-sm">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . htmlspecialchars($row['emoji']) . ' ' . htmlspecialchars($row['title']) . '</h5>';
                        echo '<p class="card-text">' . htmlspecialchars($row['description']) . '</p>';
                        echo '</div></div></div>';
                    }
                } else {
                    echo '<p>No categories found</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <section class="popular-events py-5">
        <div class="container">
            <h2 class="fw-bold">Popular Categories in <span style="color: #4CAF50;">Lebanon</span></h2>

            <ul class="nav nav-tabs mt-4" id="categoryTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="doctors-tab" data-bs-toggle="tab" data-bs-target="#doctors" type="button" role="tab" aria-controls="doctors" aria-selected="false">Doctors</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tours-tab" data-bs-toggle="tab" data-bs-target="#tours" type="button" role="tab" aria-controls="tours" aria-selected="false">Tours</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="workshops-tab" data-bs-toggle="tab" data-bs-target="#workshops" type="button" role="tab" aria-controls="workshops" aria-selected="false">Workshops</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="salons-tab" data-bs-toggle="tab" data-bs-target="#salons" type="button" role="tab" aria-controls="salons" aria-selected="false">Beauty Salons</button>
                </li>
            </ul>

            <div class="tab-content mt-4" id="categoryTabsContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="row g-4">
                        <?php
                        $sql = "SELECT services.id AS service_id, services.title, services.time, services.image_url, categories.title AS category_name 
                            FROM services 
                            JOIN categories ON services.category_id = categories.id";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="col-md-3">';
                                echo '<div class="card shadow-sm">';
                                echo '<img src="' . htmlspecialchars($row['image_url']) . '" class="card-img-top" alt="' . htmlspecialchars($row['title']) . '">';
                                echo '<div class="card-body">';
                                echo '<h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>';
                                echo '<p class="card-text">' . htmlspecialchars($row['time']) . '</p>';
                                echo '<form method="POST">';
                                echo '<input type="hidden" name="service_id" value="' . htmlspecialchars($row['service_id']) . '">';
                                echo '<input type="hidden" name="service_name" value="' . htmlspecialchars($row['title']) . '">';
                                echo '<button class="btn btn-success" type="submit" name="book_service">Book Now</button>';
                                echo '</form>';
                                echo '</div></div></div>';
                            }
                        } else {
                            echo '<p>No services available at the moment.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="confirmReservationModal" tabindex="-1" aria-labelledby="confirmReservationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmReservationModalLabel">Confirm Your Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Do you want to confirm the reservation for <strong id="modalServiceName"></strong>?</p>
                    <p>Appointment Date: <span id="modalAppointmentDate"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form method="POST">
                        <input type="hidden" id="modalServiceId" name="service_id">
                        <input type="hidden" id="modalHiddenServiceName" name="service_name">
                        <button class="btn btn-success" type="submit" name="confirm_booking">Confirm Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bookNowButtons = document.querySelectorAll('.btn-success[name="book_service"]');
            bookNowButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default button behavior

                    // Get the service details from the form
                    const serviceId = this.closest('form').querySelector('input[name="service_id"]').value;
                    const serviceName = this.closest('form').querySelector('input[name="service_name"]').value;

                    // Update modal content
                    document.getElementById('modalServiceId').value = serviceId;
                    document.getElementById('modalHiddenServiceName').value = serviceName;
                    document.getElementById('modalServiceName').textContent = serviceName;

                    // Generate appointment date (1 week from today)
                    const appointmentDate = new Date();
                    appointmentDate.setDate(appointmentDate.getDate() + 7);
                    const formattedDate = appointmentDate.toISOString().split('T')[0];
                    document.getElementById('modalAppointmentDate').textContent = formattedDate;

                    // Show the modal
                    const modal = new bootstrap.Modal(document.getElementById('confirmReservationModal'));
                    modal.show();
                });
            });
        });
    </script>

</body>

</html>