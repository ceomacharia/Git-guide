<?php
// Database connection (same as before)
$host = 'localhost';
$db = 'circuitedge';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch services and products from database (same as before)
$services_sql = "SELECT * FROM services";
$services_result = $conn->query($services_sql);

$products_sql = "SELECT * FROM products";
$products_result = $conn->query($products_sql);

// Handle contact form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $contact_sql = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";
    if ($conn->query($contact_sql) === TRUE) {
        $contact_success = "Thank you for contacting us! We'll get back to you soon.";
    } else {
        $contact_error = "Error submitting the form. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CircuitEdge Ltd.</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="header-container">
            <nav>
                <ul>
                    <li><a href="#about"><i class="fas fa-info-circle"></i> About Us</a></li>
                    <li><a href="#services"><i class="fas fa-concierge-bell"></i> Services</a></li>
                    <li><a href="#products"><i class="fas fa-box-open"></i> Products</a></li>
                    <li><a href="#contact"><i class="fas fa-envelope"></i> Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="content">
        <div class="banner">
            <div class="banner-text">
                <h1>Welcome to CircuitEdge Ltd.</h1>
                <p><i class="fas fa-lightbulb"></i> Pioneering innovative solutions in software and technology.</p>
            </div>
        </div>

        <!-- Services Section (same as before) -->
        <section id="services" class="services">
            <h2>Our Services</h2>
            <div class="services-grid">
                <?php if ($services_result->num_rows > 0): ?>
                    <?php while($service = $services_result->fetch_assoc()): ?>
                        <div class="service-item">
                            <i class="<?= $service['icon']; ?>"></i>
                            <h3><?= $service['name']; ?></h3>
                            <p><?= $service['description']; ?></p>
                            <p><strong>Price:</strong> $<?= $service['price']; ?></p>
                            <a href="order.php?service_id=<?= $service['id']; ?>" class="order-btn">Order Now</a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No services available at the moment.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Products Section (same as before) -->
        <section id="products" class="products">
            <h2>Our Products</h2>
            <div class="products-grid">
                <?php if ($products_result->num_rows > 0): ?>
                    <?php while($product = $products_result->fetch_assoc()): ?>
                        <div class="product-item">
                            <img src="<?= $product['image']; ?>" alt="<?= $product['name']; ?>">
                            <h3><i class="<?= $product['icon']; ?>"></i> <?= $product['name']; ?></h3>
                            <p><?= $product['description']; ?></p>
                            <p><strong>Price:</strong> $<?= $product['price']; ?></p>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No products available at the moment.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Contact Section with Form -->
        <section id="contact" class="contact">
            <h2>Contact Us</h2>
            <div class="contact-container">
                <form action="#contact" method="POST">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required><br><br>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br><br>

                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required></textarea><br><br>

                    <button type="submit" name="contact_submit">Send Message</button>
                </form>

                <?php if (isset($contact_success)): ?>
                    <p class="success"><?= $contact_success; ?></p>
                <?php elseif (isset($contact_error)): ?>
                    <p class="error"><?= $contact_error; ?></p>
                <?php endif; ?>
            </div>
        </section>
    </section>

    <footer>
        <p>&copy; 2024 CircuitEdge Ltd. All rights reserved.</p>
    </footer>
</body>
</html>

<?php $conn->close(); ?>
