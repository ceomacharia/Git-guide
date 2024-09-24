<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process order form submission
    $service_id = $_POST['service_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Insert order into database (Assuming you have an orders table)
    $conn = new mysqli($host, $user, $pass, $db);
    $sql = "INSERT INTO orders (service_id, name, email, message) VALUES ('$service_id', '$name', '$email', '$message')";
    $conn->query($sql);

    echo "Your order has been received! Thank you!";
    $conn->close();
} else {
    $service_id = $_GET['service_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Service</title>
</head>
<body>
    <h1>Order Service</h1>
    <form action="order.php" method="POST">
        <input type="hidden" name="service_id" value="<?= $service_id; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="message">Additional Information:</label>
        <textarea id="message" name="message" required></textarea><br><br>
        
        <button type="submit">Submit Order</button>
    </form>
</body>
</html>
