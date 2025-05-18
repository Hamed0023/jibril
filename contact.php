<?php

// Only process POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get and sanitize the form fields
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);

    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $website = strip_tags(trim($_POST["website"]));

    // Validate the form fields
    if (empty($name) || empty($email) || empty($phone) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Oops! There was a problem with your submission. Please complete all required fields.";
        exit;
    }

    // Set the recipient email address
    $recipient = "hamed.portalagency@gmail.com"; // <-- Replace with your actual email

    // Set the email subject
    $subject = "New Lead from $name";

    // Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Contact Number: $phone\n";
    $email_content .= "Website: $website\n";

    // Set the email headers
    $email_headers = "From: $name <$email>\r\n";
    $email_headers .= "Reply-To: $email";

    // Send the email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Thank you! Your message has been sent.";
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }

} else {
    // Not a POST request
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
