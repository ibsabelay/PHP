<?php
session_start(); // Start the session

// Check if the user is already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // User is already logged in, redirect to home page or dashboard
    header("Location: home.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform login validation
    $username = "admin";
    $password = "password";

    $input_username = $_POST["username"];
    $input_password = $_POST["password"];

    if ($input_username == $username && $input_password == $password) {
        // Login successful, set session variables
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;

        // Redirect to home page or dashboard
        header("Location: home.php");
        exit;
    } else {
        // Login failed
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
