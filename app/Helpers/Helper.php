<?php

function send_mail($from, $to, $subject, $html)
{
    // To send HTML mail, the Content-type header must be set
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Create email headers
    $headers .= 'From: ' . $from . "\r\n" .
        'Reply-To: ' . $from . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    // Compose a simple HTML email message
    $message = $html;

    // Sending email
    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}
