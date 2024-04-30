
<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection credentials
    $servername = "localhost";
    $username = "root"; // Your MySQL username
    $password = ""; // Your MySQL password
    $dbname = "selling_fruits_management_system1";


    // Create a connection to the MySQL database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data and sanitize inputs
    $user = $conn->real_escape_string($_POST['username']);
    $pass = $conn->real_escape_string($_POST['password']);
    $role = $conn->real_escape_string($_POST['role']);

    // Query to fetch the user data
    $sql = "SELECT * FROM users WHERE username = '$user' AND role = '$role'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        // Fetch user data
        $user_data = $result->fetch_assoc();
        
        // Verify password using password_verify()
        if (password_verify($pass, $user_data['password'])) {
            // User is authenticated
            if ($role === "manager") {
                // Redirect manager to manager dashboard
                header("Location: manager_dashboard.html");
                exit();
            } else if ($role === "customer") {
                // Redirect customer to customer dashboard
                header("Location: customer_dashboard.html");
                exit();
            }
        } else {
            // Invalid password
            echo "Invalid username, password, or role. Please try again.";
        }
    } else {
        // Invalid username or role
        echo "Invalid username, password, or role. Please try again.";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
