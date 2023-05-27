<?php

include('db.php');


if(isset($_GET['id'])) {
    $user_id = $_GET['id'];

   
    $query = "SELECT * FROM users WHERE id = '{$user_id}'";
    $result = $conn->query($query);


    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  

  <div class="form-container">
    <h1>Welcome to the Register Page to Edit</h1>
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
        <button type="submit" class="btn" name="reg_user">Register</button>
      </div>  
      
      <p>
      Are you already a member?? <a href="login.php">Sign in</a>
      </p>
    </form>
  </div>

  <?php
 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $_POST["name"];
      $email = $_POST["email"];
      $password = $_POST["password"];
      $confirmPassword = $_POST["confirm-password"];

      
      if ($password !== $confirmPassword) {
          echo "Error: Passwords do not match.";
      } else {
         
          $name = mysqli_real_escape_string($conn, $name);
          $email = mysqli_real_escape_string($conn, $email);
          $password = mysqli_real_escape_string($conn, $password);

          $sql = "UPDATE users SET name='$name', email='$email', password='$password' WHERE id='$user_id'";

          if (mysqli_query($conn, $sql)) {
              $_SESSION["name"] = $name;
              echo "<p style='color:green; text-align:center'>Registration successful!</p>";
              header('location:data.php');
          } else {
              echo "Error: " . mysqli_error($conn);
          }
      }
  }

  
  mysqli_close($conn);
  ?>

</body>
</html>