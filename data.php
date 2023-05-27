<!DOCTYPE html>
<html>
<head>
    <title>User data</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color:#8a5f79;
        }
        
        h2 {
            color: #333;
    font-size: 24px;
    margin-bottom: 30px;
    text-align: left;
    
    border: 1px solid #ccc;
    
        }
        h2{
            background-color: #2c073a;    
            color: white;
            padding: 10px;
        }
        
        a {
      padding: 6px 12px;
      background-color: green;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
        margin: 0 10px;      
        text-decoration: none;
        display: block;
        text-align: center;
        width:60px;
        
        }

        header {
            margin-top:20px;
        display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 6px 12px;
   
    }

    .logout {
        background-color: red;
        padding: 10px;
        border-radius: 4px;
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

    <?php
    session_start();
   
    include("db.php");

    $id =$_SESSION['id'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT * FROM users Where id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
       
        while ($row = $result->fetch_assoc()) {
            echo "<h2>Name: " . $row["name"] . "</h2>";
            echo "<h2>Email: " . $row["email"] . "</h2>";
            echo "<a href='updateuser.php?id=$row[id]'>Update</a>";
        }

    } else {
        echo "No results found.";
    }

   
    $conn->close();
    ?>

<header>
   
    <div class="info">
        <form method="post">
        <input class="logout" type="submit" name="Logout" value="Logout">
        </form>
    </div>

    </header>

    <?php
        if(isset($_POST['Logout'])){
            session_unset();
            session_destroy();
            header('location:register.php');
        }
        ?>



</body>
</html>