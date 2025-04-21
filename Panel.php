<?php
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.php');
    exit;
}


$hostname = "localhost"; 
$username = "root";  
$password = "";  
$database = "flight";  

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, username, email FROM users";  
$result = $conn->query($sql);

$sql_notifications = "SELECT message, created_at FROM notifications ORDER BY created_at DESC";
$result_notifications = $conn->query($sql_notifications);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles3.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="sidebar-header">Admin</div>
            <ul class="sidebar-menu">
                <li><a href="#users" class="active">Users</a></li>
                <li><a href="#notifications">Notifications</a></li>
                <li><a href="#flights">Flights and Destinations</a></li>
            </ul>
        </div>
        <div class="main-content">
            <nav class="navbar">
                <form class="search-form" action="#" method="GET">
                    <input type="text" placeholder="Search..." name="search">
                    <button type="submit">Search</button>
                </form>
                <a href="logout.php" class="logout">Logout</a>
            </nav>
            <div class="content">


                <div id="users" class="tab-content active">
                    <h2>Users</h2>
                    <p>Manage your users here.</p>
                    
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No users found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div id="notifications" class="tab-content">
                    <h2>Notifications</h2>
                    <p>Recent notifications for the admin:</p>
                    
                    <ul>
                        <?php
                        if ($result_notifications->num_rows > 0) {
                            while ($notification = $result_notifications->fetch_assoc()) {
                                echo "<li>";
                                echo htmlspecialchars($notification['message']) . " <small>(" . htmlspecialchars($notification['created_at']) . ")</small>";
                                echo "</li>";
                            }
                        } else {
                            echo "<li>No notifications found.</li>";
                        }
                        ?>
                    </ul>
                </div>

                <div id="flights" class="tab-content">
                    <h2>Flights</h2>
                    <p> Flights and destinations go here: .</p>
                    
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.sidebar-menu a').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                });

                const activeTab = this.getAttribute('href').substring(1);
                document.getElementById(activeTab).classList.add('active');

                document.querySelectorAll('.sidebar-menu a').forEach(link => {
                    link.classList.remove('active');
                });

                this.classList.add('active');
            });
        });
    </script>
</body>
</html>

<?php

$conn->close();
?>