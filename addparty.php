<?php
// Database connection (replace with your own credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "insurance_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert only the partyID into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $partyID = $_POST['partyID'];

    // Prevent duplicate partyID entries
    $checkDuplicate = "SELECT partyID FROM parties WHERE partyID = '$partyID'";
    $result = $conn->query($checkDuplicate);

    if ($result->num_rows > 0) {
        echo "Party ID already exists!";
    } else {
        $sql = "INSERT INTO parties (partyID) VALUES ('$partyID')";

        if ($conn->query($sql) === TRUE) {
            echo "New party ID added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
