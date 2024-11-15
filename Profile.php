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

// Check if the user is logged in
if (!isset($_SESSION['userId'])) {
    header("Location: Login.html");
    exit();
}

// Get user ID from the session
$userId = $_SESSION['userId'];

// Fetch user data
$sql = "SELECT name, username, email FROM aj_cars_users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    echo "<script>alert('User data not found!'); window.location.href='Login.html';</script>";
    exit();
}
$stmt->close();

// Handle update if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        $newName = trim($_POST['name'] ?? '');
        $newUsername = trim($_POST['username'] ?? '');
        $newEmail = trim($_POST['email'] ?? '');

        $updateSql = "UPDATE aj_cars_users SET name = ?, username = ?, email = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        
        if ($updateStmt) {
            $updateStmt->bind_param("sssi", $newName, $newUsername, $newEmail, $userId);
            $updateStmt->execute();
            if ($updateStmt->affected_rows > 0) {
                echo "<script>alert('Profile updated successfully!');</script>";
                // Refresh the user data after update
                $userData['name'] = $newName;
                $userData['username'] = $newUsername;
                $userData['email'] = $newEmail;
            } else {
                echo "<script>alert('No changes made or update failed.');</script>";
            }
            $updateStmt->close();
        } else {
            echo "<script>alert('Update preparation failed.');</script>";
        }
    }

    // Handle delete
    if (isset($_POST['delete'])) {
        $deleteSql = "DELETE FROM aj_cars_users WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $userId);
        $deleteStmt->execute();
        
        if ($deleteStmt->affected_rows > 0) {
            echo "<script>alert('Profile deleted successfully!'); window.location.href='Login.html';</script>";
            session_destroy(); // Destroy session after deletion
            exit();
        } else {
            echo "<script>alert('Failed to delete profile.');</script>";
        }
        $deleteStmt->close();
    }

    // Handle logout
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: Login.html");
        exit();
    }
}

// Close the connection
$conn->close(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <style>
        body {
            background-image: url('WhatsApp Image 2024-08-05 at 07.37.29.jpeg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            padding: 20px;
            margin: 20px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-image-container {
            margin-bottom: 20px;
        }

        .profile-image {
            border-radius: 50%;
            width: 200px;
            height: 200px;
            object-fit: cover;
            border: 5px solid white;
        }

        .profile-info {
            width: 100%;
            margin-bottom: 20px;
            font-family: 'Verdana';
            font-size: 20px;
        }

        .edit-form {
            display: none;
            width: 100%;
        }

        .button-container {
            width: 100%;
            display: flex; 
            justify-content: space-between; 
        }

        button {
            font-size: 18px;
            font-family: 'Verdana';
            padding: 5px;
            border-radius: 15px;
            background-color: green; 
            color: white;
            cursor: pointer;
            width: 50%;
            margin-right: 4%;
        }

        button:last-child {
            margin-right: 0; 
        }

        button:hover {
            background-color: darkgreen;
        }

        h1 {
            font-family: 'Times New Roman';
            text-align: center;
            color: green;
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            color: green;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }

        a {
            color: #4a4e69;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function toggleEdit() {
            const editForm = document.getElementById('editForm');
            const profileInfo = document.getElementById('profileInfo');
            const editButton = document.getElementById('editButton');
            const updateButton = document.getElementById('updateButton');
            const logoutButton = document.getElementById('logoutButton');
            const backButton = document.getElementById('backButton');

            if (editForm.style.display === 'none') {
                editForm.style.display = 'block';
                profileInfo.style.display = 'none';
                editButton.style.display = 'none'; 
                logoutButton.style.display = 'none'; 
                updateButton.style.display = 'block'; 
                backButton.style.display = 'block'; 
            } else {
                editForm.style.display = 'none';
                profileInfo.style.display = 'block';
                editButton.style.display = 'block'; 
                logoutButton.style.display = 'block'; 
                updateButton.style.display = 'none'; 
                backButton.style.display = 'none'; 
            }
        }
    </script>
</head>
<body>

<div class="container">
    <h1>Welcome, <?php echo htmlspecialchars($userData['name'] ?? 'Guest'); ?>!</h1>
    
    <div class="profile-image-container">
        <img src="IMG_3800.JPG" alt="Profile Image" class="profile-image">
    </div>
    
    <div id="profileInfo" class="profile-info">
        <p><strong>Name:</strong> <span><?php echo htmlspecialchars($userData['name'] ?? 'N/A'); ?></span></p>
        <p><strong>Username:</strong> <span><?php echo htmlspecialchars($userData['username'] ?? 'N/A'); ?></span></p>
        <p><strong>Email:</strong> <span><?php echo htmlspecialchars($userData['email'] ?? 'N/A'); ?></span></p>
    </div>
    
    <div id="editForm" class="edit-form">
        <h2>Edit Information</h2>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="New Name" value="<?php echo htmlspecialchars($userData['name'] ?? ''); ?>" required>
            <input type="text" name="username" placeholder="New Username" value="<?php echo htmlspecialchars($userData['username'] ?? ''); ?>" required>
            <input type="email" name="email" placeholder="New Email" value="<?php echo htmlspecialchars($userData['email'] ?? ''); ?>" required><br><br>
            <button type="submit" name="update" id="updateButton" style="display: none;">Update</button><br>
            <button type="button" id="backButton" onclick="toggleEdit()" style="display: none;">Back</button>
        </form>
    </div>
    
    <div class="button-container">
        <button id="editButton" onclick="toggleEdit()">Edit</button>
        <form method="POST" action="" id="logoutButton" style="width: 100%;">
            <button type="submit" name="logout">Logout</button>
        </form>
        <form method="POST" action="" style="width: 100%;">
            <button type="submit" name="delete">Delete Account</button>
        </form>
    </div>
</div>

</body>
</html>
