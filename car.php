<?php
$servername = "localhost";
$dbusername = "root"; // Change if your database username is different
$dbpassword = ""; // Change if your database password is different
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
    $carModel = $conn->real_escape_string($_POST["carModel"]);
    $year = $conn->real_escape_string($_POST["year"]);
    $startDate = $conn->real_escape_string($_POST["startDate"]);
    $endDate = $conn->real_escape_string($_POST["endDate"]);
    $plan = $conn->real_escape_string($_POST["plan"]);
    $cost = $conn->real_escape_string($_POST["cost"]);

    // Prepare SQL statement for insertion
    $sql = "INSERT INTO carinsurance (fullname, email, phone, dob, carModel, year, startDate, endDate, plan, cost) VALUES ('$fullname', '$email', '$phone', '$dob', '$carModel', '$year', '$startDate', '$endDate', '$plan', '$cost')";
    
    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // After successful submission, store all parameters
        header("Location: carpayment.php?fullname=$fullname&email=$email&phone=$phone&dob=$dob&carModel=$carModel&year=$year&startDate=$startDate&endDate=$endDate&plan=$plan&cost=$cost"); 
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
