<?php
include 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookNow - Home</title>
</head>

<body>
    <header class="navbar">
        <div class="logo">Book<span>Now</span></div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a class="login-btn" href="./login-signup/./html_css/./login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="hero">
            <h1>Welcome to <span>BookNow</span></h1>
            <p>Your one-stop online booking solution for services, appointments, and more!</p>
            <button class="cta-btn"><a class="cta-btn" href="./login-signup/./html_css/./login.php">Get Started</a></button>
        </section>

        <!-- Services Section -->
        <section id="services" class="services">
            <h3>Our Services</h3>
            <div class="service-card">
                <img src="https://images.pexels.com/photos/6724317/pexels-photo-6724317.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Service 1">
                <h4>Salon Booking</h4> 
                <p>Book a hair cut, massage, spa, and more.</p>
                <a href="./login-signup/./html_css/./login.php" class="book-btn">Book Now</a>
            </div>
            <div class="service-card">
                <img src="https://images.pexels.com/photos/356040/pexels-photo-356040.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Service 2">
                <h4>Doctor Appointment</h4>
                <p>Consult a doctor or book an appointment.</p>
                <a href="./login-signup/./html_css/./login.php" class="book-btn">Book Now</a>
            </div>
            <div class="service-card">
                <img src="https://images.pexels.com/photos/15141213/pexels-photo-15141213/free-photo-of-a-group-of-people-standing-around-a-table.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Service 3">
                <h4>Event Booking</h4>
                <p>Book tickets for events, conferences, and more.</p>
                <a href="./login-signup/./html_css/./login.php" class="book-btn">Book Now</a>
            </div>
        </section>

        <!-- About Us Section -->
        <section id="about" class="about">
            <h3>About Us</h3>
            <p>
                At <span>BookNow</span>, we believe in simplifying the booking process for a variety of services. 
                Whether it's a salon appointment, a doctor's consultation, or an event ticket, we've got you covered. 
                Our mission is to bring convenience to your fingertips with a seamless and user-friendly platform.
            </p>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="contact">
            <h3>Contact Us</h3>
            <form action="submit_contact.php" method="POST" class="contact-form">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Your Full Name" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Your Email Address" required>
                
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" placeholder="Your Message" required></textarea>
                
                <button type="submit" class="cta-btn">Send Message</button>
            </form>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2024 BookNow. All Rights Reserved.</p>
    </footer>

    <script>
        // Smooth Scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>
<style>
    /* General Styles */
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background: #f1f1f1; /* Light Background */
    color: #2c3e50; /* Dark Text */
}

/* Navbar */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 30px;
    background: #4CAF50; /* Primary Green */
    color: #2c3e50; /* Dark Text */
}

.navbar .logo {
    font-size: 24px;
    font-weight: bold;
    text-decoration: none;
    color: #2c3e50;
}

.navbar ul {
    list-style: none;
    display: flex;
    gap: 15px;
    margin: 0;
    padding: 0;
}

.navbar ul li a, .login-btn {
    text-decoration: none;
    color: #2c3e50; /* Text Color */
    padding: 8px 15px;
    border-radius: 5px;
    transition: background 0.3s ease-in-out;
}

.login-btn {
    background: #BDC3C7; /* Light Gray */
    border: none;
    cursor: pointer;
}

.navbar ul li a:hover, .login-btn:hover {
    background: #95a5a6; /* Grey Hover */
    color: #34495e; /* Darker Text Color */
}

/* Hero Section */
.hero {
    text-align: center;
    padding: 120px 20px;
    background: #BDC3C7; /* Light Gray */
    color: #2c3e50; /* Text Color */
}

.hero h1 {
    font-size: 3rem;
    margin-bottom: 20px;
}

.hero h1 span {
    color: #4CAF50; /* Primary Green */
}

.hero p {
    font-size: 1.2rem;
    margin-bottom: 30px;
}

.hero .cta-btn {
    padding: 12px 25px;
    font-size: 16px;
    color: #f1f1f1; /* Accent Color */
    background: #4CAF50; /* Primary Green */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease-in-out;
}

.hero .cta-btn:hover {
    background: #95a5a6; /* Grey Hover */
    color: #34495e; /* Darker Text Color */
}

/* Services Section */
.services {
    text-align: center;
    padding: 50px 20px;
    background-color: #fff; /* White Background */
}

.services h3 {
    font-size: 2.2rem;
    margin-bottom: 40px;
    color: #2c3e50;
}

.service-card {
    display: inline-block;
    text-align: center;
    padding: 20px;
    margin: 15px;
    width: 300px;
    background-color: #f8f9fa; /* Slightly lighter Gray */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
}

.service-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
}

.service-card h4 {
    margin-top: 20px;
    font-size: 1.5rem;
    color: #2c3e50; /* Dark Text */
}

.service-card p {
    margin: 10px 0;
    font-size: 1rem;
    color: #7f8c8d; /* Gray Text */
}

.book-btn {
    display: inline-block;
    margin-top: 15px;
    background-color: #4CAF50; /* Primary Green */
    color: #ffffff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1rem;
    transition: background 0.3s ease-in-out;
}

.book-btn:hover {
    background-color: #95a5a6; /* Grey Hover */
}

/* About Section */
.about {
    text-align: center;
    padding: 50px 20px;
    background: #BDC3C7; /* Light Gray */
    color: #2c3e50; /* Text Color */
}

.about h3 {
    font-size: 2.2rem;
    margin-bottom: 20px;
}

.about p {
    font-size: 1.2rem;
    max-width: 800px;
    margin: 0 auto;
    line-height: 1.6;
}

/* Contact Section */
.contact {
    text-align: center;
    padding: 50px 20px;
    background: #fff; /* White Background */
}

.contact h3 {
    font-size: 2.2rem;
    margin-bottom: 20px;
    color: #2c3e50;
}

.contact-form {
    max-width: 600px;
    margin: 0 auto;
    text-align: left;
}

.contact-form label {
    display: block;
    margin: 10px 0 5px;
    color: #2c3e50;
    font-weight: bold;
}

.contact-form input, .contact-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #bdc3c7;
    border-radius: 5px;
    font-size: 1rem;
}

.contact-form button {
    display: inline-block;
    background: #4CAF50; /* Primary Green */
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    transition: background 0.3s ease-in-out;
}

.contact-form button:hover {
    background: #95a5a6; /* Grey Hover */
}


/* Footer */
.footer {
    text-align: center;
    padding: 15px 20px;
    background: #4CAF50; /* Primary Green */
    color: #f1f1f1; /* Light Text */
    font-size: 0.9rem;
}

.footer a {
    color: #2c3e50; /* Dark Text */
    text-decoration: none;
}

.footer a:hover {
    text-decoration: underline;
}

</style>
