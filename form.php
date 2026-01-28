<?php
// connect to database
$conn = mysqli_connect("localhost", "root", "", "testdb");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// check request method
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request method");
}

// get form data
$passenger_name = $_POST['passenger_name'] ?? '';
$address        = $_POST['address'] ?? '';
$gender         = $_POST['gender'] ?? '';
$contact        = $_POST['contact_number'] ?? '';
$destination    = $_POST['destination'] ?? '';
$date           = $_POST['date_of_travel'] ?? '';
$tickets        = $_POST['number_of_tickets'] ?? '';
$type           = $_POST['type'] ?? '';
$payment        = $_POST['payment_method'] ?? '';

// insert query (column names have spaces → use backticks)
$sql = "INSERT INTO form
(`passenger name`, `address`, `gender`, `contact number`, `destination`, `date`, `no.of tickets`, `type`, `payment method`)
VALUES
('$passenger_name', '$address', '$gender', '$contact', '$destination', '$date', '$tickets', '$type', '$payment')";

if (mysqli_query($conn, $sql)) {
    echo "<h2>Ticket booked successfully!</h2>";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
