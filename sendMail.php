<?php
$to      = 'mosab_cs1@yahoo.com';
$subject = 'Test Email from Localhost';
$message = 'This is a test email sent from localhost using the mail function in PHP.';
$headers = 'From: your-email@example.com' . "\r\n" .
           'Reply-To: your-email@example.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>