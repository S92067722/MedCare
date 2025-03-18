<?php
// Retrieve form data safely
$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;
$confirm_password = $_POST['confirm_password'] ?? null;
$gender = $_POST['gender'] ?? null;
$email = $_POST['email'] ?? null;
$PhoneNumber = $_POST['phone'] ?? null;

// Validate required fields
if (!$username || !$email || !$password || !$confirm_password) {
    die("All fields are required!");
}

// Check if passwords match
if ($password !== $confirm_password) {
    die("Passwords do not match!");
}

// Database connection details
$host = "localhost"; // Change to 3308 if necessary (check XAMPP settings)
$dbusername = "root";
$dbpassword = ""; // Update with actual MySQL password if needed
$dbname = "med_care_db";

// Establish database connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Check if email exists
$query = "SELECT email FROM signup WHERE email = ? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "Someone has already registered using this email.";
} else {
    $stmt->close();

    // Hash password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data
    $insertQuery = "INSERT INTO signup (username, password, gender, email, phone) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sssss", $username, $hashed_password, $gender, $email, $PhoneNumber);

    if ($stmt->execute()) {
        echo "New record inserted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Close connections
$stmt->close();
$conn->close();
?>
