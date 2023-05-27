<?php
include('db.php');

if(isset($_GET['id'])) {
    $user_id = $_GET['id'];
    
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    
    if($stmt->affected_rows > 0) {
        header('Location: users.php');
        exit();
    } else {
        echo "Failed to delete user.";
    }
    
    $stmt->close();
} else {
    echo "<p style='color:black; text-align:center; border: 1px solid #ccc;padding:20px;  background-color: #2c073a;color:white;width:150px'>INVALID ID :(</p>";
}

$conn->close();
?>