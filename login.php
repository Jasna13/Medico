<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Medico</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login to Your Account</h2>
        <form action="" method="post">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="login-button" name="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
    </div>
</body>
</html>
<?php
include("connection.php");
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Fetch the stored hashed password from the database
    $sql = "SELECT * FROM user WHERE email='$email' and password='$password'";
    $result = mysqli_query($con, $sql);
    $num=mysqli_num_rows($result);
    if($num>0){
        $s="SELECT * FROM user WHERE password='$password' and utype='user'";
        $rs=mysqli_query($con,$s);
        $n=mysqli_num_rows($result);
        if($n>0)
        {   
            header("location:index.html");
        }
        else{
            header("location:login.php");
        }
    }
    else{
        echo '<script>alert("email id or password is not matching")</script>';
    }
}
?>
