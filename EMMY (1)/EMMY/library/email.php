<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function send_mail($sent_to_email, $sent_to_fullname, $subject, $content, $option = array()) {
    global $config_email;
    // Instantiation and passing true enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host = $config_email['host'];  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
        $mail->Username = $config_email['username'];                     // SMTP username
        $mail->Password = $config_email['password'];                               // SMTP password
        $mail->SMTPSecure = $config_email['smtp_secure'];                                  // Enable TLS encryption, ssl also accepted
        $mail->Port = $config_email['port'];                                    // TCP port to connect to

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->CharSet = 'UTF-8';
        //Recipients(Người nhận)
        $mail->setFrom($config_email['username'], $config_email['fullname']);
        $mail->addAddress($sent_to_email, $sent_to_fullname);     // Add a recipient
//    $mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo($config_email['username'], $config_email['fullname']);
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');
        // Attachments(Tài liệu đính kèm)
//        $mail->addAttachment('pe_nu.jpg');         // Add attachments
        
//    $mail->addAttachment('pe_nu.jpg', 'nu.jpg');    // Optional name
        // Content(Nội dung)
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $content;
//    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Email không được gửi. Chi tiết lỗi, {$mail->ErrorInfo}";
    }
}
?>