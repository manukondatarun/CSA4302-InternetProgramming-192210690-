<?php
// Configuration
$servername = "localhost";
$dbusername = "root"; // Update to your database username
$dbpassword = ""; // Update to your database password
$dbname = "insurance_system"; // Your database name

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data
    $fullname = $conn->real_escape_string($_POST["fullname"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $dob = $conn->real_escape_string($_POST["dob"]);
    $healthCondition = $conn->real_escape_string($_POST["healthCondition"]);
    $plan = $conn->real_escape_string($_POST["plan"]); // Updated to match input name
    $cost = $conn->real_escape_string($_POST["cost"]); // Updated to match input name

    // Prepare SQL statement for insertion
    $sql = "INSERT INTO healthinsurance (fullname, email, dob, healthCondition, plan, cost) VALUES ('$fullname', '$email', '$dob', '$healthCondition', '$plan', '$cost')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // After successful submission, store all parameters and redirect
        header("Location: healthpayment.php?fullname=$fullname&email=$email&dob=$dob&healthCondition=$healthCondition&plan=$plan&cost=$cost");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
