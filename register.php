<?php
// register.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $dob = $_POST['dob'];
    $blood_group = $_POST['blood_group'];
    $nid = $_POST['nid'];
    $email = $_POST['email'];
    $passport = $_POST['passport'];
    $emergency_contact = $_POST['emergency_contact'];
    $emergency_address = $_POST['emergency_address'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password_db = ""; // Use a different variable name to avoid conflict with $password
    $db_name = "registration";

    // Create connection
    $conn = new mysqli($servername, $username, $password_db, $dbname,3306);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to insert data into the database
    $sql = "INSERT INTO users (name, address, mobile, dob, blood_group, nid, email, passport, emergency_contact, emergency_address, password)
            VALUES ('$name', '$address', '$mobile', '$dob', '$blood_group', '$nid', '$email', '$passport', '$emergency_contact', '$emergency_address', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to sign-in page after successful registration
        header('Location: signin.html');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
