<?php
session_start();
require_once "database.php"; // Database connection

// Redirect if already logged in
if (isset($_SESSION["user"])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!empty($username) && !empty($password)) {
        $sql = "SELECT * FROM login WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["user"] = $user["username"];
            header("Location: dashboard.php"); // Redirect to the dashboard
            exit();
        } else {
            echo "<div class='alert alert-danger'>Invalid username or password.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>All fields are required.</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="post">
        <h2>Login</h2>
        <label>Username</label>
        <input type="text" name="username" required><br>
        <label>Password</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="signup.php">Register Now</a></p>
</body>
</html>
