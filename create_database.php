<?php
// Include the database configuration file
require 'db_config.php';

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db($dbname);

// Create table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    dob DATE,
    gender VARCHAR(10),
    phone VARCHAR(20),
    website VARCHAR(100),
    bio TEXT,
    profile_picture VARCHAR(255),
    hobbies VARCHAR(255),
    newsletter VARCHAR(10)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
