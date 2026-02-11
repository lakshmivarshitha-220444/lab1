<?php

$conn = mysqli_connect("localhost", "root", "", "testdb");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request method");
}



$passenger_name = trim($_POST['passenger_name'] ?? '');
$address        = trim($_POST['address'] ?? '');
$gender         = trim($_POST['gender'] ?? '');
$contact        = trim($_POST['contact_number'] ?? '');
$destination    = trim($_POST['destination'] ?? '');
$date           = trim($_POST['date_of_travel'] ?? '');
$tickets        = trim($_POST['number_of_tickets'] ?? '');
$type           = trim($_POST['type'] ?? '');
$payment        = trim($_POST['payment_method'] ?? '');

/* ===== Security Cleaning ===== */
$passenger_name = htmlspecialchars($passenger_name);
$address        = htmlspecialchars($address);
$destination    = htmlspecialchars($destination);

/* ===== Formatting ===== */
$passenger_name = ucwords(strtolower($passenger_name));
$destination    = ucfirst(strtolower($destination));

/* ===== Validation ===== */
if (strlen($passenger_name) < 3) {
    die("Passenger name must be at least 3 characters");
}

if (strlen($contact) < 10) {
    die("Contact number must be at least 10 digits");
}

if ($tickets <= 0) {
    die("Number of tickets must be greater than zero");
}

/* ===== Insert Query ===== */
$sql = "INSERT INTO form
(passenger_name, address, gender, contact_number, destination, date_of_travel, number_of_tickets, type, payment_method)
VALUES
('$passenger_name', '$address', '$gender', '$contact', '$destination', '$date', '$tickets', '$type', '$payment')";

if (mysqli_query($conn, $sql)) {
    echo "<h2>Ticket Booked Successfully!</h2>";
    print "Passenger Name: $passenger_name <br>";
    print "Destination: $destination <br>";
    print "Tickets: $tickets <br>";
} else {
    die("Database Error: " . mysqli_error($conn));
}

mysqli_close($conn);
?>