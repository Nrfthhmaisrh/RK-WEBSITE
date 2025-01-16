<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Ruwe Kopi</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <div class="signup-container">
    <img src="Picture/logo.jpg" class="logo" alt="Ruwe Kopi Logo">
    <h1>Create Account</h1>
    <p>Sign up to explore Ruwe Kopi.</p>
    <form action="signup-process.php" method="POST">
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-group">
            <i class="fas fa-phone"></i>
            <input type="tel" name="phone_number" placeholder="Phone Number" required pattern="^[0-9]{10,15}$" title="Phone number should be 10 to 15 digits">
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        </div>
        <button type="submit" class="btn">Sign Up</button>
    </form>
    <p class="login-link">Already Have An Account? <a href="login.html">Login Here</a></p>
</div>
<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate input
    if ($password !== $confirm_password) {
        die("Passwords do not match!");
    }

    // Hash the password (for security)
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'ruwe_kopi');

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the users table
    $sql = "INSERT INTO users (full_name, phone_number, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $full_name, $phone_number, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful! <a href='login.html'>Login here</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
