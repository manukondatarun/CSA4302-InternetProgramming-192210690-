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
    $phone = $conn->real_escape_string($_POST["phone"]);
    $dob = $conn->real_escape_string($_POST["dob"]);
    $occupation = $conn->real_escape_string($_POST["occupation"]);
    $smoke = $conn->real_escape_string($_POST["smoke"]);
    $medical = $conn->real_escape_string($_POST["medical"]);
    $plan = $conn->real_escape_string($_POST["plan"]); // Updated to match input name
    $cost = $conn->real_escape_string($_POST["cost"]); // Updated to match input name

    // Prepare SQL statement for insertion
    $sql = "INSERT INTO lifeinsurance (fullname, email, phone, dob, occupation, smoke, medical, plan, cost) 
            VALUES ('$fullname', '$email', '$phone', '$dob', '$occupation', '$smoke', '$medical', '$plan', '$cost')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // After successful submission, store all parameters and redirect
        header("Location: healthpayment.php?fullname=$fullname&email=$email&dob=$dob&occupation=$occupation&smoke=$smoke&medical=$medical&plan=$plan&cost=$cost");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
