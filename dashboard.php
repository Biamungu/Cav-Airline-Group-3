<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$database = "flight";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Please login to view your bookings.");
}

$user_id = $_SESSION['user_id'];

// Modified query to filter by logged-in user
$sql = "SELECT booking_id, user_id, booking_date, total_amount, payment_status, booking_status 
        FROM bookings 
        WHERE user_id = ?
        ORDER BY booking_date DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id); // "i" for integer type
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Bookings</title>
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

        th,
        td {
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

        .status-confirmed {
            color: green;
        }

        .status-cancelled {
            color: red;
        }

        .status-completed {
            color: blue;
        }

        .payment-paid {
            color: green;
        }

        .payment-pending {
            color: orange;
        }

        .payment-refunded {
            color: red;
        }

        .payment-cancelled {
            color: gray;
        }
    </style>
</head>

<body>

    <h1>My Flight Bookings</h1>

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
                    <td><?= htmlspecialchars($row['booking_id']) ?></td>
                    <td><?= htmlspecialchars($row['user_id']) ?></td>
                    <td><?= htmlspecialchars($row['booking_date']) ?></td>
                    <td><?= number_format($row['total_amount'], 2) ?></td>
                    <td class="payment-<?= strtolower(htmlspecialchars($row['payment_status'])) ?>">
                        <?= ucfirst(htmlspecialchars($row['payment_status'])) ?>
                    </td>
                    <td class="status-<?= strtolower(htmlspecialchars($row['booking_status'])) ?>">
                        <?= ucfirst(htmlspecialchars($row['booking_status'])) ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p style="text-align: center;">No bookings found.</p>
    <?php endif; ?>

</body>

</html>

<?php
$stmt->close();
$conn->close();
?>