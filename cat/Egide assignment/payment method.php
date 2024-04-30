<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-group button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            display: block;
            width: 100%;
        }

        .form-group button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Payment Form</h2>
        <form id="payment_form" action="" method="POST">
            <div class="form-group">
                <label for="card_number">Card Number</label>
                <input type="text" id="card_number" name="card_number" placeholder="Enter card number" required>
            </div>
            <div class="form-group">
                <label for="exp_date">Expiration Date</label>
                <input type="text" id="exp_date" name="exp_date" placeholder="MM/YY" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="Enter CVV" required>
            </div>
            <div class="form-group">
                <label for="card_holder">Card Holder</label>
                <input type="text" id="card_holder" name="card_holder" placeholder="Enter card holder name" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" id="amount" name="amount" placeholder="Enter amount" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" placeholder="Enter quantity" required>
            </div>
            <div class="form-group">
                <button type="submit">Pay Now</button>
            </div>
        </form>
    </div>

    <script>
        const form = document.getElementById('payment_form');
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            // Simulate payment process
            const amount = form.elements['amount'].value;
            const quantity = form.elements['quantity'].value;

            alert(`Payment successful!\nAmount: $${amount}\nQuantity: ${quantity}`);
            form.reset(); // Reset form fields
        });
    </script>
</body>

</html>
<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    // Retrieve form data
    $card_number = $_POST['card_number'];
    $exp_date = $_POST['exp_date'];
    $cvv = $_POST['cvv'];
    $card_holder = $_POST['card_holder'];
    $amount = $_POST['amount'];
    $quantity = $_POST['quantity'];

    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO payments (card_number, expiration_date, cvv, cardholder_name, amount, quantity) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssdi", $card_number, $exp_date, $cvv, $card_holder, $amount, $quantity);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Payment data inserted successfully!";
    } else {
        echo "Error inserting payment data: " . $stmt->error;
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
} else {
    // Handle non-POST requests
    echo "Invalid request method. Please use the form to submit data.";
}
?>
