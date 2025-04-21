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
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f4f8;
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
    }
    h2 {
      text-align: center;
      color: #007bff;
      margin-bottom: 20px;
    }
    .message {
      text-align: center;
      color: green;
      margin-bottom: 15px;
      padding: 10px;
      background-color: #e6ffed;
      border-radius: 5px;
    }
    .error {
      text-align: center;
      color: red;
      margin-bottom: 15px;
      padding: 10px;
      background-color: #ffebee;
      border-radius: 5px;
    }
    form {
      display: flex;
      flex-direction: column;
    }
    label {
      margin-top: 10px;
      font-weight: bold;
      color: #555;
    }
    input {
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ddd;
      font-size: 16px;
    }
    input:focus {
      border-color: #007bff;
      outline: none;
      box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
    }
    button {
      margin-top: 20px;
      padding: 12px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
      transition: background-color 0.3s;
    }
    button:hover {
      background-color: #0069d9;
    }
    .login-link {
      text-align: center;
      margin-top: 15px;
    }
    .login-link a {
      color: #007bff;
      text-decoration: none;
    }
    .login-link a:hover {
      text-decoration: underline;
    }
  </style>
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
