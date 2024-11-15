<?php
session_start();

// Database credentials
$servername = "localhost"; 
$dbUsername = "root"; 
$dbPassword = ""; 
$dbname = "car_web"; 

// Create a database connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT id, password FROM aj_cars_users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        error_log("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        exit;
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Set the session variable for user ID
            $_SESSION['userId'] = $row['id']; // Set user ID in session
            header("Location: Main_Page.html"); // Redirect to profile page
            exit();
        } else {
            echo "<script>alert('Incorrect password. Please try again.'); window.location.href = 'Login.html';</script>";
        }
    } else {
        echo "<script>alert('Username not found. Please register.'); window.location.href = 'Registration Form.html';</script>";
    }

    $stmt->close();
}
$conn->close();
?>
