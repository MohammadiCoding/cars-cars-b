<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $name = isset($_POST["name"]) ? htmlspecialchars(trim($_POST["name"])) : '';
    $phone = isset($_POST["phone"]) ? htmlspecialchars(trim($_POST["phone"])) : '';
    $make = isset($_POST["make"]) ? htmlspecialchars(trim($_POST["make"])) : '';
    $year = isset($_POST["year"]) ? htmlspecialchars(trim($_POST["year"])) : '';
    $email = isset($_POST["email"]) ? htmlspecialchars(trim($_POST["email"])) : '';
    $address = isset($_POST["address"]) ? htmlspecialchars(trim($_POST["address"])) : '';
    $model = isset($_POST["model"]) ? htmlspecialchars(trim($_POST["model"])) : '';
    $expected_price = isset($_POST["expected-price"]) ? htmlspecialchars(trim($_POST["expected-price"])) : '';
    $description = isset($_POST["description"]) ? htmlspecialchars(trim($_POST["description"])) : '';

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Email details
    $to = "mn385359@gmail.com";
    $subject = "New Quote Request from $name";
    $message = "
        <html>
        <head>
            <title>New Quote Request</title>
        </head>
        <body>
            <h2>Quote Request Details</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Make:</strong> $make</p>
            <p><strong>Year:</strong> $year</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Address/Location:</strong> $address</p>
            <p><strong>Model:</strong> $model</p>
            <p><strong>Expected Price:</strong> $expected_price</p>
            <p><strong>Description:</strong></p>
            <p>$description</p>
        </body>
        </html>
    ";

    // Set content-type header for sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";

    // Additional headers
    $headers .= 'From: ' . $email . "\r\n";
    $headers .= 'Reply-To: ' . $email . "\r\n";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "Thank you! Your request has been sent.";
    } else {
        echo "Sorry, there was an error sending your request. Please try again.";
    }
} else {
    echo "Invalid request method.";
}
?>
