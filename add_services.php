<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service</title>
</head>
<body>
    <h2>Add New Service</h2>
    <form action="add_service.php" method="POST">
        <div>
            <label for="service_name">Service Name:</label>
            <input type="text" id="service_name" name="service_name" required>
        </div>
        <div>
            <label for="service_description">Service Description:</label>
            <textarea id="service_description" name="service_description" rows="4" required></textarea>
        </div>
        <div>
            <label for="service_icon">Service Icon (FontAwesome class):</label>
            <input type="text" id="service_icon" name="service_icon" required>
        </div>
        <div>
            <button type="submit">Add Service</button>
        </div>
    </form>
</body>
</html>

<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_name = $_POST['service_name'];
    $service_description = $_POST['service_description'];
    $service_icon = $_POST['service_icon'];

    $sql = "INSERT INTO services (service_name, service_description, service_icon) VALUES ('$service_name', '$service_description', '$service_icon')";

    if ($conn->query($sql) === TRUE) {
        echo "New service added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
