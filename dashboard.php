<?php
// dashboard.php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not, redirect to the sign-in page
    header('Location: signin.html');
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password_db = ""; // Use a different variable name to avoid conflict with $password
$dbname = "registration";

// Create connection
$conn = new mysqli($servername, $username, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch user data from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the user data
    $user = $result->fetch_assoc();
} else {
    echo "No user found!";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h2>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
    <p><strong>Mobile:</strong> <?php echo htmlspecialchars($user['mobile']); ?></p>
    <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['dob']); ?></p>
    <p><strong>Blood Group:</strong> <?php echo htmlspecialchars($user['blood_group']); ?></p>
    <p><strong>NID Number:</strong> <?php echo htmlspecialchars($user['nid']); ?></p>
    <p><strong>Passport Number:</strong> <?php echo htmlspecialchars($user['passport']); ?></p>
    <p><strong>Emergency Contact:</strong> <?php echo htmlspecialchars($user['emergency_contact']); ?></p>
    <p><strong>Emergency Address:</strong> <?php echo htmlspecialchars($user['emergency_address']); ?></p>
    <div class="form-group">
        <button onclick="window.location.href='logout.php'">Logout</button>
    </div>
</div>

</body>
</html>
