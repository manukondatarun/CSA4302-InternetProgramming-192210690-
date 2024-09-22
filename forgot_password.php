<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "insurance_system";

    // Create a connection to the database
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare a statement to check if the username exists
    $check_username_query = "SELECT * FROM login WHERE Username=?";
    $stmt = $conn->prepare($check_username_query);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Username exists, update the password
        $update_query = "UPDATE login SET Password=? WHERE Username=?";
        $stmt = $conn->prepare($update_query);

        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("ss", $password, $username);

        if ($stmt->execute()) {
            // Redirect to forgot_password.html with success message
            header('Location: login.html?message=Password updated successfully.&status=success');
            exit();
        } else {
            // If there's an error updating the password
            header('Location: forgot_password.html?message=Error updating password.&status=error');
            exit();
        }
    } else {
        // Username doesn't exist, redirect back with an error message
        header('Location: forgot_password.html?message=Invalid username. Please try again.&status=error');
        exit();
    }

    // Close the connection
    $conn->close();
}
?>
