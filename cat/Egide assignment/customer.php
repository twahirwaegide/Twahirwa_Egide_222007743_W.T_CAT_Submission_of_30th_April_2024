<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Use your MySQL password
$dbname = "selling_fruits_management_system1"; // Name of the database

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $fruit_purchased = $_POST['fruit_purchased'];
    $created_at = $_POST['created_at'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO customers (id, name, email, fruit_purchased, created_at) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $id, $name, $email, $fruit_purchased, $created_at);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data inserted successfully!";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
