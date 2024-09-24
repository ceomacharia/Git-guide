<?php
// Session check for admin
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$host = 'localhost';
$user = 'root';
$pass = ''; 
$dbname = 'circuitedge';

// Connect to database
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add service logic
if (isset($_POST['add_service'])) {
    $service_name = $_POST['service_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("INSERT INTO services (service_name, description, price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $service_name, $description, $price);

    if ($stmt->execute()) {
        echo "Service added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}

// Fetch services
$services = $conn->query("SELECT * FROM services");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services</title>
</head>
<body>
    <h2>Add New Service</h2>
    <form method="POST" action="manage_services.php">
        <label for="service_name">Service Name:</label>
        <input type="text" id="service_name" name="service_name" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required><br><br>

        <button type="submit" name="add_service">Add Service</button>
    </form>

    <h2>Available Services</h2>
    <table>
        <thead>
            <tr>
                <th>Service Name</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($service = $services->fetch_assoc()): ?>
            <tr>
                <td><?= $service['service_name']; ?></td>
                <td><?= $service['description']; ?></td>
                <td>$<?= $service['price']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
