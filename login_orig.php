<?php
//including the database connection file
include_once("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Simple validation (you can add more as needed)
    if (!empty($email) && !empty($password)) {
        
        $result = $conn->query("SELECT user_id, name, password FROM users WHERE email = '$email'");

        if ($result->num_rows > 0) {
            
            $row = $result->fetch_assoc();
            // if (password_verify($password, $row['password'])) {
            if ($password== $row['password']) {
                $_SESSION["user_id"] = $row['id'];
                $name = $row['name'];
                echo "<script>alert('Login successful! Welcome ".$name."');</script>";
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "No user found with that email.";
        }
    } else {
        echo "<p>Please fill in all fields.</p>";
    }
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #595e60;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-container {
      background: #DDFFF7;
      padding: 30px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      border-radius: 10px;
      width: 300px;
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    input[type="email"],
    input[type="password"] {
      width: 95%;
      padding: 10px;
      margin: 5px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    button {
      width: 100%;
      padding: 10px;
      background: #231B1B;
      color: white;
      border: none;
      border-radius: 5px;
      margin-top: 10px;
      cursor: pointer;
    }
    button:hover {
      background: #0056b3;
    }
    .link {
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <form method="POST" action="">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Log In</button>
    </form>
    <div class="link">
      <a href="/register">Don't have an account? Sign up</a>
    </div>
  </div>
</body>
</html>
