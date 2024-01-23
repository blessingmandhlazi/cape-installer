<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function\

require 'PHPMailer/class.phpmailer.php';

/*function verify_recapture($token) {
    $secret = "6LehV1YUAAAAAOxL8r8_RD3W3ADaYypIv4JNPv6Q";
    $url = "https://www.google.com/recaptcha/api/siteverify";

    $data = array('secret' => $secret, 'response' => $token);

    $options = array(
        'http' => array(
            'header' => "Content-type: application/json",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
        );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return strpos($result, 'true');
}*/

// Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
try {

    // //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    // $mail->isSMTP();                                            // Send using SMTP
    // $mail->Host       = 'smtp1.example.com';                    // Set the SMTP server to send through
    // $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    // $mail->Username   = 'user@example.com';                     // SMTP username
    // $mail->Password   = 'secret';                               // SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    // $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above


    //$can = verify_recapture($_POST['g-recaptcha-response']);
    //temporarily deactivated recapture due to request from AdWord agent
    $t = 1;
    if ($t < 2) {
        // Recipients
        $mail->setFrom($_POST['input_email'], $_POST['input_name']);
        $mail->addAddress('info@dstvdishinstallation.co.za', 'Ben');     // Add a recipient
        $mail->addReplyTo($_POST['input_email'], $_POST['input_name']);
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $_POST['input_service'];
        $mail->Body    = "Phone number: ".$_POST['input_phone']."<br><br>Message: ".$_POST['input_message'];
        $mail->AltBody = "Phone number: ".$_POST['input_phone']."Message: ".$_POST['input_message'];
    
        $mail->send();
        
    }
    header("Location: https://www.dstvdishinstallation.co.za/message-sent.php");
    die();

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
