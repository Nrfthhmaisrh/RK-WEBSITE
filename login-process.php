<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ruwe Kopi</title>

    <form action="login-process.php" method="POST">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #faf3e0;
            color: #4a3f35;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            width: 350px;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        .login-container h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: #4a3f35;
            margin-bottom: 20px;
        }

        .login-container p {
            font-size: 0.95rem;
            color: #6e5d52;
            margin-bottom: 30px;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center; /* Ensures vertical alignment */
            gap: 10px; /* Adds space between the icon and input field */
        }

        .input-group i {
            margin-left: 5px; /* Adjusts the icon's spacing */
            color: #bca99b;
        }

        .input-group input {
            flex-grow: 1; /* Ensures input takes up available space */
            padding: 12px 15px; /* Adjust input padding */
            padding-left: 45px; /* Avoids overlap with the icon */
            border: 1px solid #d3b8a3;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #fef5e7;
            color: #4a3f35;
        }

        .input-group input:focus {
            outline: none;
            border-color: #6e5d52;
        }

        .btn {
            background-color: #4a3f35;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn:hover {
            background-color: #6e5d52;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .signup-link {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #6e5d52;
        }

        .signup-link a {
            text-decoration: none;
            color: #4a3f35;
            font-weight: 600;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .logo {
            width: 150px; /* Increased size */
            height: auto;
            margin-bottom: 20px;
            border-radius: 12px; /* Optional: Adds a slight rounded edge */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); /* Adds depth */
        }
    </style>
</head>
<body>

<div class="login-container">
    <img src="Picture/logo.jpg" class="logo" alt="Ruwe Kopi Logo">
    <h1>Welcome Back</h1>
    <p>Log in to continue enjoying Ruwe Kopi.</p>
    <form action="login-process.php" method="POST">
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn">Login</button>
    </form>
    <p class="signup-link">Don't Have An Account? <a href="register.html">Sign Up Here</a></p>
</div>

</body>
</html>
<?php
// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Database credentials
    $servername = "localhost";
    $username_db = "root"; // Default username for XAMPP/WAMP
    $password_db = ""; // Default password for XAMPP/WAMP
    $dbname = "ruwe_kopi";

    // Create a database connection
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to check if the username exists
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user data
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Store user information in the session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to the dashboard or homepage
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Username does not exist.";
    }

    // Close the connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
