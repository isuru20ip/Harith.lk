<?php

require "conection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$email = $_GET["e"];

if (empty($email)) {
    echo ("Please enter your email");
} elseif (strlen($email) > 100) {
    echo ("email must have less than 100 Charactres.");
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("invalid email");
} else {

    $user = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "';");
    $user_count = $user->num_rows;

    if ($user_count == 1) {

        $code = uniqid();
        Database::iud("UPDATE `user` SET `verification_code`='" . $code . "' WHERE `email` = '" . $email . "' ");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'Your email';
        $mail->Password = 'app password';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('Your email', 'text');
        $mail->addReplyTo('Your email', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Title';
        $bodyContent = 'content';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo ("Verification Code Sending Failed.");
        } else {
            echo ("Verification Code Sending Success.");
            
        }
    } else {
        echo ("Invalid user email");
    }
}
