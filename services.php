<?php
// Connect to database
$conn = new mysqli($host, $user, $pass, $dbname);

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve services
$services = $conn->query("SELECT * FROM services");

// Close connection
$conn->close();
?>

<section id="services">
    <h2>Our Services</h2>
    <div class="services-container">
        <?php while ($service = $services->fetch_assoc()): ?>
        <div class="service">
            <h3><?= $service['service_name']; ?></h3>
            <p><?= $service['description']; ?></p>
            <p>Price: $<?= $service['price']; ?></p>
            <a href="order.php?service_id=<?= $service['id']; ?>" class="order-btn">Order Now</a>
        </div>
        <?php endwhile; ?>
    </div>
</section>
