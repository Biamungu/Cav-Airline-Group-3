<?php
session_start(); // Start session at the beginning

$servername = "localhost"; 
$username = "root";  
$password = "";  
$database = "flight"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the email already exists
    $sql_check = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql_check);
    if ($result->num_rows > 0) {
        $error = "Email already exists!";
    } else {
        $sql = "INSERT INTO users (first_name, email, password_hash) VALUES ('$username', '$email', '$password_hash')";

        if ($conn->query($sql) === TRUE) {
            // Get the newly created user's ID
            $user_id = $conn->insert_id;

            // Assume a new user is not an admin; you can change this logic later to implement admin roles
            $is_admin = 0; // Set to 1 if the user should be an admin

            // Set session variables
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['is_admin'] = $is_admin; // Store admin status
            
            $success = "Account created successfully!";
            header("Location: index.php"); // Redirect to the main page
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Account</title>
  <link rel="stylesheet" href="create-account.css">
</head>
<body>

<div class="form-container">
  <h2>Create Account</h2>

  <?php if ($success): ?>
    <div class="message"><?php echo $success; ?></div>
  <?php endif; ?>

  <?php if ($error): ?>
    <div class="error"><?php echo $error; ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <label>Username</label>
    <input type="text" name="username" required minlength="3" maxlength="50">

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Password</label>
    <input type="password" name="password" required minlength="8">

    <button type="submit">Register</button>
    
    <div class="login-link">
      Already have an account? <a href="Login.php">Login here</a>
    </div>
  </form>
</div>

</body>
</html>
