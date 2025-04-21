<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "flight";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to book.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from = $conn->real_escape_string($_POST['from']);
    $to = $conn->real_escape_string($_POST['to']);
    $depart = $conn->real_escape_string($_POST['depart']);
    $return = $conn->real_escape_string($_POST['return']);
    $adults = (int)$_POST['adult'];
    $children = (int)$_POST['child'];
    $infants = (int)$_POST['infant'];

    $price_per_adult = 100;
    $price_per_child = 50;
    $price_per_infant = 25;
    $total_amount = ($adults * $price_per_adult) + ($children * $price_per_child) + ($infants * $price_per_infant);

    $user_id = $_SESSION['user_id'];
    $sql = "INSERT INTO bookings (user_id, booking_date, total_amount, payment_status, booking_status)
            VALUES ('$user_id', NOW(), '$total_amount', 'pending', 'confirmed')";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>