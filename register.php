<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
    <h2>Register</h2>
</div>

<form method="post">
    <div class="input-group">
    <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>

	<div class="input-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div class="input-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div class="input-group">
        <label for="confirm-password">Confirm Password:</label>
        <input type="password" id="confirm-password" name="confirm-password" required>
    </div>

    <div class="input-group">
        <label for="isAdmin">Admin or User ?</label>
        <select class="form-control" name="isAdmin" id="isAdmin">
        <option value="1">User</option>
        <option value="2">Admin</option>
          
        </select>
    </div>

    <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Register</button>
    </div>
    <p>
    Are you already a member? <a href="login.php">Sign in</a>
    </p>
</form>



<?php

include('db.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];
    $role = $_POST['isAdmin'];

 
    if ($password !== $confirmPassword) {
        echo "Verify the password please";
    } else {
      
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $hashedPassword = md5($password); 

 
        $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashedPassword', '$role')";
        if (mysqli_query($conn, $sql)) {
           
            $id = mysqli_insert_id($conn);

            $_SESSION["id"] = $id;
            $_SESSION["name"] = $name;
           
            echo "<p style='color:green; text-align:center'>Registration successful!</p>";
            if ($role == 1) {
                header('location:data.php');
            } else {
                header('location:users.php');
              }
          } else {
              echo "Error: " . mysqli_error($conn);
          }
      }
  }
  
 
  mysqli_close($conn);
  ?>
  
  </body>
  </html>
  
