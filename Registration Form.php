<?php
session_start();

$servername = "localhost"; 
$dbUsername = "root"; 
$dbPassword = ""; 
$dbname = "car_web"; 

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $name = $_POST['name']; // Get the name from the form
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 

    // Check if username, email, or name already exists
    $checkSql = "SELECT * FROM aj_cars_users WHERE username = ? OR email = ? OR name = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("sss", $username, $email, $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
                alert('Username, email, or name already exists. Please choose another.');
                window.location.href = 'Registration Form.html'; 
              </script>";
    } else {
        // Insert into the Users table including the name
        $insertSql = "INSERT INTO aj_cars_users (username, email, name, password) VALUES (?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("ssss", $username, $email, $name, $password);

        if ($insertStmt->execute()) {
            echo "<script>
                    alert('Registration successful! You can now log in.');
                    window.location.href = 'Login.html'; 
                  </script>";
        } else {
            echo "<script>
                    alert('Error: " . $insertStmt->error . "');
                    window.location.href = 'Registration Form.html'; 
                  </script>";
        }
        $insertStmt->close();
    }
    $stmt->close();
}
$conn->close();
?>
