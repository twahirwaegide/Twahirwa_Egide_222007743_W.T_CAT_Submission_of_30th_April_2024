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
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
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

        .button-container {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .button {
            background-color: #007bff;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Admin Dashboard</h1>
    </header>
    <section id="customer-list">
        <h2>Customer List - Fruits Purchased</h2>
        <table>
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Fruit Purchased</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>john@example.com</td>
                    <td>Apple, Banana</td>
                    <td class="button-container">
                        <button class="button">Update</button>
                        <button class="button">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jane Smith</td>
                    <td>jane@example.com</td>
                    <td>Orange, Mango</td>
                    <td class="button-container">
                        <button class="button">Update</button>
                        <button class="button">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Michael Johnson</td>
                    <td>michael@example.com</td>
                    <td>Pineapple, Strawberry</td>
                    <td class="button-container">
                        <button class="button">Update</button>
                        <button class="button">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="example">
            <h3>Example:</h3>
            <p>Below is an example of a customer list with fruits purchased:</p>
            <table>
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Fruit Purchased</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>john@example.com</td>
                        <td>Apple, Banana</td>
                        <td class="button-container">
                            <button class="button">Update</button>
                            <button class="button">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>jane@example.com</td>
                        <td>Orange, Mango</td>
                        <td class="button-container">
                            <button class="button">Update</button>
                            <button class="button">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Michael Johnson</td>
                        <td>michael@example.com</td>
                        <td>Pineapple, Strawberry</td>
                        <td class="button-container">
                            <button class="button">Update</button>
                            <button class="button">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <?php
// Connection details
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "selling_fruits_management_system1";

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
