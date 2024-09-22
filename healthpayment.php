<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Insurance Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e3994e, #f4f4f4);
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

        input[type="text"], input[type="date"], input[type="number"] {
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
            background: linear-gradient(135deg, #0072ff, #00c6ff);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        button:hover {
            background: linear-gradient(135deg, #005bb5, #0072ff);
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
            background-color: #0072ff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .print-btn:hover {
            background-color: #005bb5;
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

    // Retrieve other parameters from hidden fields
    $fullname = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $dob = htmlspecialchars($_POST['dob']);
    $plan = htmlspecialchars($_POST['plan']);
    $cost = htmlspecialchars($_POST['cost']);

    // Display confirmation receipt
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
    $fullname = htmlspecialchars($_GET['fullname'] ?? 'Not Provided');
    $email = htmlspecialchars($_GET['email'] ?? 'Not Provided');
    $phone = htmlspecialchars($_GET['phone'] ?? 'Not Provided');
    $dob = htmlspecialchars($_GET['dob'] ?? 'Not Provided');
    $plan = htmlspecialchars($_GET['plan'] ?? 'Not Selected');
    $cost = htmlspecialchars($_GET['cost'] ?? 'N/A');
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

                <input type="hidden" name="fullname" value="<?php echo $fullname; ?>">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="phone" value="<?php echo $phone; ?>">
                <input type="hidden" name="dob" value="<?php echo $dob; ?>">
                <input type="hidden" name="plan" value="<?php echo $plan; ?>">
                <input type="hidden" name="cost" value="<?php echo $cost; ?>">

                <button type="submit">Submit Payment</button>
            </form>
        </div>
    </div>

<?php
}
?>

</body>
</html>
