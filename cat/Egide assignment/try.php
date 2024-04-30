<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Form</title>
  <style>
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
      border: none;
      color: white;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
    }
    .form-group button:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2>Payment Form</h2>
    <form id="payment-form" method="post" action="process_payment.php">
      <div class="form-group">
        <label for="card-number">Card Number</label>
        <input type="text" id="card-number" name="card_number" placeholder="Enter card number" required>
      </div>
      <div class="form-group">
        <label for="exp-date">Expiration Date</label>
        <input type="text" id="exp-date" name="exp_date" placeholder="MM/YY" required>
      </div>
      <div class="form-group">
        <label for="cvv">CVV</label>
        <input type="text" id="cvv" name="cvv" placeholder="CVV" required>
      </div>
      <div class="form-group">
        <label for="card-holder">Cardholder Name</label>
        <input type="text" id="card-holder" name="card_holder" placeholder="Enter cardholder name" required>
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
    const form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent form submission

      // Perform form submission
      form.submit();
    });
  </script>
  <?php
  // Database connection
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "selling_fruits_management_system1";
  
  // Establishing the connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  // Checking the connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $card_number = filter_var($_POST['card_number'], FILTER_SANITIZE_STRING);
  $exp_date = filter_var($_POST['exp_date'], FILTER_SANITIZE_STRING);
  $cvv = filter_var($_POST['cvv'], FILTER_SANITIZE_STRING);
  $card_holder = filter_var($_POST['card_holder'], FILTER_SANITIZE_STRING);
  $amount = filter_var($_POST['amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $quantity = filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT);
  
  // Prepare and execute the SQL statement
  $stmt = $conn->prepare("INSERT INTO payments (card_number, expiration_date, cvv, cardholder_name, amount, quantity) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssdi", $card_number, $exp_date, $cvv, $card_holder, $amount, $quantity);
  
  // Execute the statement and handle the result
  if ($stmt->execute()) {
      echo "Payment data inserted successfully!";
      exit();
  } else {
      echo "Error inserting payment data: " . $stmt->error;
  }
  
  // Close the statement and the connection
  $stmt->close();
  $conn->close();
  ?>
  
</body>

</html>
