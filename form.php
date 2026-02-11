<?php
// Connect to database
$conn = mysqli_connect("localhost", "root", "", "testdb");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check request method
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request method");
}

// Get form data safely
$passenger_name = $_POST['passenger_name'] ?? '';
$address        = $_POST['address'] ?? '';
$gender         = $_POST['gender'] ?? '';
$contact        = $_POST['contact_number'] ?? '';
$destination    = $_POST['destination'] ?? '';
$date           = $_POST['date_of_travel'] ?? '';
$tickets        = $_POST['number_of_tickets'] ?? '';
$type           = $_POST['type'] ?? '';
$payment        = $_POST['payment_method'] ?? '';

// Check if file is uploaded
if (!isset($_FILES['upload_file']) || $_FILES['upload_file']['error'] !== 0) {
    die("Please select a file to upload.");
}

$uploadDir = "uploads/";

// Create uploads folder if not exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$fileName  = $_FILES['upload_file']['name'];
$tmpName   = $_FILES['upload_file']['tmp_name'];
$fileSize  = $_FILES['upload_file']['size'];
$fileExt   = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

$allowed = ['jpg', 'jpeg', 'png', 'pdf'];

if (!in_array($fileExt, $allowed)) {
    die("Invalid file type. Only JPG, JPEG, PNG, PDF allowed.");
}

if ($fileSize > 5000000) {
    die("File is too large (Max 5MB).");
}

$newFileName = uniqid("FILE_", true) . "." . $fileExt;
$fileDestination = $uploadDir . $newFileName;

if (!move_uploaded_file($tmpName, $fileDestination)) {
    die("Failed to upload file.");
}

// Use prepared statement (SECURE)
$stmt = $conn->prepare("INSERT INTO form 
(`passenger name`, `address`, `gender`, `contact number`, `destination`, `date`, `no.of tickets`, `type`, `payment method`, `file`) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssssssss",
    $passenger_name,
    $address,
    $gender,
    $contact,
    $destination,
    $date,
    $tickets,
    $type,
    $payment,
    $newFileName
);

if ($stmt->execute()) {
    echo "<h2>Ticket booked successfully!</h2>";
} else {
    echo "Database Error: " . $stmt->error;
}

$stmt->close();
mysqli_close($conn);
?>
