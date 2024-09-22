<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define your database connection details
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "insurance_system";

    // Create connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if username already exists
    $check_username_query = "SELECT * FROM login WHERE Username='$username' and Password='$password'";
    $result = $conn->query($check_username_query);
    if ($result->num_rows > 0) {
        echo "Authentication Verified";
        header('Location: index.html'); 
        exit;
    } else {
        echo "Access Denied " . $check_username_query . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>