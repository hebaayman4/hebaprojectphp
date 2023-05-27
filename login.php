<?php
session_start();
include('db.php');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $hashedPassword = md5($_POST["password"]); 
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$hashedPassword'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      
        $row = mysqli_fetch_assoc($result);
        $_SESSION["id"] = $row["id"];
        $_SESSION["name"] = $row["name"];

     
        if ($row['role'] == 1) {
            header('location:data.php');
        } else {
            header('location:users.php');
        }
        exit();
    } else {
        $error = "not found email or password:)";
    }

  
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  
<div class="header">
    <h2>Login</h2>
</div>
<form method="post">
    <div class="input-group">
        <label>Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="input-group">
        <label>Password:</label>
        <input type="password" id="password" name="password" required>    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="login_user">LOGIN</button>
    </div>
    <p>
    You don't already have an account? <a href="register.php">Register</a>
    </p>

    <?php
        if (isset($error)) {
            echo "<p style='color:black; text-align:center; border: 1px solid #ccc;padding:20px;  background-color: red;'>$error</p>";
        }
    ?>
</form>

</body>
</html>
