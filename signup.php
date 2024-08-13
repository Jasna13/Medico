<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Medico Online Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sign-up-container">
        <h2>Create Your Account</h2>
        <form action=" " method="post">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="phone_number">Phone Number</label>
                <input type="number" id="phone_number" name="phone_number" min="600000000" max="9999999999" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="sign-up-button">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.html">Login here</a></p>
    </div>
</body>
</html>
<?php
// Connect to the database
$servername = "localhost";
$username = "root";  // Replace with your database username
$password = "root";      // Replace with your database password
$dbname = "medico_shop";  // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    echo "Connected successfully";
}

if (isset($_POST['submit'])) {
    $user_name = $_POST['username'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    echo "sucessful";

    // Validate the form data
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    } elseif (!preg_match('/^[0-9]{10}$/', $phone_number)) {
        echo "Invalid phone number.";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (username, email, phone_number, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $user_name, $email, $phone_number, $hashed_password);

        // Execute the query
        if ($stmt->execute()) {
            echo "Registration successful!";
        } 
        else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the connection
$conn->close();
?>

