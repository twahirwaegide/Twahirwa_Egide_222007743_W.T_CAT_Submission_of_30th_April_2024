<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard</title>
    <style>
        /* Styling for the page */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        section {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        form input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <header>
        <h1>Welcome to Admin Dashboard</h1>
    </header>

    <section id="manage-fruits">
        <form id="manageFruitForm" action="" method="POST">
            <label for="fruitName">Fruit Name:</label>
            <input type="text" id="fruitName" name="fruitName" placeholder="e.g., Apple" required>

            <label for="category">Category:</label>
            <input type="text" id="category" name="category" placeholder="e.g., Fruits" required>

            <label for="price">Price (per unit):</label>
            <input type="number" id="price" name="price" min="0" step="0.01" placeholder="e.g., 2.50" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="0" placeholder="e.g., 100" required>

            <input type="submit" value="Add Fruit">
    </form>
    </section>

</body>
<?php

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection credentials
    $servername = "localhost";
    $username = "root"; 
    $password = ""; // 
    $dbname = "selling_fruits_management_system1"; // Your database name

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $fruitName = $conn->real_escape_string($_POST['fruitName']);
    $category = $conn->real_escape_string($_POST['category']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO fruits (fruitName, category, price, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $fruitName, $category, $price, $quantity);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Fruit added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method. Please use the form to submit data.";
}
?>

</html>
