<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* Reset default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Basic styling for header */
        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        /* Basic styling for sections */
        section {
            padding: 20px;
            margin-top: 20px;
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .example {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        .example h3 {
            margin-bottom: 5px;
        }

        .example ul {
            list-style-type: none;
            padding-left: 0;
        }

        .example ul li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Admin Dashboard</h1>
    </header>
    <section id="account-management">
        <h2>Account Management</h2>
        <form id="accountManagementForm" action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>

            <input type="submit" value="Login">
        </form>

        <div class="example">
            <h3>Example:</h3>
            <p>Below is an example of an account management form:</p>
            <ul>
                <li>Username: admin</li>
                <li>Password: admin123</li>
            </ul>
        </div>
    </section>

    <script>
        document.getElementById('accountManagementForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Get form values
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;

            // You can perform further actions here, like sending the form data to the server
            
            // For demonstration, let's log the values to the console
            console.log('Username:', username);
            console.log('Password:', password);
        });
    </script>
    <?php
    // Connection details
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "employee_attendance";
    
    $connection = new mysqli($host, $user, $pass, $dbname);
    
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $connection->select_db($dbname);
    
    if (isset($_POST['send'])) {
        // Retrieve values from form
        $employee_code = $_POST['code'];
        $date = $_POST['date'];
        $time_in = $_POST['tme'];
        $time_out = $_POST['out'];
        $working_hours = $_POST['hours'];
    
        // Insert new record into the database
        $stmt = $connection->prepare("INSERT INTO attendance (employee_code, Date, time_in, time_out, workinghours) VALUES (?, ?, ?, ?, ?)");
    
        $stmt->bind_param("sssss", $employee_code, $date, $time_in, $time_out, $working_hours);
    
        if ($stmt->execute()) {
            // Redirect to attendtable.php after successful insertion
            header('Location: attendtable.php');
            exit(); // Ensure that no other content is sent after the header redirection
        } else {
            echo "Error inserting record: " . $stmt->error;
        }
    }
    ?>
</body>
</html>
