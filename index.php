<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form input
    $sender_name = htmlspecialchars($_POST['sender_name']);
    $sender_email = htmlspecialchars($_POST['sender_email']);
    $recipient_email = htmlspecialchars($_POST['recipient_email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = nl2br(htmlspecialchars($_POST['message']));

    // Define headers
    $headers = "From: " . $sender_name . " <" . $sender_email . ">\r\n";
    $headers .= "Reply-To: " . $sender_email . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n"; // Send email as HTML

    // Send email using the mail() function
    $mail_sent = mail($recipient_email, $subject, $message, $headers);

    // Check if email was sent successfully
    if ($mail_sent) {
        echo "<p>Email sent successfully!</p>";
    } else {
        // Log error to a file if mail sending fails
        $error_message = "Error sending email. Sender: " . $sender_email . ", Recipient: " . $recipient_email . ", Subject: " . $subject . "\n";
        $error_message .= "Message: " . $message . "\n\n";
        error_log($error_message, 3, "email_errors.log"); // Log error to email_errors.log file

        echo "<p>There was an error sending the email. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Form</title>
</head>
<body>
    <h2>Send an Email</h2>
    <form method="POST" action="">
        <label for="sender_name">Your Name:</label><br>
        <input type="text" id="sender_name" name="sender_name" required><br><br>
        
        <label for="sender_email">Your Email:</label><br>
        <input type="email" id="sender_email" name="sender_email" required><br><br>
        
        <label for="recipient_email">Recipient's Email:</label><br>
        <input type="email" id="recipient_email" name="recipient_email" required><br><br>

        <label for="subject">Subject:</label><br>
        <input type="text" id="subject" name="subject" required><br><br>

        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" required></textarea><br><br>

        <button type="submit">Send Email</button>
    </form>
</body>
</html>
