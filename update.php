<?php
// Database connection code
include('db.php');

// Check if user ID is provided in the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Retrieve user data from the database
    $query = "SELECT * FROM users WHERE id = '{$user_id}'";
    $result = $conn->query($query);

    // Check if the query was successful
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit;
    }
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];

    // Check if the password matches the confirm password
    if ($password !== $confirmPassword) {
        echo " validation your password please";
        exit;
    }

    // Sanitize the input data to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Update the user's data in the database
    $sql = "UPDATE users SET name='$name', email='$email', password='$password' WHERE id=$user_id";

    if (mysqli_query($conn, $sql)) {
        $_SESSION["name"] = $name;
        header('Location: users.php');
        exit;
    } else {
        echo "Error updating user data: " . mysqli_error($conn);
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Edit Register</h2>
    </div>

    <form method="post">
        <div class="input-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($user['email']); ?>">
        </div>

        <div class="input-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($user['name']); ?>">
        </div>

        <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required value="<?php echo htmlspecialchars($user['password']); ?>">
        </div>

        <div class="input-group">
            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm-password" required value="<?php echo htmlspecialchars($user['password']); ?>">
        </div>

        <div class="input-group">
            <button type="submit" class="btn" name="reg_user">Register</button>
        </div>

        <p>
            Already a member? <a href="login.php">Sign in</a>
        </p>
    </form>
</body>
</html>
