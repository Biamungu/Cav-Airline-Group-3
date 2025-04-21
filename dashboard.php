<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "flight";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Join with user table if you want username/email displayed too
$sql = "SELECT booking_id, user_id, booking_date, total_amount, payment_status, booking_status FROM bookings ORDER BY booking_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bookings Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            padding: 30px;
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status-confirmed { color: green; }
        .status-cancelled { color: red; }
        .status-completed { color: blue; }
        .payment-paid { color: green; }
        .payment-pending { color: orange; }
        .payment-refunded { color: red; }
        .payment-cancelled { color: gray; }
    </style>
</head>
<body>

<h1>Flight Bookings Dashboard</h1>

<?php if ($result->num_rows > 0): ?>
<table>
    <tr>
        <th>Booking ID</th>
        <th>User ID</th>
        <th>Date</th>
        <th>Total Amount ($)</th>
        <th>Payment Status</th>
        <th>Booking Status</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['booking_id'] ?></td>
        <td><?= $row['user_id'] ?></td>
        <td><?= $row['booking_date'] ?></td>
        <td><?= number_format($row['total_amount'], 2) ?></td>
        <td class="payment-<?= strtolower($row['payment_status']) ?>">
            <?= ucfirst($row['payment_status']) ?>
        </td>
        <td class="status-<?= strtolower($row['booking_status']) ?>">
            <?= ucfirst($row['booking_status']) ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<?php else: ?>
    <p style="text-align: center;">No bookings found.</p>
<?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
