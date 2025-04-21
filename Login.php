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

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password_hash'])) {
            // After verifying login credentials:
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['first_name'];
            $_SESSION['is_admin'] = $user['is_admin'];  // Store the admin status

            // Redirect based on admin status
            if ($_SESSION['is_admin'] == 1) {
                header("Location: index.php");  // Redirect to admin dashboard
            } else {
                header("Location: index.php"); // Redirect to user homepage or dashboard
            }
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eef2f7;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .form-container {
      background: white;
      padding: 25px 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      width: 350px;
      text-align: center;
    }
    h2 {
      text-align: center;
      color: #007bff;
    }
    .error {
      text-align: center;
      color: red;
      margin-bottom: 10px;
    }
    form {
      display: flex;
      flex-direction: column;
    }
    label {
      margin-top: 10px;
    }
    input {
      padding: 8px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    button {
      margin-top: 15px;
      padding: 10px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background-color: #0056b3;
    }
    .button_l, .logout-btn {
      display: inline-block;
      margin: 5px;
      padding: 10px 15px;
      text-decoration: none;
      color: white;
      background-color: #007bff;
      border-radius: 5px;
    }
    .button_l:hover, .logout-btn:hover {
      background-color: #0056b3;
    }
    .auth-buttons {
      margin-top: 15px;
    }
  </style>
</head>
<body>

<div class="form-container">
  <h2>Login</h2>

  <?php if ($error): ?>
    <div class="error"><?php echo $error; ?></div>
  <?php endif; ?>

  <?php if(!isset($_SESSION['user_id'])): ?>
    <form method="POST" action="">
      <label>Email</label>
      <input type="email" name="email" required>

      <label>Password</label>
      <input type="password" name="password" required>

      <button type="submit">Login</button>
    </form>
  <?php else: ?>
    <p>You are already logged in as <?php echo $_SESSION['username']; ?></p>
    <div class="auth-buttons">
      <a href="logout.php" class="logout-btn">Log Out</a>
    </div>
  <?php endif; ?>

  <?php if(!isset($_SESSION['user_id'])): ?>
    <div class="auth-buttons">
      <p>Don't have an account?</p>
      <a href="create-account.php" class="button_l">Create Account</a>
    </div>
  <?php endif; ?>
</div>

</body>
</html>