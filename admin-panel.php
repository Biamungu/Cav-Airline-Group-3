<?php
session_start();  // Start the session at the very beginning

// Check if the user is logged in and is an admin



$conn = new mysqli("localhost", "root", "", "flight");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update booking status
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $booking_id = $_POST['booking_id'];
    $payment_status = $_POST['payment_status'];
    $booking_status = $_POST['booking_status'];

    // Sanitize the input to avoid SQL injection
    $stmt = $conn->prepare("UPDATE bookings SET payment_status = ?, booking_status = ? WHERE booking_id = ?");
    $stmt->bind_param("ssi", $payment_status, $booking_status, $booking_id);
    if ($stmt->execute()) {
        $message = "Booking updated successfully!";
    } else {
        $message = "Failed to update booking.";
    }
    $stmt->close();
}

// Delete booking
if (isset($_POST['delete'])) {
    $booking_id = $_POST['booking_id'];
    if ($conn->query("DELETE FROM bookings WHERE booking_id = $booking_id")) {
        $message = "Booking deleted successfully!";
    } else {
        $message = "Failed to delete booking.";
    }
}

// Fetch bookings
$result = $conn->query("SELECT b.*, u.first_name FROM bookings b JOIN users u ON b.user_id = u.user_id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Manage Bookings</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<h2>Admin Panel - Booking Management</h2>
<nav>
        <a href="index.php">Back to Home</a>
      </nav>

<?php if (isset($message)): ?>
    <div class="message"><?php echo $message; ?></div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
<?php endif; ?>

<table>
    <tr>
        <th>Booking ID</th>
        <th>User</th>
        <th>Date</th>
        <th>Total</th>
        <th>Payment</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <form method="POST">
            <td><?php echo $row['booking_id']; ?></td>
            <td><?php echo htmlspecialchars($row['first_name']); ?></td>
            <td><?php echo $row['booking_date']; ?></td>
            <td>$<?php echo $row['total_amount']; ?></td>
            <td>
                <select name="payment_status">
                    <?php foreach (['pending','paid','refunded','cancelled'] as $status): ?>
                        <option value="<?php echo $status; ?>" <?php if ($row['payment_status'] == $status) echo 'selected'; ?>>
                            <?php echo ucfirst($status); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <select name="booking_status">
                    <?php foreach (['confirmed','cancelled','completed'] as $status): ?>
                        <option value="<?php echo $status; ?>" <?php if ($row['booking_status'] == $status) echo 'selected'; ?>>
                            <?php echo ucfirst($status); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td class="actions">
                <input type="hidden" name="booking_id" value="<?php echo $row['booking_id']; ?>">
                <button type="submit" name="update">Update</button>
                <button type="submit" name="delete" onclick="return confirm('Are you sure?')">Delete</button>
            </td>
        </form>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
