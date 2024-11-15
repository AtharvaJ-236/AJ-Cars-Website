<?php
session_start();

$servername = "localhost"; 
$dbUsername = "root"; 
$dbPassword = ""; 
$dbname = "car_web"; 

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debug line to see what is being received
    var_dump($_POST); 

    // Check if username and new_password are set and not empty
    if (isset($_POST['username']) && !empty(trim($_POST['username'])) && 
        isset($_POST['new_password']) && !empty(trim($_POST['new_password']))) {

        $username = trim($_POST['username']);
        $new_password = password_hash(trim($_POST['new_password']), PASSWORD_DEFAULT); 

        $sql = "UPDATE aj_cars_users SET password = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            echo "<script>alert('Error preparing the statement.'); window.location.href = 'Reset_Password.html';</script>";
            exit;
        }

        $stmt->bind_param("ss", $new_password, $username);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "<script>
                        alert('Password reset successfully! You can now log in with your new password.');
                        window.location.href = 'Login.html'; 
                      </script>";
            } else {
                echo "<script>
                        alert('Username not found. Please check and try again.');
                        window.location.href = 'Reset_Password.html'; 
                      </script>";
            }
        } else {
            echo "<script>alert('Error executing the statement: " . $stmt->error . "'); window.location.href = 'Reset_Password.html';</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Please fill in all fields.'); window.location.href = 'Reset_Password.html';</script>";
    }
}

$conn->close();
?>
