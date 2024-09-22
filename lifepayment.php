<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Insurance Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            background-color: rgba(190, 200, 210, 0.59);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 1000px;
        }

        .plan-info {
            flex: 1;
            margin-right: 20px;
            padding: 20px;
            background: linear-gradient(135deg, #0072ff, #00c6ff);
            color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .plan-info h3 {
            margin: 0 0 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .plan-info p {
            margin: 0;
            font-size: 20px;
        }

        .form-container {
            flex: 2;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 600;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #000000;
            font-weight: bolder;
        }

        input[type="text"], input[type="tel"], input[type="date"], input[type="number"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #2575fc, #6a11cb);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        button:hover {
            background: linear-gradient(135deg, #1e62d4, #2575fc);
        }

        .receipt-container {
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            margin-top: 20px;
            text-align: left;
        }

        .receipt-container p {
            margin: 10px 0;
            font-size: 18px;
        }

        .print-btn {
            margin-top: 20px;
            padding: 10px;
            background-color: #6a11cb;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .print-btn:hover {
            background-color: #2575fc;
        }
    </style>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve payment details from form
    $cardNumber = htmlspecialchars($_POST['cardNumber']);
    $expiryDate = htmlspecialchars($_POST['expiryDate']);
    $cvv = htmlspecialchars($_POST['cvv']);

    // Retrieve other parameters from the URL (if passed)
    $fullname = htmlspecialchars($_GET['fullname']);
    $email = htmlspecialchars($_GET['email']);
    $phone = htmlspecialchars($_GET['phone']);
    $dob = htmlspecialchars($_GET['dob']);
    $plan = htmlspecialchars($_GET['plan']);
    $cost = htmlspecialchars($_GET['cost']);

    // Display confirmation and trigger print
    echo "
    <div class='receipt-container'>
        <h2>Payment Successful</h2>
        <p><strong>Full Name:</strong> $fullname</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Phone:</strong> $phone</p>
        <p><strong>Date of Birth:</strong> $dob</p>
        <p><strong>Selected Plan:</strong> $plan</p>
        <p><strong>Monthly Cost:</strong> ₹$cost</p>
        <p><strong>Card Number (masked):</strong> **** **** **** " . substr($cardNumber, -4) . "</p>
        
        <button class='print-btn' onclick='window.print();'>Print Receipt</button>
    </div>";
} else {
    // Retrieve selected plan details from GET parameters
    $plan = isset($_GET['plan']) ? htmlspecialchars($_GET['plan']) : 'Not Selected';
    $cost = isset($_GET['cost']) ? htmlspecialchars($_GET['cost']) : 'N/A';
?>

    <div class="container">
        <!-- Selected Plan Section -->
        <div class="plan-info">
            <h3>Selected Plan</h3>
            <p id="planName"><?php echo $plan; ?></p>
            <p id="planCost"><?php echo 'Cost: ₹' . $cost . '/month'; ?></p>
        </div>

        <!-- Payment Form Section -->
        <div class="form-container">
            <h2>Payment Information</h2>

            <form method="post">
                <label for="cardNumber">Card Number</label>
                <input type="text" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" required>

                <label for="expiryDate">Expiry Date</label>
                <input type="date" id="expiryDate" name="expiryDate" required>

                <label for="cvv">CVV</label>
                <input type="number" id="cvv" name="cvv" placeholder="123" required>

                <button type="submit">Submit Payment</button>
            </form>
        </div>
    </div>

<?php
}
?>

</body>
</html>
