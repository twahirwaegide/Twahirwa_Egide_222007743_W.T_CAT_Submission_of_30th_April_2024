<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";  // Use your MySQL password (leave empty if not set)
$dbname = "selling_fruits_management_system1";  // Name of the database

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve data from the inventory table
$query = "SELECT productName, productType, price, quantity FROM inventory";

// Execute the query
$result = $conn->query($query);

// Check if there are any records
if ($result->num_rows > 0) {
    echo "<section id='display-inventory'>";
    echo "<h2>Inventory:</h2>";
    echo "<table border='1' style='width: 100%; border-collapse: collapse;'>";
    echo "<thead style='background-color: #f2f2f2;'>";
    echo "<tr>";
    echo "<th style='padding: 8px;'>Product Name</th>";
    echo "<th style='padding: 8px;'>Product Type</th>";
    echo "<th style='padding: 8px;'>Price</th>";
    echo "<th style='padding: 8px;'>Quantity</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Fetch and display each record
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td style='padding: 8px;'>" . $row['productName'] . "</td>";
        echo "<td style='padding: 8px;'>" . $row['productType'] . "</td>";
        echo "<td style='padding: 8px;'>" . $row['price'] . "</td>";
        echo "<td style='padding: 8px;'>" . $row['quantity'] . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</section>";
} else {
    echo "No inventory records found.";
}

// Close the database connection
$conn->close();
?>
