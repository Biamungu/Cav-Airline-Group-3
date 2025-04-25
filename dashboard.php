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

// Get user's name
$user_sql = "SELECT first_name, last_name FROM users WHERE user_id = ?";
$user_stmt = $conn->prepare($user_sql);
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();
$user = $user_result->fetch_assoc();
$user_name = htmlspecialchars($user['first_name'] . ' ' . $user['last_name']);
$user_stmt->close();

// Get bookings
$sql = "SELECT booking_id, user_id, booking_date, total_amount, payment_status, booking_status 
        FROM bookings 
        WHERE user_id = ?
        ORDER BY booking_date DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Bookings</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        /* Additional styles for this page */
        .user-greeting {
            text-align: center;
            color: #ffd700;
            margin-bottom: 20px;
            font-size: 1.2em;
        }
        
        nav {
            text-align: center;
            margin: 20px 0;
        }
        
        nav a {
            display: inline-block;
            padding: 8px 20px;
            background-color: #000000;
            color: #ffd700;
            text-decoration: none;
            border: 1px solid #ffd700;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        
        nav a:hover {
            background-color: #ffd700;
            color: #000000;
        }
    </style>
</head>

<body>

    <h1>My Flight Bookings</h1>
    
    <div class="user-greeting">
        Welcome, <?php echo $user_name; ?>
    </div>
    
    <nav>
        <a href="index.php">Back to Home</a>
    </nav>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Booking ID</th>
                <th>Passenger Name</th>
                <th>Date</th>
                <th>Total Amount ($)</th>
                <th>Payment Status</th>
                <th>Booking Status</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['booking_id']) ?></td>
                    <td><?= $user_name ?></td>
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