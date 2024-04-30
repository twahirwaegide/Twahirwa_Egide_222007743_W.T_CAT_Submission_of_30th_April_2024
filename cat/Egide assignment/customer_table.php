<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";  // Use a secure password or environment variable
$dbname = "selling_fruits_management_system1";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve customer data from the database
$query = "SELECT * FROM customers";

// Execute the query and retrieve the results
$result = $conn->query($query);

// Check if there are any records
if ($result->num_rows > 0) {
    echo "<table style='border-collapse: collapse; width: 100%; border: 1px solid #ccc;'>";
    echo "<thead style='background-color: #f2f2f2;'>";
    echo "<tr>";
    echo "<th style='border: 1px solid #ccc; padding: 8px;'>id</th>";
    echo "<th style='border: 1px solid #ccc; padding: 8px;'>name</th>";
    echo "<th style='border: 1px solid #ccc; padding: 8px;'>email</th>";
    echo "<th style='border: 1px solid #ccc; padding: 8px;'>fruit_purchased</th>";
    echo "<th style='border: 1px solid #ccc; padding: 8px;'>created_at</th>";
    echo "<th style='border: 1px solid #ccc; padding: 8px;'>Action</th>";
    echo "</tr>";
    echo "</thead>";
    
    echo "<tbody>";
    
    // Fetch and display each record
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td style='border: 1px solid #ccc; padding: 8px;'>" . $row['id'] . "</td>";
        echo "<td style='border: 1px solid #ccc; padding: 8px;'>" . $row['name'] . "</td>";
        echo "<td style='border: 1px solid #ccc; padding: 8px;'>" . $row['email'] . "</td>";
        echo "<td style='border: 1px solid #ccc; padding: 8px;'>" . $row['fruit_purchased'] . "</td>";
        echo "<td style='border: 1px solid #ccc; padding: 8px;'>" . $row['created_at'] . "</td>";
        echo "<td class='button-container' style='border: 1px solid #ccc; padding: 8px; text-align: center;'>";
        echo "<button style='background-color: #007bff; color: white; padding: 8px 16px; border-radius: 4px; border: none; margin-right: 5px;'>Update</button>";
        echo "<button style='background-color: #dc3545; color: white; padding: 8px 16px; border-radius: 4px; border: none;'>Delete</button>";
        echo "</td>";
        echo "</tr>";
    }
    
    echo "</tbody>";
    echo "</table>";
} else {
    echo "No records found in the inventory table.";
}

// Close the database connection
$conn->close();
?>
