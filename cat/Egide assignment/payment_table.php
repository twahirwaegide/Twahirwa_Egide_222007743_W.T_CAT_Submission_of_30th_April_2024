
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Use a secure password or environment variable
$dbname = "selling_fruits_management_system1";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve data from the database
$query = "SELECT * FROM payments";

$result = $conn->query($query);

// Check if there are any records
if ($result->num_rows > 0) {
    echo "<h2>Payment table</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Id</th><th>Card Number</th><th>Expiration Date</th><th>CVV</th><th>Card Holder</th><th>Amount</th><th>Quantity</th></tr>";
    
    // Fetch and display records
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['card_number'] . "</td>";
        echo "<td>" . $row['expiration_date'] . "</td>";
        echo "<td>" . $row['cvv'] . "</td>";
        echo "<td>" . $row['cardholder_name'] . "</td>";
        echo "<td>" . $row['amount'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "No payment records found.";
}

// Close the database connection
$conn->close();
?>
