<?php
session_start();
include('db.php');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color:  #2c073a;

      
    }
    
    .container {
      width: 1200px;
      height: 500px;
    
      margin: 40px auto;
      background-color:  #ca9fd9;

      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    .container h2 {
      text-align: center;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
    
    }
    
    
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    
    th {
        background-color: #2c073a;
        color: white;
    }
    
    .btn {
      padding: 6px 12px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    
    .btn.edit {
        background-color: orange;
    margin: 0 10px;      
    text-decoration: none;

    }
    
    .btn.delete {
      background-color: green;
      text-decoration: none;
    }

    header {
        display: flex;
    justify-content: space-between;
    align-items: center;
    }

    .logout {
        background-color:red;
        color: white;
        border: none;
        font-size: 18px;
        cursor: pointer;
    }

    .info{
        display: flex;
        align-items: center;
    }
   
  </style>
</head>
<body>
  <div class="container">
    <header>
    <h2> Tabel Of All User</h2>
    <div class="info">
 
        <form method="post">
        <input class="logout" type="submit" name="Logout" value="Logout">
        </form>
    </div>

    </header>

    <table>
      <tr>
        <th>Email</th>
        <th>Name</th>
        <th>Actions</th>
      </tr>

      <?php
  
      $sql = "SELECT id, email, name FROM users";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
      
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . $row['email'] . "</td>";
              echo "<td>" . $row['name'] . "</td>";
              echo "<td>";
              echo "<a href='update.php?id=$row[id]' class='btn edit'>Update</a>";
              echo "<a href='delete.php?id=$row[id]' class='btn delete'>Delete</a>";
              echo "</td>";
              echo "</tr>";




          }
      } else {
          echo "<tr><td colspan='3'>Not found record</td></tr>";
      }

      
      mysqli_free_result($result);

      mysqli_close($conn);
      ?>

      <?php
      if(isset($_POST['Logout'])){
        session_unset();
        session_destroy();
        header('location:register.php');
      }
      ?>
      
    </table>
  </div>
</body>
</html>
