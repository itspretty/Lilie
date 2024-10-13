<?php
// signin.php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

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
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user data
        $user = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Start session and store user data
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];

            // Redirect to dashboard
            header('Location: dashboard.php');
            exit;
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with this email!";
    }

    $conn->close();
}
?>
